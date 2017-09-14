<?php
namespace App\Http\Middleware;
use App\Module\User\Bll\UserBll;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin{
    public function handle($request, Closure $next)
    {

        if(!UserBll::n()->isAdmin(Auth::id())){
             header('Location: /');
             exit;
         }
        return $next($request);
    }
}