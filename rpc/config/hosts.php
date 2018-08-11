<?php
function createOptions($type,$port,$host= "127.0.0.1"){
    return  [
        // like pm.start_servers in php-fpm, but there's no option like pm.max_children
        'worker_num' => 1,
        // max number of coroutines handled by a worker in the same time
        'max_coro_num' => 3000,
        // set it to false when debug, otherwise true
        'daemonize' => false,
        // like pm.max_requests in php-fpm
        'max_request' => 1000,
        'pid_file' => app()->basePath()."/bootstrap/swoole-$type-".$port.".pid",
        'log_file' => app()->storagePath().'/logs/swoole.log',
        "port" => $port,
        "host" => $host
    ];
}
return [
    "gateway" => [
        createOptions("gateway",9800),
    ],
    "http" => [
        createOptions("http",9600),
        createOptions("http",9601)
    ],
    "socket" => [
        createOptions("socket",9700),
        createOptions("socket",9701)
    ]
];