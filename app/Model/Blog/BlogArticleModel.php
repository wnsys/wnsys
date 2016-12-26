<?php
namespace App\Model\Blog;
use App\Model\WnModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleModel extends WnModel
{
    use SoftDeletes;
    protected $table = "blog_article";
    protected $fillable = [
        'title', 'catid', 'content',
    ];
    protected $hidden = [

    ];
    public function cat(){
       return  $this->hasOne("App\Model\Blog\BlogCategoryModel","id","catid");
    }
}
