<?php

namespace App\Console\Commands;

use App\Server\HttpServer;
use Illuminate\Console\Command;

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
            "port"=>$port??9501,
            "host"=>"127.0.0.1"
        ];
        switch ($operate) {
            case 'start':
                HttpServer::getInstance($options);
                break;
            case 'stop':
                posix_kill(getPid($options["port"]), SIGTERM);
                break;
            case 'reload':
                posix_kill(getPid($options["port"]), SIGUSR1);
                break;
            case 'restart':
                posix_kill(getPid($options["port"]), SIGTERM);
                sleep(1);
                HttpServer::getInstance($options);
                break;
        }

    }

}
