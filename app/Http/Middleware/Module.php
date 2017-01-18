<?php
namespace App\Http\Middleware;
use Closure;
class Module{
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $action = $route->getAction();
        $paths = explode("\\",$action["namespace"]);
        if(in_array("Module",$paths)){
            app()["module"] = strtolower($paths[2]);
        }else{
            app()["module"] = "";
        }
        return $next($request);
    }
}