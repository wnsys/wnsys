<?php
/**
 * Created by wnsys.
 * User: weining
 * email: 178441367@qq.com
 * Date: 2017/2/21 0021
 * Time: 9:57
 */

namespace App\Core\Bll;

use App\Core\Framework\Object;
use App\Core\Libs\Tree;

class FormBll extends Object
{
    function treeLists($data, $tpl, $top = 0)
    {
        $tree = new Tree();
        $tree->init($data);
        return $tree->get_tree($top, $tpl);
    }
}