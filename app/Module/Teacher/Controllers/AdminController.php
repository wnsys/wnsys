<?php
namespace App\Module\Teacher\Controllers;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/26 0026
 * Time: 11:36
 */
class AdminController extends \App\Http\Controllers\AdminController{
    function addPaper(){

    }
    function addTopic(){
        return view("topic.admin.addTopic");
    }
}