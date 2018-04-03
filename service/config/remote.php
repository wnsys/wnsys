<?php
/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 11:59
 */
return [
    "socket"=>[
        "host"=>"127.0.0.1",
        "port"=>"9501",
        "interface"=>[
            \NInterface\BlogInterface::class =>[
                "concrete"=>\Service\Service\BlogService::class,
            ]
        ]
    ],
    "http"=>[
        "host"=>"127.0.0.1",
        "port"=>"9602",
        "interface"=>[
            \NInterface\BlogInterface::class => [
                "method"=>"get",
                "url"=>"/blog/list"
            ],
        ]

    ]
];