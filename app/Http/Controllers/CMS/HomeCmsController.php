<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeCmsController extends Controller
{
    public function index(Request $request)
    {
        return view('CMS.home.index');
    }
}
