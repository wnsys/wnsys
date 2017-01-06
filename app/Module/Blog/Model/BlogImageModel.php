<?php
namespace App\Module\Blog\Model;

use App\Model\ImageModel;
use Illuminate\Support\Facades\Auth;

class BlogImageModel extends ImageModel
{
    private $module = "blog";

    /**
     * @param $blogid
     * @param array $add_ids "1,2,3"
     * @param array $del_ids "1,2,4"
     */
    function modelSave($blogid,  $add_ids = "",  $del_ids = "")
    {
        $add_ids = $add_ids ? explode(",", $add_ids) : [];
        $del_ids = $del_ids ? explode(",", $del_ids) : [];
        if ($add_ids) {
            ImageModel::whereIn("id", $add_ids)->update(["user_id" => Auth::id(),
                "module" => $this->module,
                "pk_type" => "article",
                "pk_id" => $blogid]);
        }
        if ($del_ids) {
            ImageModel::destroy($del_ids);
        }
    }

}