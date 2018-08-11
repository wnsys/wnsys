<?php

namespace Rpc\Console\Commands;


use Illuminate\Console\Command;
use Rpc\Server\HttpServer;
use Rpc\Server\Lib\HttpLib;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        exit;
        $operate = $this->argument('operate');
        if(count(config("hosts")["http"])){
            foreach (config("hosts")["http"] as $index => $option){
                $process = new \swoole_process(function(\swoole_process $worker)use($index,$option,$operate){
                    \swoole_set_process_name(sprintf('php-ps:%s',$index));
                    $server = new \Rpc\Server\HttpServer($option);
                    $server->handle($operate);
                }, false, false);

                $pid=$process->start();

            }
        }


    }

}
