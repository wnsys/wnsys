<?php
namespace App\Module\Admin\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Model\ImageModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends AdminController
{
    public function get(Request $request)
    {
        $rs = ImageModel::find($request["id"]);
        return $this->response($rs);
    }

    public function save(Request $request)
    {
        $image = ImageModel::find($request["id"]);
        $image->fill($request->all());
        $image->save();
        return $this->response();
    }
}