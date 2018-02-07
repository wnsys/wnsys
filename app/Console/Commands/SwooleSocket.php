<?php

namespace App\Console\Commands;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
