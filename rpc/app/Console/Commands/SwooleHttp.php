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
    protected $signature = 'swoole:http {operate} {port=9600}';

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

        $operate = $this->argument('operate');
        $port = $this->argument('port')?:9600;
        $options = [
            // like pm.start_servers in php-fpm, but there's no option like pm.max_children
            'worker_num' => 1,
            // max number of coroutines handled by a worker in the same time
            'max_coro_num' => 3000,
            // set it to false when debug, otherwise true
            'daemonize' => false,
            // like pm.max_requests in php-fpm
            'max_request' => 1000,
            'pid_file' => app()->basePath()."/bootstrap/swoole-http-".$port.".pid",
            'log_file' => app()->storagePath().'/logs/swoole.log',
            "port" => $port,
            "host" => "127.0.0.1"
        ];
        $server = new HttpServer($options);
        $server->handle($operate);

    }

}
