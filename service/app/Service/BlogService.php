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
    /**
     * @param string $id
     * @param string $title
     * @return string
     */
    function getList($id="",$title="")
    {
        return "success";
        // TODO: Implement getList() method.
    }
}