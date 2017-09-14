<?php
namespace App\Model\Common;

use Illuminate\Support\Facades\Auth;
use App\Model\ImageModel;
trait ImageTrait{
    public function image()
    {
        if ($this->id) {
            $condtion["pk_id"] = $this->id;
            $condtion["pk_type"] = $this->pk_type;
            $image = ImageModel::where($condtion)->orderBy("sort","desc")->get();
        } else {
            $image = new ImageModel();
        }
        return $image;
    }

}
