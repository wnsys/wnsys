<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppModel extends Model
{
    protected $table = "";
    protected $fillable = [
        
    ];
    protected $hidden = [

    ];
    static function model(){
        static $install;
        if($install)
            return $install;
        else
            return new static();
    }
}
