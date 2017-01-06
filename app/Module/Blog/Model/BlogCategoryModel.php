<?php
namespace App\Module\Blog\Model;

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

   static function modelSave($catid, $cat_name, $parent_id)
    {
        $cat = static::find($catid);
        $parent = static::find($parent_id);
        if ($parent) {
            $parent_ids = $parent->parent_ids . "," . $parent_id;
        } else {
            $parent_ids = 0;
        }
        $cat->parent_id = $parent_id;
        $cat->parent_ids = $parent_ids;
        $cat->name = $cat_name;
        return $cat->save();
    }

}
