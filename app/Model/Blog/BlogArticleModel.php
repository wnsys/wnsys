<?php
namespace App\Model\Blog;
use App\Model\AppModel;
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
    public function cat(){
       return  $this->hasOne("App\Model\Blog\BlogCategoryModel","id","catid");
    }
}
