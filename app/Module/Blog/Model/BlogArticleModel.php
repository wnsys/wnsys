<?php
namespace App\Module\Blog\Model;

use App\Model\AppModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\Facades\Image;

class BlogArticleModel extends AppModel
{
    use SoftDeletes;
    protected $table = "blog_article";
    protected $fillable = [
        'title', 'catid', 'content', "attach",
    ];
    protected $hidden = [

    ];
    public function modelSave($info)
    {
        if(!$info["title"]){
            $info["title"] = mb_substr(strip_tags($info["content"]),0,20);
        }
        if($this->id){
            $rs = $this->update($info);
        }else{
            $rs = $this->create($info);
            $rs = $rs->id;
        }
        return $rs;
    }

    static public function lists($catid)
    {
        $rs = static::whereIn("catid", BlogCategoryModel::subIds($catid))->orderBy("id", "desc")->paginate(10);
        return $rs;
    }

    public function cat()
    {
        return $this->hasOne("App\Module\Blog\Model\BlogCategoryModel", "id", "catid");
    }

    public function image()
    {
        if ($this->id) {
            $condtion["module"] = "blog";
            $condtion["pk_type"] = "article";
            $condtion["pk_id"] = $this->id;
            $condtion["user_id"] = Auth::id();
            $image = BlogImageModel::Where($condtion)->get();
        } else {
            $image = new BlogImageModel();
        }
        return $image;
    }
}
