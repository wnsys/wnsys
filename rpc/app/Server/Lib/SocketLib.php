<?php
namespace  Rpc\Server\Lib;
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
            $concrete = config("interfaces")[$data["interface"]]["socket"]["concrete"];
            $class = new \ReflectionClass($concrete);
            $instant = $class->newInstance();
            $method = $class->getMethod($data["method"]);
            $rs = $method->invokeArgs($instant,$data["args"]);
            echo "receive: {$rs}\n";
            $server->send($fd,  $rs);
            $server->close($fd);
        });
        $server->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });
        $server->start();
    }

}