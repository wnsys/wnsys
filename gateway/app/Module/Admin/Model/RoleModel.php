<?php
namespace App\Module\Admin\Model;
use App\Model\AppModel;
class RoleModel extends AppModel
{
    protected $table = "role";
    protected $fillable = [
        "name"
    ];
    protected $hidden = [

    ];
}
