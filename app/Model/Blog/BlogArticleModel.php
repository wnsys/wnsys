<?php
namespace App\Model\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogArticleModel extends Model
{
    protected $table = "blog_article";
    protected $fillable = [
        'title', 'category', 'content',
    ];
    protected $hidden = [

    ];
}
