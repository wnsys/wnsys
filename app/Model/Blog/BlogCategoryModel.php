<?php
namespace App\Model\Blog;

use App\Core\Libs\Tree;
use App\Model\AppModel;

class BlogCategoryModel extends AppModel
{
    protected $table = "blog_category";
    protected $fillable = [
        'name', 'parent_id', 'parent_ids',
    ];
    protected $hidden = [

    ];

    static public function options($selected = 0)
    {
        $data = static::all()->toArray();
        $result = [];
        foreach ($data as $item){
            $result[$item["id"]] = $item;
        }
        $first = ' <option value="0">未选择</option>';
        $str = "<option value=\$id \$selected>\$spacer\$name</option>";
        $tree = new Tree();
        $tree->init($result);
        return $first.$tree->get_tree(0,$str,$selected);
    }
    static public function lists()
    {
        $data = static::all()->toArray();
        foreach ($data as $item){
            $result[$item["id"]] = $item;
        }
        $str = "\$spacer<a href='/admin/blog/category/edit/\$id'>\$name</a><br>";
        $tree = new Tree();
        $tree->init($data);
        return $tree->get_tree(0,$str);
    }
}
