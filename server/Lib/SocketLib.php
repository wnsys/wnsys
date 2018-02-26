<?php
namespace Server\Lib;
class SocketLib
{

    public static $instance;
    function __construct($options)
    {
        $server = new \swoole_server($options["host"], $options["port"]);
        $server->set($options);
        $server->on('connect', function ($server, $fd){
            echo "connection open: {$fd}\n";
        });
        /**
         * $data["interface"];
         * $data["method"];
         * $data["arguments"];
         */
        $server->on('receive', function ($server, $fd, $reactor_id, $data) {
            $data = \GuzzleHttp\json_decode($data,true);
            print_r($data);
            $concrete = config("remote")[$data["interface"]]["socket"];
            $class = new \ReflectionClass($concrete);
            $instant = $class->newInstance();
            $method = $class->getMethod($data["method"]);
            $rs = $method->invoke($instant,$data["arguments"]);
            echo "receive: {$rs}\n";
            $server->send($fd,  $rs);
            $server->close($fd);
        });
        $server->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });
        $server->start();
    }
    public static function getInstance($options) {
        if (!self::$instance) {
            self::$instance = new SocketLib($options);
        }
        return self::$instance;
    }
}