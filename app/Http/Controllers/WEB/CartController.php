<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $product = Product::query()->findOrFail($request->id);
        \Cart::add([
            'id' => $product->id,
            'name' => $product->ten,
            'price' => $product->giakm ? $product->giakm : $product->giathuong,
            'quantity' => $request->quantity ? $request->quantity : 1,
            'attributes' => array(
                'image' => $product->hinhanh,
                'masp' => $product->masp,
                'size' => $request->size ? $request->size : 38
            )
        ]);
        session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');

        return to_route('WEB.cart.list');
    }

    public function updateCart(Request $request)
    {
        $ids = $request->id;
        $quantity = $request->quantity;
        $size = $request->size;
        foreach ($ids as $i=>$item){
            $product = Product::query()->findOrFail($item);
            \Cart::update(
                $product->id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quantity[$i]
                    ],
                    'attributes' => array(
                        'image' => $product->hinhanh,
                        'masp' => $product->masp,
                        'size' => $size[$i]
                    )
                ]
            );
        }

        session()->flash('success', 'Cập nhật giỏ hàng thành công!');

        return to_route('WEB.cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!'
        ]);
    }

    public function clearAll()
    {
        \Cart::clear();

        session()->flash('success', 'Xóa tất cả giỏ hàng thành công!');

        return to_route('WEB.cart.list');
    }

    public function cartList()
    {
        $title = 'Giỏ hàng';
        $cart = \Cart::getContent();
        $promotion = Product::query()->where('status',1)->where('giakm','<>',null)->orderBy('id','desc')->limit(20)->get();

        return view('WEB.cart.index', compact('title','cart','promotion'));
    }

}
