<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function index()
    {
        $title = 'Thông tin tài khoản';
        $member = Member::query()->findOrFail(auth('member')->user()->id);
        return view('WEB.account.index',compact('title','member'));

    }

    public function history()
    {
        $title = 'Lịch sử đặt hàng';
        $cart = Cart::query()->where('member_id',auth('member')->user()->id)->orderBy('id','desc')->get();
        return view('WEB.account.history',compact('title','cart'));

    }

    public function password(Request $request)
    {

        $request->validate([
            'current' => 'required|min:8',
            'new' => 'required|min:8',
            'confirm_new' => 'required|same:new',
        ], [
            'current.required' => 'Bạn cần nhập mật khẩu hiện tại',
            'current.min' => 'Mật khẩu hiện tại của bạn cần nhập ít nhất 8 ký tự',
            'new.required' => 'Bạn cần nhập mật khẩu mới',
            'new.min' => 'Mật khẩu mới của bạn cần nhập ít nhất 8 ký tự',
            'confirm_new.required' => 'Bạn cần xác nhận mật khẩu mới',
            'confirm_new.same' => 'Xác nhận mật khẩu mới không khớp với mật khẩu mới bạn nhập',
        ]);

        $member = Member::query()->findOrFail(auth('member')->user()->id);
        if (Hash::check($request->current, $member->password)){
            try {
                $member->password = Hash::make($request->new);
                $member->save();
                return to_route('WEB.account')->with('success', 'Đổi mật khẩu thành công');
            }catch (\Exception $e){
                return to_route('WEB.account')->with('error', $e->getMessage());
            }
        }else{
            return to_route('WEB.account')->with('error', 'Mật khẩu hiện tại của bạn không khớp với mật khẩu trên hệ thống');
        }

    }

    public function show(Request $request)
    {
        $cart = Cart::query()->findOrFail($request->cart_id);
        $transport = Transport::query()->where('member_id',auth('member')->user()->id)->first();
        return view('WEB.account.detail_history',compact('cart','transport'))->render();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/[A-Za-z]/',
            'phone' => 'min:10|required|regex:/^0[1-9][0-9]{8}$/|max:10',
            'email' => 'required|email',
        ], [
            'name.required' => 'Bạn cần nhập tên',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.regex' => 'Tên bạn nhập phải là chữ cái',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'phone.min' => 'Số điện thoại bạn nhập phải ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại bạn nhập được nhiều nhất 12 ký tự',
            'phone.regex' => 'Số điện thoại bạn nhập phải là 1 số điện thoại ở Việt Nam',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email bạn nhập không đúng định dạng',
        ]);

        $data = $request->all();
        try {
            Member::query()->findOrFail(auth('member')->user()->id)->update($data);
            return to_route('WEB.account')->with('success', 'Sửa thông tin tài khoản thành công');
        }catch (\Exception $e){
            return to_route('WEB.account')->with('error', $e->getMessage());
        }
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
            return to_route('admin.cart.index')->with('success', 'Hủy đơn hàng thành công!');
        }catch (\Exception $e){
            return to_route('admin.cart.index')->with('error', $e->getMessage());
        }
    }

}
