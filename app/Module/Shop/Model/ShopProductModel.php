<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;
use App\Model\Common\ImageTrait;
use Illuminate\Http\Request;

class ShopProductModel extends AppModel
{
    use ImageTrait;
    protected $table = "shop_product";
    protected $pk_type = "product";
    protected $fillable = [
        "name","content","catid","price","description"
    ];
    protected $hidden = [

    ];
    public function modelSave(Request $request){
        if(!$request["name"]){
            $request["name"] = mb_substr(strip_tags($request["content"]),0,30);
        }
        if($id = $request["id"]){
            $model = self::find($id);
            $model->fill($request->all());
            $model->save();
        }else{
            $model = new self;
            $model->fill($request->all());
            $model->save();
        }
        return $model;
    }
    public function cat()
    {
        return $this->hasOne(ShopCategoryModel::class, "id", "catid");
    }
    
}
