<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transport;
use Illuminate\Http\Request;

class CartCmsController extends Controller
{

    public function index()
    {
        $title = 'Tài khoản khách hàng';
        $cart = Cart::query()->orderBy('id','desc')->paginate(10);
        return view('CMS.cart.index',compact('title','cart'));
    }

    public function cancel($id)
    {
        try {
            $cart = Cart::query()->findOrFail($id);
            foreach ($cart->cart_detail as $item){
                $product = Product::query()->findOrFail($item->id);
                $product->soluong = $product->soluong+$item->pivot->quantity;
                $product->save();
            }
            $cart->status = -2;
            $cart->save();
            return to_route('admin.cart.index')->with('notice_success', 'Hủy đơn hàng thành công!');
        }catch (\Exception $e){
            return to_route('admin.cart.index')->with('some_error', $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $cart = Cart::query()->findOrFail($request->cart_id);
        $transport = Transport::query()->where('member_id',$cart->member_id)->first();
        return view('CMS.cart.modal-show',compact('cart','transport'))->render();
    }

    public function destroy(Request $request)
    {
        $id = $request->cart_id;
        try {
            $cart = Cart::query()->findOrFail($id);
            $cart->cart_detail()->detach();
            $cart->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa đơn hàng thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status(Request $request){
        try{
            $cart = Cart::query()->findOrFail($request->id);

            $cart->status = $request->status;

            $cart->save();

            return response()->json([
                'success' => true,
                'status' => $cart->status,
                'message' => 'Đổi trạng thái đơn hàng thành công'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
