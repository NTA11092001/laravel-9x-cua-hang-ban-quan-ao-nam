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

    public function vnpayment(Request $request,$id){
        $code_cart = rand(100000,999999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return_vnpayment');
        $vnp_TmnCode = "I4GCRF2G";//Mã website tại VNPAY
        $vnp_HashSecret = "BNPBDYRETSOKSPATLJRFMCHOTFDEKXHB"; //Chuỗi bí mật

        $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng số '. str($code_cart);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total *100;
        $vnp_Locale = 'vn';
        //$vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        //dd($inputData);
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function return_vnpayment(Request $request){
        if($request->vnp_ResponseCode == "00") {
            $cart = Cart::query()->findOrFail($request->vnp_TxnRef);
            $cart->status = 1;
            $cart->save();
            return to_route('WEB.payment.success',["status" => "1" , "type" =>"vnpay"]);
        } else {
            return to_route('WEB.payment.success',["status" => "0" , "type" =>"vnpay"]);
        }
    }
}
