<?php

namespace App\Core\Framework\View;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\View\Factory as CoreFactory;
use Illuminate\View\View;
class Factory extends CoreFactory
{

    public function make($view, $data = [], $mergeData = [])
    {
        if (isset($this->aliases[$view])) {
            $view = $this->aliases[$view];
        }

        $view = $this->normalizeName($view);
        //加上模块目录，扫描多个文件夹
        $view = $this->moduleView($view);

        $path = $this->finder->find($view);

        $data = array_merge($mergeData, $this->parseData($data));

        $this->callCreator($view = new View($this, $this->getEngineFromPath($path), $view, $path, $data));

        return $view;
    }
    public function moduleView($view){
        if(is_mobile()){
            $paths = [
                app()["module"].".wap",
                app()["module"],
                app()["module"].".pc",
                ""
            ];
        }else{
            $paths = [
                app()["module"],
                app()["module"].".pc",
                app()["module"].".wap",
                ""
            ];
        }
        foreach ($paths as $path){
            $filePath = $path.".$view";
            if($this->exists($filePath)){
                $view = $filePath;
                break;
            }
        }
        return $view;
    }
}
