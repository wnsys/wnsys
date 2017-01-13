<?php
namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRelateModel extends AppModel
{
    use SoftDeletes;
    protected $table = "permission_relate";
    protected $pk_type = "role";
    protected $fillable = [
        "permission_id",
        "pk_id",
        "pk_type",
    ];
    protected $hidden = [

    ];

     function get($id)
    {
        $data = static::where(["pk_id" => $id, "pk_type" => $this->pk_type])->first();
        return $data;
    }
}