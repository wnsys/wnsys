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