<?php
namespace Rpc;
use Rpc\Ninterface\ClientInterface;

class SocketSyncClient extends RpcClient implements ClientInterface{
    private $client;
    private $msg;
    function __construct()
    {
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP);
        if (!$this->client->connect('127.0.0.1', 9501, -1))
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

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

}