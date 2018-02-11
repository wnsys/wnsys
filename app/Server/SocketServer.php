<?php
namespace App\Server;
class SocketServer
{

    public static $instance;
    function __construct($options)
    {
        $server = new \swoole_server($options["host"], $options["port"]);
        $server->set($options);
        $server->on('connect', function ($server, $fd){
            echo "connection open: {$fd}\n";
        });
        $server->on('receive', function ($server, $fd, $reactor_id, $data) {
            $server->send($fd,  $data);
            $server->close($fd);
        });
        $server->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });
        $server->start();
    }
    public static function getInstance($options) {
        if (!self::$instance) {
            self::$instance = new SocketServer($options);
        }
        return self::$instance;
    }
}