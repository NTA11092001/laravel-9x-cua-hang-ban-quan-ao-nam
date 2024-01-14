<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\BillHistory;
use App\Models\Cart;
use App\Models\CartStatusHistory;
use App\Models\Transport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CartCmsController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Danh sách đơn hàng';
        $query = Cart::query()->orderBy('id','desc');
        if($request->madh != null){
            $request->validate([
                'madh' => 'numeric'
            ],[
                'madh.numeric' => 'Mã đơn hàng phải là chữ số'
            ]);
            $query = $query->where('id','=',$request->madh);
        }
        if ($request->date != null){
            $carbonDate = Carbon::createFromFormat('d/m/Y', $request->date);
            $formattedDate = $carbonDate->format('Y-m-d');
            $query = $query->whereDate('cart_date','=',$formattedDate);
        }
        //dd($query->toSql());
        $cart = $query->paginate(10);
        return view('CMS.cart.index',compact('title','cart'));
    }

    public function cancel($id)
    {
        try {
            $cart = Cart::query()->findOrFail($id);
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

    public function showStatus(Request $request){
        $id = $request->cart_id;
        $statusHistory = CartStatusHistory::query()->where('cart_id',$request->cart_id)->orderBy('id','desc')->get();
        return view('CMS.cart.modal-status',compact('statusHistory','id'))->render();
    }

    public function showBillStatus(Request $request){
        $id = $request->cart_id;
        $billHistory = BillHistory::query()->where('cart_id',$request->cart_id)->orderBy('id','desc')->get();
        return view('CMS.cart.modal-bill-status',compact('billHistory','id'))->render();
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
            $cart = Cart::query()->findOrFail($request->cart_id);
            $cart->status = $request->cart_status;
            $cart->save();

            $data = $request->only(['cart_id','cart_status']);
            $data['user_id'] = auth()->user()->id;
            CartStatusHistory::query()->create($data);

            return to_route('admin.cart.index')->with('notice_success', 'Đổi trạng thái đơn hàng thành công!');
        }catch (\Exception $e){
            return to_route('admin.cart.index')->with('some_error', $e->getMessage());
        }
    }
}
