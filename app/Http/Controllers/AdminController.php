<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function __construct()
    {
        seo("wnsys管理后台");
        $this->middleware('auth');
        $this->middleware('admin');
    }
}
