<?php
namespace App\Module\Blog\Model;

use App\Model\ImageModel;
use Illuminate\Support\Facades\Auth;

class BlogImageModel extends ImageModel
{
    private $module = "blog";
    function blogSave(array $ids, $blogid)
    {
        return ImageModel::whereIn("id", $ids)->update(["user_id" => Auth::id(),
            "module" => $this->module,
            "pk_type" => "article",
            "pk_id" => $blogid]);

    }

}