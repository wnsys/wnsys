<?php
namespace Rpc;

class Rpc {
    /**
     * @var RpcClient
     */
    private $client;
    private $interface;
    private $method;
    private $arguments;
    function __construct(RpcClient $client)
    {
        $this->client = $client;
        $this->client->setRpc($this);
    }


    function __call($name, $arguments)
    {
        $this->method = $name;
        $this->arguments = $arguments;
        $rs =  $this->client->send();
        return $rs;
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