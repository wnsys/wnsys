<?php
namespace App\Module\Topic\Controllers;
use App\Http\Controllers\Controller;
use App\Model\TopicModel;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class TopicController extends Controller{
    function index(Request $request){
        print_r($request->all());
       echo "欢迎来到韦宁的空间";

    }
}