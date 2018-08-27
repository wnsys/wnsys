<?php
namespace Server\Client;

class SocketAsyncClient extends Client  {
    private $client;
    private $msg;
    private $receive,$error,$close;
    function __construct()
    {
        $this->rpcType = "socketAsync";
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
    }

    function send(){
        $this->client->on("connect", function(\swoole_client $cli) {
            $cli->send($this->getRpcData());
        });
        $this->client->on("receive", function(\swoole_client $cli, $data){
            if(is_callable($this->receive)){
                $this->receive($cli,$data);
            }
        });
        $this->client->on("error", function(\swoole_client $cli){
            echo "error\n";
            if(is_callable($this->error)){
                $this->error($cli);
            }
        });
        $this->client->on("close", function(\swoole_client $cli){
            echo "Connection close\n";
            if(is_callable($this->close)){
                $this->close($cli);
            }
        });
        $conf = config("hosts")["gateway"];
        if (!$this->client->connect($conf["host"], $conf["port"], -1))
        {
            exit("connect failed. Error: {$this->client->errCode}\n");
        }
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

    /**
     * @return mixed
     */
    public function getReceive()
    {
        return $this->receive;
    }

    /**
     * @param mixed $receive
     */
    public function setReceive($receive)
    {
        $this->receive = $receive;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * @param mixed $close
     */
    public function setClose($close)
    {
        $this->close = $close;
    }

}