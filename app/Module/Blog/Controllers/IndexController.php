<?php
namespace App\Module\Blog\Controllers;
use App\Http\Controllers\Controller;
use App\Model\TopicModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class IndexController extends Controller{
    function index(){
        return view("blog.web.index");
    }
}