<?php
use Illuminate\Contracts\View\Factory as ViewFactory;
//重写一些系统的函数
/**
 * Get the evaluated view contents for the given view.
 *
 * @param  string  $view
 * @param  array   $data
 * @param  array   $mergeData
 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
 */
function view($view = null, $data = [], $mergeData = [])
{
    $factory = app(ViewFactory::class);
    if (func_num_args() === 0) {
        return $factory;
    }

    if(is_mobile()){
        $paths = [
            app()["module"].".wap.$view",
            app()["module"].".$view",
            app()["module"].".pc.$view",
            $view
        ];
        foreach ($paths as $path){
            if($factory->exists($path)){
                $view = $path;
                break;
            }
        }
    }else{
        $paths = [
            app()["module"].".$view",
            app()["module"].".pc.$view",
            app()["module"].".wap.$view",
            $view
        ];
        foreach ($paths as $path){
            if($factory->exists($path)){
                $view = $path;
                break;
            }
        }
    }
    return $factory->make($view, $data, $mergeData);
}