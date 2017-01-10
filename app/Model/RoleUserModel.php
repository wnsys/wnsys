<?php
namespace App\Model;

class RoleUserModel extends AppModel
{
    protected $table = "role_user";
    protected $fillable = [
        "role_id","user_id"
    ];
    protected $hidden = [

    ];
}
