<?php
namespace App\Http\Middleware;
use Closure;
class Module{
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $action = $route->getAction();
        $paths = explode("\\",$action["controller"]);
        // paths = Array ( [0] => App [1] => Http [2] => Module [3] => Blog [4] => Admin [5] => Controllers [6] => CategoryController@add )
        if(in_array("Module",$paths)){
            app()["module"] = strtolower($paths[3]);
        }else{
            app()["module"] = "";
        }
        $controller = $paths[count($paths)-1];
        $controller = substr($controller,0,strpos($controller,"Controller"));
        app()["controller"] = strtolower($controller);
        return $next($request);
    }
}