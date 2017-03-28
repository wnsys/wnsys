<?php
namespace App\Module\User\Controllers;
use App\Module\Web\Controllers\WebController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends WebController{
    use AuthenticatesUsers;
    protected $redirectTo = '/user/home';
    public function showLoginForm(){
        $urlLogin = "/user/login";
        return view("auth.login",[
            'urlLogin' => $urlLogin
        ]);
    }
    public function username(){
        return "user_name";
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ]);

    }
}