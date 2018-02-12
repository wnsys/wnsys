<?php

namespace Service\Console\Commands;

use Illuminate\Console\Command;
use Server\SocketServer;

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
        $server = new SocketServer($port);
        $server->handle($operate);

    }
}
