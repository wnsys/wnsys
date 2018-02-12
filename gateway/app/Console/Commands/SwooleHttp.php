<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Server\HttpServer;

class SwooleHttp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:http {operate} {port=9501}';

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
        $port = $this->argument('port');
        $options = [
            // like pm.start_servers in php-fpm, but there's no option like pm.max_children
            'worker_num' => 4,
            // max number of coroutines handled by a worker in the same time
            'max_coro_num' => 3000,
            // set it to false when debug, otherwise true
            'daemonize' => true,
            // like pm.max_requests in php-fpm
            'max_request' => 1000,
            'pid_file' => app()->basePath()."/bootstrap/swoole-".$port.".pid",
            'log_file' => app()->storagePath().'/logs/swoole.log',
            "port" => $port?:9501,
            "host" => "127.0.0.1"
        ];
        switch ($operate) {
            case 'start':
                HttpServer::getInstance($options);
                break;
            case 'stop':
                posix_kill(getPid($options["port"],$options["pid_file"]), SIGTERM);
                break;
            case 'reload':
                posix_kill(getPid($options["port"],$options["pid_file"]), SIGUSR1);
                break;
            case 'restart':
                posix_kill(getPid($options["port"],$options["pid_file"]), SIGTERM);
                sleep(1);
                HttpServer::getInstance($options);
                break;
        }

    }

}
