<?php
namespace App\Model;


class PermissionModel extends AppModel{
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