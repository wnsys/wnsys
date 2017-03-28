<?php

namespace App\Http\Controllers\Auth;

use App\Model\UserModel;
use App\Module\User\Bll\UserBll;
use App\Module\Web\Controllers\WebController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends WebController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout']);
        Validator::extend('admin', function($attribute, $value, $parameters, $validator) {
            $user = UserModel::where(["user_name"=>$value])->first();
            if($user){
                $role = UserBll::n()->getRole($user["id"]);
                return $role["name"] == "管理员";
            }
            return false;
        });
    }
    public function username(){
        return "user_name";
    }
    public function showLoginForm()
    {
        $urlLogin = "/login";
        return view('auth.login',[
            "urlLogin" => $urlLogin
        ]);
    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|admin',
            'password' => 'required',
        ]);

    }

}
