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
function getPid($listen_port){
    $pid_file = app()->basePath() .'/bootstrap/laravel-fly-' . $listen_port . '.pid';
    $pid = 0;
    try {
        if (is_file($pid_file))
            $pid = (int)file_get_contents($pid_file);
    } catch (\Throwable $e) {
        print("pid can not be read from $pid_file \n");
    }
    return $pid;
}