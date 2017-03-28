<?php
namespace App\Module\User\Bll;

use App\Core\Framework\CrmBll;
use App\Module\Admin\Model\RoleUserModel;

class UserBll extends CrmBll
{
    function getRole($user_id){
        $rs = RoleUserModel::where(["user_id"=>$user_id])->first();
        return $rs->role;
    }
}