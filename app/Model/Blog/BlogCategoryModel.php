<?php
namespace App\Model\Blog;
use App\Model\WnModel;

class BlogCategoryModel extends WnModel
{
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parent_id', 'parent_ids',
    ];
    protected $hidden = [

    ];
}
