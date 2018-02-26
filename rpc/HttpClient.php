<?php
namespace Rpc;
use GuzzleHttp\Client;
use Rpc\Ninterface\ClientInterface;

class HttpClient extends RpcClient implements ClientInterface{
    private $client;
    private $url;
    private $host;
    function __construct()
    {
        $this->client = new Client();
        $this->rpcType = "http";
    }

    function send(){
        if(strtoupper($this->rpc->getMethod()) == "GET"){
            $res = $this->client->request('GET', $this->url, [
                'query' => $this->rpc->getArguments(),
            ]);
        }else if(strtoupper($this->rpc->getMethod()) == "POST"){
            $res = $this->client->request('POST',  $this->url,[
                'form_params'  => $this->rpc->getArguments()
            ] );
        }
        $info = $res->getBody();
        return $info;
    }

}