<?php
namespace App\Module\Blog\Model;

use App\Model\ImageModel;
use Illuminate\Support\Facades\Auth;

class BlogImageModel extends ImageModel
{
    private $module = "blog";
}