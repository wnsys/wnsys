<?php

function is_mobile(){
    return (new \Mobile_Detect())->isMobile();
}
function myLog($content,$path = "wnsys.log"){
    $path = app()->basePath()."/logs/".$path;
    $dir = substr($path,0,strripos($path,"/"));
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
        chmod($dir,0777);
    }
    $log = new \Monolog\Logger('wnsys');
    $fomat = "[%datetime%]:%message%\n";
    $handler = new \Monolog\Handler\StreamHandler($path);
    $handler->setFormatter(new \Monolog\Formatter\LineFormatter($fomat));
    $log->pushHandler($handler);
    return $log->addInfo($content);
}
function seo($title = "",$keywords="",$description=""){
    $seo["title"] = $title?$title." | ".config("app.name"):config("app.name");
    $seo["keywords"] = $keywords?:$title;
    $seo["description"] = $description?:$title;
    view()->share('seo', $seo);
}
function getPid($listen_port,$pid_file){
    $pid = 0;
    try {
        if (is_file($pid_file))
            $pid = (int)file_get_contents($pid_file);
    } catch (\Throwable $e) {
        print("pid can not be read from $pid_file \n");
    }
    return $pid;
}
function domain(){
   $host = $_SERVER['HTTP_HOST'];
    return explode(".",$host);
}
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