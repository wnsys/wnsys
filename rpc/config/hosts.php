<?php

return [
    "gateway" => [
        [
            // like pm.start_servers in php-fpm, but there's no option like pm.max_children
            'worker_num' => 1,
            // max number of coroutines handled by a worker in the same time
            'max_coro_num' => 3000,
            // set it to false when debug, otherwise true
            'daemonize' => false,
            // like pm.max_requests in php-fpm
            'max_request' => 1000,
            'pid_file' => app()->basePath()."/bootstrap/swoole-gateway-9800.pid",
            'log_file' => app()->storagePath().'/logs/swoole.log',
            "port" => 9801,
            "host" => '127.0.0.1'
        ],
    ],
    "http" => [
        [
            "port" => '9600',
            "host" => "127.0.0.1"
        ],
        [
            "port" => '9601',
            "host" => "127.0.0.1"
        ],
    ],
    "socket" => [
        [
            "port" => '9700',
            "host" => "127.0.0.1"
        ],
        [
            "port" => '9701',
            "host" => "127.0.0.1"
        ],
    ]
];