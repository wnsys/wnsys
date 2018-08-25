<?php

return [
    "gateway" => [
        createOptions("gateway",9800),
    ],
    "http" => [
        createOptions("http",9600,"114.55.85.54"),
        createOptions("http",9601)
    ],
    "socket" => [
        createOptions("socket",9700),
        createOptions("socket",9701)
    ]
];