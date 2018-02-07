#!/usr/bin/env php
<?php
define("ROOT_PATH",dirname(__DIR__));
require ROOT_PATH.'/bootstrap/autoload.php';
require "HttpServer.php";
switch ($argv[1]) {
    case 'start':
        HttpServer::getInstance();
        break;
    case 'stop':
        posix_kill(getPid(), SIGTERM);
        break;
    case 'reload':
        posix_kill(getPid(), SIGUSR1);
        break;
    case 'restart':
        posix_kill(getPid(), SIGTERM);
        sleep(1);
        HttpServer::getInstance();
        break;
}
function getPid($listen_port = 9501){
    $pid_file = ROOT_PATH .'/bootstrap/laravel-fly-' . $listen_port . '.pid';
    $pid = 0;
    try {
        if (is_file($pid_file))
            $pid = (int)file_get_contents($pid_file);
    } catch (Throwable $e) {
        print("pid can not be read from $pid_file \n");
    }
    return $pid;
}