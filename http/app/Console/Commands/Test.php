<?php
namespace App\Console\Commands;


use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    function handle(){
        $client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC); //异步非阻塞

        $client->on("connect", function($cli) {
            $cli->send("hello world\n");
        });

        $client->on("receive", function($cli, $data = ""){
            if(empty($data)){
                $cli->close();
                echo "closed\n";
            } else {
                echo "received: $data\n";
                sleep(1);
                $cli->send("hello\n");
            }
        });

        $client->on("close", function($cli){
            $cli->close(); // 1.6.10+ 不需要
            echo "close\n";
        });

        $client->on("error", function($cli){
            exit("error\n");
        });

        $client->connect('127.0.0.1', 9601, 0.5);
        $client->send("hello world\n");
    }

}