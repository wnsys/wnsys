<?php
namespace App\Module\Web\Controllers;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 14:50
 */
class IndexController extends Controller{
    public function index(){
        return view("web.index");
    }
}