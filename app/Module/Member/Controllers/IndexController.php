<?php
namespace App\Module\Member\Controllers;
use App\Model\Blog\BlogArticleModel;
use App\Module\Web\Controllers\WebController;
use Illuminate\Support\Facades\Auth;

class IndexController extends WebController{
    public function home(){

        return view("member.home.index",[
        ]);
    }
}