<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Server\HttpServer;
use Server\Lib\HttpLib;

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
        $server = new HttpServer($port);
        $server->handle($operate);

    }

}
