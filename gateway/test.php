<?php
/*$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function(swoole_client $cli) {
    $cli->send(json_encode(["test"=>1]));
});
$client->on("receive", function(swoole_client $cli, $data){
    print_r(json_decode($data,true));
    echo "Receive: ".print_r($data,true);
});
$client->on("error", function(swoole_client $cli){
    echo "error\n";
});
$client->on("close", function(swoole_client $cli){
    echo "Connection close\n";
});
$client->connect('127.0.0.1', 9601);*/
/*$client = new \swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9602, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
$data = [
    "interface"=>\NInterface\BlogInterface::class,
    "method"=>"getList",
    "arguments"=>[1,2]
];
$client->send(json_encode($data));
$rs = $client->recv();
$client->close();*/
class test{
    function __call($mehtod,$args){
        print_r($args);
    }
}
$test = new test();
$test->hello($a=1,$b=2);
?>
