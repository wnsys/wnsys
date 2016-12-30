<?php
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ImageModel extends AppModel{
    use SoftDeletes;
    protected $table = "image";
    protected $fillable = [
        'module',
        'user_id',
        "pk_id",
        'pk_type',
        'title',
        "state",
        "type",
        'original',
        "size",
    ];
    protected $hidden = [

    ];
}