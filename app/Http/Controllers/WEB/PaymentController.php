<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transport;
use Illuminate\Http\Request;
use App\Http\Requests\WEB\DeliveryRequest;

class PaymentController extends Controller
{

    public function index()
    {
        $title = 'Đặt hàng';
        $cart = \Cart::getContent();
        return view('WEB.cart.payment',compact('title','cart'));
    }

    public function store(DeliveryRequest $request)
    {
        $request->validated();
        try {
            $member_id = auth('member')->user()->id;
            //Create Or Update Transport
            $transport = $request->only(['name','phone','email','address','note']);
            $transport['member_id']= $member_id;
            $transport_old = Transport::query()->where('member_id', $member_id)->first();
            if ($transport_old == '' || $transport_old == null){
                Transport::query()->create($transport);
            } elseif ($transport_old != '' || $transport_old != null){
                $transport_old->update($transport);
            }

            $cart_detail = \Cart::getContent();
            //Create Cart
            $cart['cart_date'] = date('Y-m-d');
            $cart['payment_type'] = 'cod';
            $cart['total'] = \Cart::getTotal();
            $cart['member_id']= $member_id;
            $cart['status'] = -1;
            $cart_insert = Cart::query()->create($cart);
            foreach ($cart_detail as $item){
                $product = Product::query()->findOrFail($item->id);
                $product->soluong = $product->soluong-$item->quantity;
                $product->save();
                $cart_insert->cart_detail()->attach($item->id,['quantity'=>$item->quantity,'size'=>$item->attributes['size'],'price'=>$item->price]);
            }

            \Cart::clear();

            return to_route('WEB.payment.success',["type"=>"cod"]);
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function vnpay_payment(DeliveryRequest $request)
    {
        $request->validated();

        //Create Or Update Transport
        $data_transport = $request->only(['name','phone','email','address','note']);
        $data_transport['member_id']= auth('member')->user()->id;
        $data_transport_old = Transport::query()->where('member_id',auth('member')->user()->id)->first();
        if ($data_transport_old == '' || $data_transport_old == null){
            Transport::query()->create($data_transport);
        } elseif ($data_transport_old != '' || $data_transport_old != null){
            $data_transport_old->update($data_transport);
        }

        $code_cart = rand(100000,999999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return_vnpay');
        $vnp_TmnCode = "I4GCRF2G";//Mã website tại VNPAY
        $vnp_HashSecret = "BNPBDYRETSOKSPATLJRFMCHOTFDEKXHB"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng số '. str($code_cart);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = \Cart::getToTal() *100;
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

    public function return_vnpay(Request $request){
        $isSuccess = true;
        $cart_detail = \Cart::getContent();
        //Create Cart
        $cart['cart_date'] = date('Y-m-d');
        $cart['payment_type'] = 'vnpay';
        $cart['total'] = \Cart::getTotal();
        $cart['member_id']= auth('member')->user()->id;
        if($request->vnp_ResponseCode == "00") {
            $cart['status'] = 1;
        } else {
            $cart['status'] = 0;
            $isSuccess = false;
        }
        $cart_insert = Cart::query()->create($cart);
        foreach ($cart_detail as $item){
            $product = Product::query()->findOrFail($item->id);
            $product->soluong = $product->soluong-$item->quantity;
            $product->save();
            $cart_insert->cart_detail()->attach($item->id,['quantity'=>$item->quantity,'size'=>$item->attributes['size'],'price'=>$item->price]);
        }
        \Cart::clear();
        if($isSuccess == true) {
            return to_route('WEB.payment.success',["status" => "1" , "type" =>"vnpay"]);
        } else {
            return to_route('WEB.payment.success',["status" => "0" , "type" =>"vnpay"]);
        }
    }

    public function success(Request $request)
    {
        if($request->type == "cod") {
            $title = 'ĐẶT HÀNG THÀNH CÔNG';
        } else {
            if ($request->status == "1"){
                $title = 'THANH TOÁN THÀNH CÔNG';
            } else {
                $title = 'THANH TOÁN KHÔNG THÀNH CÔNG';
            }
        }
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
