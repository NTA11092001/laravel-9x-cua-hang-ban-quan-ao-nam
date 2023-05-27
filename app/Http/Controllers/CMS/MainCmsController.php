<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class MainCmsController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Trang quản trị';
        $cart = Cart::all();
        $total_success=0;$total_wait=0;$total_cancel=0;$total_fail=0;$payment_success=0;$payment_wait=0;

        foreach ($cart as $key=>$item){
            if ($item->status == 1)
            {
                $total_success ++;
                $payment_success += $item->total;
            }

            if ($item->status == 0)
            {
                $total_wait ++;
                $payment_wait += $item->total;
            }

            if ($item->status == -1)
            {
                $total_cancel ++;
            }

            if ($item->status == -2)
            {
                $total_fail ++;
            }

        }

        $order_success = '[';
        $order_wait = '[';
        $order_cancel = '[';
        $order_fail = '[';

        for($i = 1; $i <= 12 ; $i ++) {

            $orders = Cart::query()->whereMonth('cart_date', $i)->whereYear('cart_date', date('Y'))->get();

            $count_success = 0;
            $count_wait = 0;
            $count_cancel = 0;
            $count_fail = 0;

            foreach ($orders as $item) {
                switch ($item->status) {
                    case '1':
                        $count_success++;
                        break;
                    case '0':
                        $count_wait++;
                        break;
                    case '-1':
                        $count_cancel++;
                        break;
                    case '-2':
                        $count_fail++;
                        break;
                    default:
                        break;
                }
            }

            $order_success .= $count_success.',';
            $order_wait .= $count_wait.',';
            $order_cancel .= $count_cancel.',';
            $order_fail .= $count_fail.',';
        }

        $order_success .= ']';
        $order_wait .= ']';
        $order_cancel .= ']';
        $order_fail .= ']';

        return view('CMS.home.index',compact('title','total_success','total_wait','total_cancel','total_fail','payment_success','payment_wait','order_success', 'order_wait', 'order_cancel','order_fail'));
    }
}
