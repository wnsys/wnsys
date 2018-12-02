<?php
namespace Rpc\Client;

class HttpClient extends Client {
    private $client;
    function __construct()
    {
        $this->rpcType = "http";
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP);
        $conf = config("hosts")["gateway"];
        if (!$this->client->connect($conf["host"], $conf["port"], -1))
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