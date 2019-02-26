<?php
namespace App\Http\Module\User\Index\Controllers;
use App\Http\Controllers\AdminController;
use App\Http\Module\Blog\Bll\BlogArticleBll;
use App\Http\Module\Blog\Model\BlogArticleModel;
use App\Http\Module\Web\Controllers\WebController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class UserController extends WebController{
    function __construct()
    {
        //todo 权限相关
        $this->middleware('auth');
        parent::__construct();
    }
}