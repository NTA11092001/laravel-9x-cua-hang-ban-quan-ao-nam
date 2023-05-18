<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainCmsController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Trang quản trị';
        return view('CMS.home.index',compact('title'));
    }
}
