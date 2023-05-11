<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $title = 'Sản phẩm';
        return view('CMS.product.index',compact('title'));
    }
}
