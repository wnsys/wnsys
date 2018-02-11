<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
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
$client->connect('127.0.0.1', 9601);

?>
