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
        $success_pay = '[';
        $wait_pay = '[';

        for($i = 1; $i <= 12 ; $i ++) {

            $orders = Cart::query()->whereMonth('cart_date', $i)->whereYear('cart_date', date('Y'))->get();

            $count_success = 0;
            $count_wait = 0;
            $count_cancel = 0;
            $count_fail = 0;
            $count_success_pay = 0;
            $count_wait_pay = 0;

            foreach ($orders as $item) {
                switch ($item->status) {
                    case '1':
                        $count_success++;$count_success_pay += $item->total;
                        break;
                    case '0':
                        $count_wait++;$count_wait_pay += $item->total;
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
            $success_pay .= $count_success_pay.',';
            $wait_pay .= $count_wait_pay.',';
        }

        $order_success .= ']';
        $order_wait .= ']';
        $order_cancel .= ']';
        $order_fail .= ']';
        $success_pay .= ']';
        $wait_pay .= ']';

        return view('CMS.home.index',compact('title','total_success','total_wait','total_cancel','total_fail','payment_success','payment_wait','order_success', 'order_wait', 'order_cancel','order_fail','success_pay','wait_pay'));
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
