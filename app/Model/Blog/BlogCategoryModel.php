<?php
namespace App\Model\Blog;

use App\Libs\Tree;
use App\Model\WnModel;

class BlogCategoryModel extends WnModel
{
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parent_id', 'parent_ids',
    ];
    protected $hidden = [

    ];

    static public function options()
    {
        $data = static::all()->toArray();
        $str = "<option value=\$id \$selected>\$spacer\$name</option>";
        $tree = new Tree();
        $tree->init($data);
        return $tree->get_tree(0,$str);
    }
}
