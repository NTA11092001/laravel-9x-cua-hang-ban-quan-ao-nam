<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartStatusHistory;
use App\Models\StockTransactions;
use App\Models\Product;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{

    public function index($type)
    {
        if ($type == 'in'){
            $title = 'Danh sách phiếu nhập kho';
            $title_stock = 'nhập kho';
            $stocks = StockTransactions::query()->whereHas('product')->where('type','in')->paginate(10);
        } else if ($type == 'out'){
            $title = 'Danh sách phiếu xuất kho';
            $title_stock = 'xuất kho';
            $stocks = StockTransactions::query()->whereHas('cart')->where('type','out')->paginate(10);
        }
        return view('CMS.stockTransaction.index_stock',compact('title','type','stocks','title_stock'));
    }

    public function product($type){
        if ($type == 'in'){
            $title = 'Danh sách sản phẩm cần nhập kho';
            $title_stock = 'nhập kho';
            $data_array = Product::query()->whereRaw('soluong <= reorder_level')->orDoesntHave('stockTransaction')->get();
        } else if ($type == 'out'){
            $title = 'Danh sách sản phẩm cần xuất kho';
            $title_stock = 'xuất kho';
            $data_array = Cart::query()->where('status', -1)->get();
        }
        return view('CMS.stockTransaction.index_product',compact('title','type','data_array','title_stock'));
    }

    public function create($type,Request $request)
    {
        if ($type == 'in'){
            $title = 'Thêm phiếu nhập kho';
            $title_stock = 'nhập kho';
            $data_array = Product::query()->findOrFail($request->product_id);
        } else if ($type == 'out'){
            $title = 'Thêm phiếu xuất kho';
            $title_stock = 'xuất kho';
            $data_array = Cart::query()->findOrFail($request->cart_id);
        }
        $suppliers = Suppliers::query()->get();
        return view('CMS.stockTransaction.create',compact('title','type','data_array','title_stock','suppliers'));
    }

    public function store(Request $request)
    {
        $type = $request->type;
        try {
            // check type
            if ($type == 'in'){
                $request->validate([
                    'supplier_id'=>'required'
                ],
                [
                    'supplier_id.required'=>'Bạn cần chọn nhà cung cấp'
                ]);
                $title_stock = 'nhập kho';
                $data = $request->only(['supplier_id','product_id','type','quantity','stock_in_price']);
                if(auth()->user()->level == 1) {
                    $product = Product::query()->findOrFail($request->product_id);
                    $product->soluong = $product->soluong + $request->quantity;
                    $product->save();
                }
            } else {
                $title_stock = 'xuất kho';
                $data = $request->only(['cart_id','type']);
                if(auth()->user()->level == 1) {
                    $cart = Cart::query()->findOrFail($request->cart_id);
                    $cart_detail = $cart->cart_detail;
                    foreach ($cart_detail as $item){
                        $product = Product::query()->findOrFail($item->id);
                        $product->soluong = $product->soluong - $item->pivot->quantity;
                        $product->save();
                    }
                    $cart->status = 0;
                    $cart->save();
                    CartStatusHistory::query()->create(['cart_id'=>$request->cart_id,'cart_status'=>0,'user_id'=>auth()->user()->id]);
                }
            }
            $data['user_id'] = auth()->user()->id;
            $data['transaction_date'] = date('Y-m-d');
            // check chức vụ
            if(auth()->user()->level == 1){
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            //dd($data);
            StockTransactions::query()->create($data);
            return to_route('admin.stockTransaction.index',$request->type)->with('notice_success',ucfirst($title_stock).' thành công');
        } catch (\Exception $e){
            return redirect()->back()->with('some_error',$e);
        }
    }

    public function caculator(Request $request){
        $total = $request->quantity * $request->stock_in_price;
        return number_format($total,0,',','.').' VNĐ';
    }

    public function destroy(StockTransactions $stockTransaction)
    {
        //
    }
}
