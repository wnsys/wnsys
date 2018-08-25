<?php
namespace App\Http\Module\Admin\Model;
use App\Model\AppModel;
class RoleUserModel extends AppModel
{
    protected $table = "role_user";
    protected $fillable = [
        "role_id","user_id"
    ];
    protected $hidden = [

    ];
    public function role()
    {
        return $this->hasOne(RoleModel::class,"id","role_id");
    }
}
