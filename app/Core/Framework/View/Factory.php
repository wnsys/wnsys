<?php

namespace App\Core\Framework\View;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
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
        $view = $this->moduleView($view);
        $path = $this->finder->find(
            $view = $this->normalizeName($view)
        );

        // Next, we will create the view instance and call the view creator for the view
        // which can set any data, etc. Then we will return the view instance back to
        // the caller for rendering or performing other view manipulations on this.
        $data = array_merge($mergeData, $this->parseData($data));

        return tap($this->viewInstance($view, $path, $data), function ($view) {
            $this->callCreator($view);
        });
    }
    public function moduleView($view){

        if(is_mobile()){
            $paths = [
                app()["module"].".wap",
                app()["module"].".pc",
                app()["module"],
                ""
            ];
        }else{
            $paths = [
                app()["module"].".pc",
                app()["module"].".wap",
                app()["module"],
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
