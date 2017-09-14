<?php
namespace App\Module\Admin\Bll;

use App\Core\Bll\FormBll;
use App\Core\Framework\Object;
use App\Module\Admin\Model\PermissionModel;
class PermissionBll extends Object
{
    function treeLists()
    {
        $str = "<tr>
                        <td>\$spacer\$name</td>
                        <td><span class='glyphicon glyphicon-pencil'></span>
                            <a data-id='\$id' class='edit' href='javascript:void(0)' >编辑</a>
                            &nbsp;&nbsp;
                            <span class='glyphicon glyphicon-minus'></span>
                           <a href='/admin/permission/delete?id=\$id' href='javascript:void(0)' >删除</a></td>
                 </tr>";

        $data = PermissionModel::all()->toArray();
        foreach ($data as $item) {
            $result[$item["id"]] = $item;
        }
        return FormBll::n()->treeLists($result, $str);
    }
}