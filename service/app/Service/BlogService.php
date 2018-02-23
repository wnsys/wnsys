<?php
namespace Service\Service;
use NInterface\BlogInterface;

/**
 * Created by PhpStorm.
 * User: weining
 * Date: 2018/2/12
 * Time: 12:01
 */
class BlogService implements BlogInterface{
    function getList($options = "")
    {
        return "success";
        // TODO: Implement getList() method.
    }
}