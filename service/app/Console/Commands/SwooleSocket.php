<?php

namespace Service\Console\Commands;

use Illuminate\Console\Command;
use Rpc\Server\SocketServer;

class SwooleSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:socket {operate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole socket 服务器';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $mpid;
    protected $works = [];
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->mpid = posix_getpid();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $operate = $this->argument('operate');

        if (count(config("hosts")["socket"])) {
            foreach (config("hosts")["socket"] as $index => $option) {
                $process = new \swoole_process(function (\swoole_process $worker) use ($index, $option, $operate) {
                    \swoole_set_process_name(sprintf('php-socket-%s:%s', $option["port"],$index));
                    $server = new SocketServer($option);
                    $server->handle($operate);
                }, false, false);
                $pid = $process->start();
                $this->works[] = $pid;

            }
            $this->processWait();
        }


    }

    public function processWait()
    {
        while (1) {
            if(count($this->works)) {
                $ret = \swoole_process::wait();
                if ($ret) {
                    $index = array_search($ret["pid"], $this->works);
                    unset($this->works[$index]);
                    if (count($this->works) == 0) {
                        \swoole_process::kill($this->mpid);
                        break;
                    }
                }
            }
            else{
                break;
            }
        }
    }
}
