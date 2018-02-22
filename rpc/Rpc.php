<?php
namespace Rpc;
use Rpc\Ninterface\RpcInterface;

class Rpc {
    /**
     * @var RpcInterface
     */
    private $client;
    private $interface;
    private $method;
    private $arguments;
    function __construct()
    {
        $this->client = new SocketSyncClient($this);
    }


    function __call($name, $arguments)
    {
        $this->method = $name;
        $this->arguments = $arguments;
        return $this->client->send();
        // TODO: Implement __call() method.
    }

    /**
     * @return mixed
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * @param mixed $interface
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param mixed $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }



}