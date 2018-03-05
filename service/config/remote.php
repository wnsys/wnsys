<?php
/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 11:59
 */
return [
    \NInterface\BlogInterface::class => [
        "socket"=>[
            "host"=>"127.0.0.1",
            "port"=>"9601",
            "concrete"=>\Service\Service\BlogService::class,
        ],
        "http"=>[
            "host"=>"127.0.0.1",
            "port"=>"9602",
            "method"=>"get",
            "url"=>"/blog/list"
        ]
    ]
];