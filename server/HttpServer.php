<?php
namespace Server;
use Server\Lib\HttpLib;

/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 10:47
 */
class HttpServer{
    private $options;
    function __construct($port)
    {
        $this->options = [
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

    }
    function handle($operate){
        switch ($operate) {
            case 'start':
                HttpLib::getInstance($this->options);
                break;
            case 'stop':
                posix_kill(getPid($this->options["port"],$this->options["pid_file"]), SIGTERM);
                break;
            case 'reload':
                posix_kill(getPid($this->options["port"],$this->options["pid_file"]), SIGUSR1);
                break;
            case 'restart':
                posix_kill(getPid($this->options["port"],$this->options["pid_file"]), SIGTERM);
                sleep(1);
                HttpLib::getInstance($this->options);
                break;
        }
    }
}