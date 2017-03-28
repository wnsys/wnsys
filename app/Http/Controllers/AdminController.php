<?php

namespace App\Http\Controllers;

use App\Module\User\Bll\UserBll;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        if(!UserBll::n()->isAdmin(Auth::id())){
            header('Location: /');
            exit;
        }
    }
}
