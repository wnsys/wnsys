<?php
namespace Rpc;
use GuzzleHttp\Client;
use Rpc\Ninterface\ClientInterface;

class HttpClient extends RpcClient implements ClientInterface{
    private $client;
    function __construct()
    {
        $this->rpcType = "http";
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP);
        if (!$this->client->connect('127.0.0.1', 9500, -1))
        {
            exit("connect failed. Error: {$this->client->errCode}\n");
        }

    }

    function send(){
        $this->client->send($this->getRpcData());
        $rs = $this->client->recv();
        $this->client->close();
        return $rs;
    }

}