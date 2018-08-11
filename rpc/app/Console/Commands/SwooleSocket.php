<?php

namespace Rpc\Console\Commands;

use Illuminate\Console\Command;
use Rpc\Server\SocketServer;

class SwooleSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:socket {operate}';

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
        if(count(config("hosts")["http"])){
            foreach (config("hosts")["http"] as $option){
                $server = new SocketServer($option);
                $server->handle($operate);
            }
        }

    }
}
