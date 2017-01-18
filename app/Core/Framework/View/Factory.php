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

        $view = $this->moduleView($view);

        $path = $this->finder->find($view);

        $data = array_merge($mergeData, $this->parseData($data));

        $this->callCreator($view = new View($this, $this->getEngineFromPath($path), $view, $path, $data));

        return $view;
    }
    public function moduleView($view){

        if(is_mobile()){
            $paths = [
                app()["module"].".wap.$view",
                app()["module"].".$view",
                app()["module"].".pc.$view",
                $view
            ];
            foreach ($paths as $path){
                if($this->exists($path)){
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
                if($this->exists($path)){
                    $view = $path;
                    break;
                }
            }
        }
        return $view;
    }
}
