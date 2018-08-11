<?php
namespace Rpc\Server\Lib;

use GuzzleHttp\Client;

class GatewaySocketLib
{

    public static $instance;

    function __construct($options)
    {
        $server = new \swoole_server($options["host"], $options["port"]);
        $server->set($options);
        $server->on('connect', function ($server, $fd) {
            echo "connection open: {$fd}\n";
        });
        /**
         * $data["interface"];
         * $data["method"];
         * $data["args"];
         * $data["rpcType"];
         */
        $server->on('receive', function ($server, $fd, $reactor_id, $_data) {
            $data = \GuzzleHttp\json_decode($_data, true);
            $class = new \ReflectionClass($data["interface"]);
            $method = $class->getMethod($data["method"]);
            $dependencies = $method->getParameters();
            // 处理，把传入的索引数组变成关联数组， 键为函数参数的名字
            $parameters = [];
            foreach ($data["args"] as $key => $value) {
                if (is_numeric($key))
                    $parameters[$dependencies[$key]->name] = $value;
            }
            switch ($data["rpcType"]) {
                case "socketSync":
//                    $concrete = config("remote")["socket"]["interface"][$data["interface"]]["concrete"];
//                    $class = new \ReflectionClass($concrete);
//                    $instant = $class->newInstance();
//                    $method = $class->getMethod($data["method"]);
//                    $rs = $method->invokeArgs($instant,$parameters);
//                    $server->send($fd,  $rs);
//                    $server->close($fd);
                    $hosts = config("hosts")["socket"];
                    //随机取一台服务器
                    $host = $hosts[rand(0, count($hosts) - 1)];
                    $client = new \swoole_client(SWOOLE_SOCK_TCP);
                    if (!$client->connect($host["ip"], $host["port"], -1)) {
                        exit("connect failed. Error: {$client->errCode}\n");
                    }
                    $rs = $client->send($_data);
                    $server->send($fd, $rs);
                    $server->close($fd);
                    break;
                case "http":
                    $client = new Client();
                    $hosts = config("hosts")["http"];
                    //随机取一台服务器
                    $host = $hosts[rand(0, count($hosts) - 1)];
                    $concrete = config("interfaces")[$data["interface"]]["http"];
                    $url = $host["host"] . ":" . $host["port"] . "/" . $concrete["url"];
                    if (strtoupper($concrete["method"]) == "GET") {
                        $rs = $client->request('GET', $url, [
                            'query' => $parameters,
                        ]);
                    } else if (strtoupper($concrete["method"]) == "POST") {
                        $rs = $client->request('POST', $url, [
                            'form_params' => $parameters
                        ]);
                    }
                    $res = $rs->getBody()->getContents();
                    return $server->send($fd, $res);
                    break;
                case "socketAsync":
                    break;
            }

        });
        $server->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });
        $server->start();
    }

    
}