<?php
namespace App\Module\Blog\Controllers;
use App\Http\Controllers\Controller;
use App\Model\TopicModel;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class AdminController extends Controller{
    function index(){

        return view("blog.admin.list");
    }
    function addBlog(Request $request){
        if($request["dosubmit"]){
            
        }
        return view("blog.admin.add");
    }

}