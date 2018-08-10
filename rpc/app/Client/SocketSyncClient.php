<?php
namespace Rpc\Client;

class SocketSyncClient extends Client {
    private $client;
    function __construct()
    {
        $this->rpcType = "socketSync";
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP);
        if (!$this->client->connect('127.0.0.1', 9800, -1))
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