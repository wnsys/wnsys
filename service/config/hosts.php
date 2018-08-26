<?php

return [
    "http" => [
        createOptions("http",9600),
        createOptions("http",9601)
    ],
    "socket" => [
        createOptions("socket",9700),
        createOptions("socket",9701)
    ]
];