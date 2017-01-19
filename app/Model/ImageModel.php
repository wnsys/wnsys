<?php
namespace App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\ImageManagerStatic;

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
        'url',
        "size",
        "sort"
    ];
    protected $hidden = [

    ];
    public function thumb($w,$h){
        if ('/' == $this->url[0]) {
            $file = substr($this->url,1);
        }else{
            $file = $this->url;
        }
        $arr_url = explode(".",$file);
        $thumb_file = $arr_url[0]."_{$w}_{$h}.".$arr_url[1];
        if (!app("files")->exists($thumb_file)) {
            ImageManagerStatic::make($file)->resize($w, $h)->save($thumb_file);
        }
        $result = "/".$thumb_file;
        return $result;
    }
}