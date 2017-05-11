<?php
namespace App\Module\User\Controllers\Index;
use App\Http\Controllers\AdminController;
use App\Module\Blog\Bll\BlogArticleBll;
use App\Module\Blog\Model\BlogArticleModel;
use App\Module\Web\Controllers\WebController;
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