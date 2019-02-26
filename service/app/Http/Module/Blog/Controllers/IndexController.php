<?php
namespace Service\Http\Module\Blog\Controllers;
use Illuminate\Http\Request;
use Service\Http\Controllers\Controller;

class IndexController extends Controller{
    public function getList(Request $request){
        $rs = "http:id:".$request["id"].",title:".$request["title"];
        return $rs;
    }
}