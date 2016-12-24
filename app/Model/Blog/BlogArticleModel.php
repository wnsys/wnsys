<?php
namespace App\Model\Blog;
use App\Model\WnModel;

class BlogArticleModel extends WnModel
{
    protected $table = "blog_article";
    protected $fillable = [
        'title', 'category', 'content',
    ];
    protected $hidden = [

    ];
}
