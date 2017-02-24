<?php
namespace App\Module\Shop\Model;

use App\Model\AppModel;
use App\Model\Common\ImageTrait;
use Illuminate\Http\Request;

class ShopProductModel extends AppModel
{
    use ImageTrait;
    protected $table = "shop_product";
    protected $fillable = [
        "name","content","catid","price","description"
    ];
    protected $hidden = [

    ];
    public function modelSave(Request $request){
        if(!$request["name"]){
            $request["name"] = mb_substr(strip_tags($request["content"]),0,30);
        }
        if($this->id){
            $rs = $this->update($request->all());
        }else{
            $rs = $this->create($request->all());
            $rs = $rs->id;
        }
    }
    public function cat()
    {
        return $this->hasOne(ShopCategoryModel::class, "id", "catid");
    }
}
