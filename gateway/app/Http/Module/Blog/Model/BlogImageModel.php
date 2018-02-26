<?php
namespace App\Http\Module\Blog\Model;

use App\Model\ImageModel;
use Illuminate\Support\Facades\Auth;

class BlogImageModel extends ImageModel
{
    private $module = "blog";
}