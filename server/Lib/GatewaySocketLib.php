<?php
namespace Server\Lib;

use GuzzleHttp\Client;

class GatewaySocketLib
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
         * $data["args"];
         * $data["rpcType"];
         */
        $server->on('receive', function ($server, $fd, $reactor_id, $data) {
            $data = \GuzzleHttp\json_decode($data,true);
            $class = new \ReflectionClass($data["interface"]);
            $method = $class->getMethod($data["method"]);
            $dependencies = $method->getParameters();
            // 处理，把传入的索引数组变成关联数组， 键为函数参数的名字
            $parameters = [];
            foreach ($data["args"] as $key => $value)
            {
                if (is_numeric($key))
                {
                    // 删除索引数组， 只留下关联数组
                    // 用参数的名字做为键
                    $parameters[$dependencies[$key]->name] = $value;
                }
            }
            if($data["rpcType"] == "socketSync"){
                $concrete = config("remote")[$data["interface"]]["socket"]["concrete"];
                $instant = $concrete->newInstance();
                $rs = $method->invokeArgs($instant,$parameters);
                echo "receive: {$rs}\n";
                $server->send($fd,  $rs);
                $server->close($fd);
            }else if($data["rpcType"] == "http"){
                $client = new Client();
                $http = config("remote")[$data["interface"]]["http"];
                $url = $http["host"].":".$http["port"]."/".$data["url"];
                if(strtoupper($http["mehtod"]) == "GET"){
                    $res = $client->request('GET', $url, [
                        'query' => $parameters,
                    ]);
                }else if(strtoupper($http["mehtod"]) == "POST"){
                    $res = $client->request('POST',  $url,[
                        'form_params'  => $parameters
                    ] );
                }
                $server->send($fd,  $res);
            }else if($data["rpcType"] == "socketAsync"){

            }
            
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