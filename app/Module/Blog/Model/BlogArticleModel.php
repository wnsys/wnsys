<?php
namespace App\Module\Blog\Model;
use App\Model\AppModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleModel extends AppModel
{
    use SoftDeletes;
    protected $table = "blog_article";
    protected $fillable = [
        'title', 'catid', 'content',"attach",
    ];
    protected $hidden = [

    ];
    public function lists($catid){
        BlogCategoryModel::
    }
    public function cat(){
       return  $this->hasOne("App\Module\Blog\Model\BlogCategoryModel","id","catid");
    }
    public function image(){
        if($this->id){
            $condtion["module"] = "blog";
            $condtion["pk_type"] = "article";
            $condtion["pk_id"] = $this->id;
            $condtion["user_id"] = Auth::id();
            $image = BlogImageModel::Where($condtion)->get();
        }else{
            $image = new BlogImageModel();
        }
        return $image;
    }
}
