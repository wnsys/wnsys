<?php

return [
    \Interfaces\BlogInterface::class => [
        "http" => [
            "method" => "get",
            "url" => "/blog/list",

        ],
        "socket" => [
            "concrete" => \Service\Service\BlogService::class,
        ]
    ]

];