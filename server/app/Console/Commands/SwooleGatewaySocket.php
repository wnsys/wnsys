<?php

namespace Server\Console\Commands;

use Illuminate\Console\Command;
use Server\Server\GatewayServer;
use Server\Server\SocketServer;
use Server\Server\HttpServer;
class SwooleGatewaySocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:gateway_socket {operate} ';

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
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $operate = $this->argument('operate');
        if(count(config("hosts")["gateway"])){
            foreach (config("hosts")["gateway"] as $index => $option){
                $process = new \swoole_process(function(\swoole_process $worker)use($index,$option,$operate){
                    \swoole_set_process_name(sprintf('php-ps:%s',$index));
                    $server = new GatewayServer($option);
                    $server->handle($operate);
                }, false, false);
                $pid=$process->start();
            }
        }
    }
}
