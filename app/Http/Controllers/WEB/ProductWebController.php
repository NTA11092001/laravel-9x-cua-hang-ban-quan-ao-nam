<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{

    public function category($id)
    {
        $category = Categories::query()->findOrFail($id);
        $product = Product::query()->where('status',1)->where('id_danhmuc',$id)->paginate(10);
        $title = $category->ten;
        return view('WEB.product.category',compact('title','product','category'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $product = Product::query()->findOrFail($id);
        $similar = Product::query()->where('id','<>',$id)->where('status',1)->where('id_danhmuc',$product->id_danhmuc)->get();
        $title = $product->ten;
        return view('WEB.product.detail',compact('title','product','similar'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
