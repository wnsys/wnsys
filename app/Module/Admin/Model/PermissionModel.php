<?php
namespace App\Module\Admin\Model;

use App\Model\AppModel;
use App\Model\Common\ParentModel;

class PermissionModel extends AppModel{
    use ParentModel;
    protected $table = "permission";
    protected $fillable = [
        "code",
        "name",
        "parentid",
        "parentids",
    ];
    protected $hidden = [

    ];
}