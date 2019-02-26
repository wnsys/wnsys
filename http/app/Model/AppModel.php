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
    static function n(){
        static $install;
        if($install)
            return $install;
        else
            return $install = new static();
    }
   static function saveOrCreate($data){
       if($id = $data["id"]){
           $model = self::find($id);
       }else{
           $model = new static;
       }
       $model = $model->fill($data);
       $model->save();
       return $model;
   }
}
