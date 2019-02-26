<?php
namespace  Rpc\Server;
use Rpc\Server\Handle\SocketHandle;

/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 10:47
 */
class SocketServer{
    private $options;
    function __construct($options)
    {
        $this->options = $options;
    }
    function handle($operate){
        switch ($operate) {
            case 'start':
                new SocketHandle($this->options);
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
                new SocketHandle($this->options);
                break;
        }
    }
}