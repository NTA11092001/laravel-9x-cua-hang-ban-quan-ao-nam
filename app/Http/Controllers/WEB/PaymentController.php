<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transport;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $title = 'Đặt hàng';
        $cart = \Cart::getContent();
        return view('WEB.cart.payment',compact('title','cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10',
            'email' => 'required|email',
            'address' => 'required',
        ], [
            'name.required' => 'Bạn cần nhập họ tên người nhận',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại bạn nhập được nhiều nhất 12 ký tự',
            'phone.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email bạn nhập không đúng định dạng',
            'address.required' => 'Bạn cần nhập mật khẩu'
        ]);
        try {
            $cart_detail = \Cart::getContent();
            //Create Cart
            $cart = $request->only(['cart_date','payment_type','total']);
            $cart['member_id']=auth('member')->user()->id;
            $cart['status'] = -1;
            $cart_insert = Cart::query()->create($cart);
            foreach ($cart_detail as $item){
                $product = Product::query()->findOrFail($item->id);
                $product->soluong = $product->soluong-$item->quantity;
                $product->save();
                $cart_insert->cart_detail()->attach($item->id,['quantity'=>$item->quantity,'size'=>$item->attributes['size']]);
            }

            \Cart::clear();

            //Create Or Update Transport
            $transport = $request->only(['name','phone','email','address','note']);
            $transport['member_id']=auth('member')->user()->id;
            $transport_old = Transport::query()->where('member_id',auth('member')->user()->id)->first();
            if ($transport_old == '' || $transport_old == null){
                Transport::query()->create($transport);
            } elseif ($transport_old != '' || $transport_old != null){
                $transport_old->update($transport);
            }

            return to_route('WEB.payment.success');
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function success()
    {
        $title = 'Đặt hàng';
        $cart = \Cart::getContent();
        $cart_detail = Cart::query()->where('member_id',auth('member')->user()->id)->orderBy('id','desc')->first();
        $transport = Transport::query()->where('member_id',auth('member')->user()->id)->first();
        return view('WEB.cart.success',compact('title','cart','cart_detail','transport'));
    }

    public function status(Request $request){
        try {
            $cart = Cart::query()->findOrFail($request->id);
            if ($cart->status == 0){
                return to_route('WEB.history')->with('info', 'Đơn hàng đã được xác nhận!');
            }else{
                foreach ($cart->cart_detail as $item){
                    $product = Product::query()->findOrFail($item->id);
                    $product->soluong = $product->soluong+$item->pivot->quantity;
                    $product->save();
                }
                $cart->status = -2;
                $cart->save();
                return to_route('WEB.history')->with('success', 'Hủy đơn hàng thành công!');
            }
        }catch (\Exception $e){
            return to_route('WEB.history')->with('error', $e->getMessage());
        }
    }
}
