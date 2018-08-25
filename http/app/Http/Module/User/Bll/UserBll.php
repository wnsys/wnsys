<?php
namespace App\Http\Module\User\Bll;

use App\Core\Framework\CrmBll;
use App\Http\Module\Admin\Model\RoleUserModel;

class UserBll extends CrmBll
{
    function getRole($userId){
        $rs = RoleUserModel::where(["user_id"=>$userId])->first();
        return $rs->role;
    }
    function isAdmin($userId){
        $role = $this->getRole($userId);
        return $role["name"] == "管理员";
    }
}