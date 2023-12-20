<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\StockTransactions;
use App\Models\Product;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{

    public function index($type)
    {
        if ($type == 'in'){
            $title = 'Danh sách phiếu nhập kho';
            $title_stock = 'nhập kho';
            $stocks = StockTransactions::query()->where('type','in')->paginate(10);
        } else if ($type == 'out'){
            $title = 'Danh sách phiếu xuất kho';
            $title_stock = 'xuất kho';
            $stocks = StockTransactions::query()->where('type','out')->paginate(10);
        }
        return view('CMS.stockTransaction.index_stock',compact('title','type','stocks','title_stock'));
    }

    public function product($type){
        if ($type == 'in'){
            $title = 'Danh sách sản phẩm cần nhập kho';
            $title_stock = 'nhập kho';
            $data_array = $this->stockIn();
        } else if ($type == 'out'){
            $title = 'Danh sách sản phẩm cần xuất kho';
            $title_stock = 'xuất kho';
            $data_array = $this->stockOut();
        }
        return view('CMS.stockTransaction.index_product',compact('title','type','data_array','title_stock'));
    }

    public function stockIn(){
            return Product::query()->where('soluong', '<=', 'reorder_level')->get();
    }

    public function stockOut(){
            return Cart::query()->where('status', -1)->get();
    }

    public function create($type)
    {
        if ($type == 'in'){
            $title = 'Thêm phiếu nhập kho';
            $title_stock = 'nhập kho';
            $data_array = $this->stockIn();
        } else if ($type == 'out'){
            $title = 'Thêm phiếu xuất kho';
            $title_stock = 'xuất kho';
            $data_array = $this->stockOut();
        }
        return view('CMS.stockTransaction.create',compact('title','type','data_array','title_stock'));
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockTransactions  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransactions $stockTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockTransactions  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(StockTransactions $stockTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockTransactions  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransactions $stockTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockTransactions  $stockTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockTransactions $stockTransaction)
    {
        //
    }
}
