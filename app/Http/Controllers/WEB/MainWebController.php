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
        $tukhoa = $request->tukhoa ? $request->tukhoa : '';
        $title = 'BAL shop';
        if ($tukhoa != ''){
            $product = Product::query()->where('status',1)->where('ten','like','%'.$tukhoa.'%')->paginate(10);
            return view('WEB.home.search',compact('title','product'));
        }else{
            return view('WEB.home.index',compact('title'));
        }
    }

    public function contact(){
        $title = 'Liên hệ';
        return view('WEB.contact.index',compact('title'));
    }

}
