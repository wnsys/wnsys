<?php

namespace App\Console\Commands;

use App\Server\SocketServer;
use Illuminate\Console\Command;

class SwooleSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:socket {operate} {port=9601}';

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
            "port"=>$port??9601,
            "host"=>"127.0.0.1"
        ];
        switch ($operate) {
            case 'start':
                SocketServer::getInstance($options);
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
                SocketServer::getInstance($options);
                break;
        }

    }

}
