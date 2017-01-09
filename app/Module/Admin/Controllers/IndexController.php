<?php
namespace App\Module\Admin\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController{
    use AuthenticatesUsers;
    private $redirectTo;
    protected function authenticated(Request $request, $user)
    {
        //
    }
    public function index(){

        return view("admin.index");
    }
    public function setting(){

        return view("admin.setting");
    }
    public function  avatar(){

    }
}