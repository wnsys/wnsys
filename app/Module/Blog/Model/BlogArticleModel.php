<?php
namespace App\Module\Blog\Model;

use App\Model\AppModel;
use App\Model\Common\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;

class BlogArticleModel extends AppModel
{
    use SoftDeletes;
    use ImageTrait;
    protected $table = "blog_article";
    protected $pk_type = "article";
    protected $fillable = [
        'title', 'catid', 'content', "attach","user_id"
    ];
    protected $hidden = [

    ];
    public function modelSave($info)
    {
        if(!$info["title"]){
            $info["title"] = mb_substr(strip_tags($info["content"]),0,30);
        }
        $info["user_id"] = Auth::id();
        if($id = $info["id"]){
            $model = self::find($id);
            $model->fill($info);
            $model->save();
        }else{
            $model = self::firstOrCreate($info);
        }
        return $model;
    }

    static public function lists($catid)
    {
        $rs = static::whereIn("catid", BlogCategoryModel::n()->subIds($catid))
            ->orderBy("id", "desc")
            ->paginate(config("module.blog.page_size"));
        return $rs;
    }

    public function cat()
    {
        return $this->hasOne("App\Module\Blog\Model\BlogCategoryModel", "id", "catid");
    }


}
