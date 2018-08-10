<?php
namespace Rpc;

use Rpc\Client\Client;

class Rpc {
    /**
     * @var RpcClient
     */
    private $client;
    private $interface;
    private $method;
    private $args;
    function __construct($interface,Client $client)
    {
        $this->interface = $interface;
        $this->client = $client;
        $this->client->setRpc($this);
    }


    function __call($name, $args)
    {
        $this->method = $name;
        $this->args = $args;
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
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $arguments
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }



}