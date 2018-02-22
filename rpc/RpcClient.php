<?php
namespace Rpc;
abstract  class RpcClient{
    /**
     * @var Rpc
     */
    public $rpc;
    abstract function send();
    function getRpcData(){
        return \GuzzleHttp\json_encode([
            "interface"=>$this->rpc->getInterface(),
            "method"=>$this->rpc->getMethod(),
            "arguments"=>$this->rpc->getArguments()
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
    public function setRpc($rpc)
    {
        $this->rpc = $rpc;
    }

}