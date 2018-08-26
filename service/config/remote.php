<?php
/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 11:59
 */
return [
    "http"=>[
        "host"=>"127.0.0.1",
        "port"=>"9600",
        "interface"=>[
            \Interfaces\BlogInterface::class => [
                "method"=>"get",
                "url"=>"/blog/list"
            ],
        ]
    ],
    "socket"=>[
        "host"=>"127.0.0.1",
        "port"=>"9700",
        "interface"=>[
            \Interfaces\BlogInterface::class =>[
                "concrete"=>\Service\Service\BlogService::class,
            ]
        ]
    ],

];