<?php
namespace App\Model;

class PermissionRelateModel extends AppModel{
    protected $table = "permission_relate";
    protected $fillable = [
        "permission_id",
        "pk_id",
        "type",
    ];
    protected $hidden = [

    ];
}