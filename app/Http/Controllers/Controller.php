<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function message($message = "",$data = "",$status = 0,$error = ""){
        return $this->response($data,$status,$error,$message);
    }
    public function response($data = "",$status = 0,$error = "",$message = ""){
        $result = [
            "status" => $status,
            "data" => $data,
            "error" => $error,
            "message" => $message
        ];
        return response()->json($result);
    }
}
