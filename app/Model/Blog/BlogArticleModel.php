<?php
namespace App\Model;
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
