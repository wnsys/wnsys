<?php
namespace Rpc\Client;
abstract  class Client{
    /**
     * @var Rpc
     */
    public $rpc;
    public $rpcType;
    abstract function send();
    function getRpcData(){
        return \GuzzleHttp\json_encode([
            "interface"=>$this->rpc->getInterface(),
            "method"=>$this->rpc->getMethod(),
            "args"=>$this->rpc->getArgs(),
            "rpcType"=>$this->rpcType
        ]);
    }

    /**
     * @return Rpc
     */
    public function getRpc()
    {
        return $this->rpc;
    }

    /**
     * @param Rpc $rpc
     */
    public function setRpc(&$rpc)
    {
        $this->rpc = $rpc;
    }

}