<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class MainCmsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year ? $request->year : date('Y');
        $title = 'Trang quản trị';
        $cart = Cart::query()->whereYear('cart_date', $year)->get();
        $total_cancel = 0;
        $total_new = 0;
        $total_ready = 0;
        $total_delivery = 0;
        $total_shipping = 0;
        $total_complete = 0;
        $payment_success=0;
        $total_payment_success = 0;
        $payment_fail=0;
        $total_payment_fail = 0;

        foreach ($cart as $key=>$item){
            switch ($item->status) {
                case '-2':
                    $total_cancel ++;
                    break;
                case '-1':
                    $total_new ++;
                    break;
                case '0':
                    $total_ready ++;
                    break;
                case '1':
                    $total_delivery ++;
                    break;
                case '2':
                    $total_shipping ++;
                    break;
                case '3':
                    $total_complete ++;
                    break;
                default:
                    break;
            }

            if($item->status != -2){
                if($item->bill_status == 1){
                    $payment_success ++;
                    $total_payment_success += $item->total;
                }
                else {
                    $payment_fail ++;
                    $total_payment_fail += $item->total;
                }
            }
        }

        $data_total = array(
            'total_cancel'=> $total_cancel,
            'total_new' => $total_new,
            'total_ready' => $total_ready,
            'total_delivery' => $total_delivery,
            'total_shipping' => $total_shipping,
            'total_complete' => $total_complete,
            'payment_success' => $payment_success,
            'total_payment_success' => $total_payment_success,
            'payment_fail' => $payment_fail,
            'total_payment_fail' => $total_payment_fail
        );

        $order_cancel = '[';
        $order_new = '[';
        $order_ready = '[';
        $order_delivery = '[';
        $order_shipping = '[';
        $order_complete = '[';
        $fail_pay = '[';
        $success_pay = '[';
        $total_success_12_month = '[';
        $total_fail_12_month = '[';
        for($i = 1; $i <= 12 ; $i ++) {

            $orders = Cart::query()->whereMonth('cart_date', $i)->whereYear('cart_date', $year)->get();

            $count_cancel = 0;
            $count_new = 0;
            $count_ready = 0;
            $count_delivery = 0;
            $count_shipping = 0;
            $count_complete = 0;
            $count_success_pay = 0;
            $count_fail_pay = 0;
            $count_total_fail = 0;
            $count_total_success = 0;

            foreach ($orders as $item) {
                switch ($item->status) {
                    case '-2':
                        $count_cancel ++;
                        break;
                    case '-1':
                        $count_new ++;
                        break;
                    case '0':
                        $count_ready ++;
                        break;
                    case '1':
                        $count_delivery ++;
                        break;
                    case '2':
                        $count_shipping ++;
                        break;
                    case '3':
                        $count_complete ++;
                        break;
                    default:
                        break;
                }

                if($item->status != -2){
                    if($item->bill_status == 1){
                        $count_success_pay ++;
                        $count_total_success += $item->total;
                    }
                    else {
                        $count_fail_pay++;
                        $count_total_fail += $item->total;
                    }
                }
            }

            $order_cancel .= $count_cancel.',';
            $order_new .= $count_new.',';
            $order_ready .= $count_ready.',';
            $order_delivery .= $count_delivery.',';
            $order_shipping .= $count_shipping.',';
            $order_complete .= $count_complete.',';
            $fail_pay .= $count_fail_pay.',';
            $success_pay .= $count_success_pay.',';
            $total_success_12_month .= $count_total_success.',';
            $total_fail_12_month .= $count_total_fail.',';
        }

        $order_cancel .= ']';
        $order_new .= ']';
        $order_ready .= ']';
        $order_delivery .= ']';
        $order_shipping .= ']';
        $order_complete .= ']';
        $fail_pay .= ']';
        $success_pay .= ']';
        $total_success_12_month .= ']';
        $total_fail_12_month .= ']';

        $data_12_month = array(
            'order_cancel' => $order_cancel,
            'order_new' => $order_new,
            'order_ready' => $order_ready,
            'order_delivery' => $order_delivery,
            'order_shipping' => $order_shipping,
            'order_complete' => $order_complete,
            'fail_pay' => $fail_pay,
            'success_pay' => $success_pay,
            'total_success_12_month' => $total_success_12_month,
            'total_fail_12_month' => $total_fail_12_month
        );

        return view('CMS.home.index',compact('title','data_total','data_12_month'));
    }

    public function editModal(Request $request)
    {
        $user = User::query()->findOrFail($request->user_id);
        return view('CMS.user.modal_edit',compact('user'))->render();
    }

    public function updateModal(Request $request, User $user)
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
            $user::query()->findOrFail($request->id)->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Sửa thông tin tài khoản thành công'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
