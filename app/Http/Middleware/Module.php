<?php
namespace App\Http\Middleware;
use Closure;
class Module{
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $action = $route->getAction();
        $paths = explode("\\",$action["controller"]);

        if(in_array("Module",$paths)){
            app()["module"] = strtolower($paths[2]);
        }else{
            app()["module"] = "";
        }
        $controller = $paths[count($paths)-1];
        $controller = substr($controller,0,strpos($controller,"Controller"));
        app()["controller"] = strtolower($controller);
        return $next($request);
    }
}