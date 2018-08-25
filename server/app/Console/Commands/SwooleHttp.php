<?php

namespace Server\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Cache;
use Server\Server\HttpServer;
use Server\Server\Handle\HttpHandle;

class SwooleHttp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:http {operate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'swoole http 服务器';
    protected $mpid;
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
        if(count(config("hosts")["http"])){
            foreach (config("hosts")["http"] as $index => $option){
                $process = new \swoole_process(function(\swoole_process $worker)use($index,$option,$operate){
                    \swoole_set_process_name(sprintf('php-ps:%s',$index));
                    $server = new HttpServer($option);
                    $server->handle($operate);
                }, false, false);

                $pid=$process->start();

            }
        }


    }

}
