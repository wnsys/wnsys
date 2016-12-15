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
class TopicController extends Controller{
    function index(){
       echo "欢迎来到韦宁的空间";

    }
    function addBlog(){
        echo "添加博客";
        return view("blog.admin.add");
    }
}