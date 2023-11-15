<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainWebController extends Controller
{
    public function index(Request $request)
    {
        $title = 'BAL shop';
        return view('WEB.home.index',compact('title'));
    }

    public function search($search){
        $title = 'Bạn đang tìm kiếm theo từ khóa'.$search;
        $product = Product::query()->where('status',1)->where('ten','like','%'.$search.'%')->paginate(12);
        return view('WEB.home.search',compact('title','product','search'));
    }

    public function contact(){
        $title = 'Liên hệ';
        return view('WEB.contact.index',compact('title'));
    }

}
