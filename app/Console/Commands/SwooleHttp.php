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
        switch ($operate) {
            case 'start':
                HttpServer::getInstance($port);
                break;
            case 'stop':
                posix_kill($this->getPid($port), SIGTERM);
                break;
            case 'reload':
                posix_kill($this->getPid($port), SIGUSR1);
                break;
            case 'restart':
                posix_kill($this->getPid($port), SIGTERM);
                sleep(1);
                HttpServer::getInstance($port);
                break;
        }

    }
    function getPid($listen_port = 9501){
        $pid_file = app()->basePath() .'/bootstrap/laravel-fly-' . $listen_port . '.pid';
        $pid = 0;
        try {
            if (is_file($pid_file))
                $pid = (int)file_get_contents($pid_file);
        } catch (\Throwable $e) {
            print("pid can not be read from $pid_file \n");
        }
        return $pid;
    }
}
