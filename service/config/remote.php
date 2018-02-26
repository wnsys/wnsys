<?php
/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 11:59
 */
return [
    \NInterface\BlogInterface::class => [
        "socket"=>\Service\Service\BlogService::class,
        "http"=>"127.0.0.1:80/blog/"
    ]
];