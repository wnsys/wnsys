<?php

namespace Service\Console\Commands;

use Illuminate\Console\Command;
use Server\Lib\GatewaySocketLib;
use Server\SocketServer;

class SwooleGatewaySocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:gateway_socket {operate} {port=9500}';

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
        $port = $this->argument('port');
        $options = [
            // like pm.start_servers in php-fpm, but there's no option like pm.max_children
            'worker_num' => 4,
            // max number of coroutines handled by a worker in the same time
            'max_coro_num' => 3000,
            // set it to false when debug, otherwise true
            'daemonize' => false,
            // like pm.max_requests in php-fpm
            'max_request' => 1000,
            'pid_file' => app()->basePath()."/bootstrap/swoole-".$port.".pid",
            'log_file' => app()->storagePath().'/logs/swoole.log',
            "port" => $port?:9500,
            "host" => "127.0.0.1"
        ];
        $server = new GatewaySocketLib($options);
        $server->handle($operate);

    }
}