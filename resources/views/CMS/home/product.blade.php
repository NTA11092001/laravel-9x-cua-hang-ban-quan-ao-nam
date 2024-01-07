@extends('CMS.master')
@section('content')
<div class="container-fluid p-6">
    <div class="row">
{{--        {{$product['need_out_stock']}}--}}
{{--        @foreach($product['need_out_stock'] as $item)--}}
{{--        <div class="p-2">--}}
{{--            {{$item->id}}; {{$item->ten}} {{$item->masp}}; {{$item->cart_detail}}--}}
{{--        </div>--}}
{{--        @endforeach--}}
    </div>
    <div class="border-bottom pb-4 mb-4">
        <div class="row">
            <div class="col-8">
                <!-- Page header -->
                <h3 class="mb-0 fw-bold">Thống kê sản phẩm tháng {{request('month') ? date('m-Y',strtotime(request('month'))) : date('m-Y')}}</h3>
            </div>

            <div class="col-4">
                <form class="row justify-content-end" action="{{route('admin.home.product')}}" method="GET">
                    <div class="col-6">
                        <input type="month" class="form-control" name="month" value="{{request('month') ? request('month') : date('Y-m')}}">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-dark">Lọc</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-eye fa-6x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Số sản phẩm đang hiển thị</h5>
                        <h5>{{count($product['active'])}}</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-eye-slash fa-6x text-primary"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Số sản phẩm đang ẩn</h5>
                        <h5>{{count($product['unactive'])}}</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    @if(count($product['best_sale'])>0)
                        <img class="img-fluid" src="{{asset($product['best_sale'][0]->hinhanh)}}">
                        <div class="w-75 d-flex flex-column text-center dashboard-text px-2">
                            <h5 class="fw-bold mt-2">Sản phẩm bán được nhiều nhất</h5>
                            <h5>{{$product['best_sale'][0]->ten}} {{$product['best_sale'][0]->masp}}</h5>
                            @php
                                $count_best_sale = 0;
                                foreach ($product['best_sale'][0]->cart_detail as $item){
                                    $count_best_sale += $item->pivot->quantity;
                                }
                            @endphp
                            <h5>Số lượng: {{$count_best_sale}}  ({{$product['best_sale'][0]->cart_detail_count}} đơn hàng)</h5>
                        </div>
                    @else
                        <div class="w-25 m-auto">
                            <img class="img-fluid" src="{{asset('img/BAL-logo.png')}}">
                        </div>
                        <div class="w-75 d-flex flex-column text-center dashboard-text px-2">
                            <h5 class="fw-bold mt-2">Sản phẩm bán được nhiều nhất</h5>
                            <h5>Tháng này chưa bán được sản phẩm nào</h5>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-boxes-packing fa-5x text-primary"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text px-2">
                        <h5 class="fw-bold mt-2">Sản phẩm đã bán</h5>
                        @if(count($product['sale'])>0)
                            @php
                                $count_sale = 0;
                                $count_cart = 0;
                                foreach ($product['sale'] as $item){
                                    foreach ($item->cart_detail as $cart_detail){
                                        $count_sale += $cart_detail->pivot->quantity;
                                    }
                                    $count_cart += $item->cart_detail_count;
                                }
                            @endphp
                            @if($count_sale > 0 && $count_cart > 0)
                                <h5>Số lượng: {{$count_sale}} ({{$count_cart}} đơn hàng)</h5>
                            @else
                                <h5>Tháng này chưa bán được sản phẩm nào</h5>
                            @endif
                        @else
                            <h5>Tháng này chưa bán được sản phẩm nào</h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-circle-check fa-6x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Sản phẩm đã thanh toán</h5>
                        @if(count($product['success'])>0)
                            @php
                                $count_success_sale = 0;
                                $count_success_cart = 0;
                                foreach ($product['success'] as $item){
                                    foreach ($item->cart_detail as $cart_detail){
                                        $count_success_sale += $cart_detail->pivot->quantity;
                                    }
                                    $count_success_cart += $item->cart_detail_count;
                                }
                            @endphp
                            @if($count_success_sale > 0 && $count_success_cart > 0)
                                <h5>Số lượng: {{$count_success_sale}} ({{$count_success_cart}} đơn hàng)</h5>
                            @else
                                <h5>Tháng này không có sản phẩm nào đã thanh toán</h5>
                            @endif
                        @else
                            <h5>Tháng này không có sản phẩm nào đã thanh toán</h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-circle-xmark fa-6x text-danger"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Sản phẩm chờ thanh toán</h5>
                        @if(count($product['wait'])>0)
                            @php
                                $count_wait_sale = 0;
                                $count_wait_cart = 0;
                                foreach ($product['wait'] as $item){
                                    foreach ($item->cart_detail as $cart_detail){
                                        $count_wait_sale += $cart_detail->pivot->quantity;
                                    }
                                    $count_wait_cart += $item->cart_detail_count;
                                }
                            @endphp
                            @if($count_wait_sale > 0 && $count_wait_cart > 0)
                                <h5>Số lượng: {{$count_wait_sale}} ({{$count_wait_cart}} đơn hàng)</h5>
                            @else
                                <h5>Tháng này không có sản phẩm nào chờ thanh toán</h5>
                            @endif
                        @else
                            <h5>Tháng này không có sản phẩm nào chờ thanh toán</h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-warehouse fa-5x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Sản phẩm còn hàng</h5>
                        <h5>{{count($product['in_stock'])}}</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-box-open fa-5x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Sản phẩm cần nhập kho</h5>
                        <h5>{{count($product['out_stock'])}}</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-box fa-5x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Sản phẩm cần xuất kho</h5>
                        @if(count($product['need_out_stock'])>0)
                            @php
                                $count_sneed_out_stock = 0;
                                $count_need_out_stock_cart = 0;
                                foreach ($product['need_out_stock'] as $item){
                                    foreach ($item->cart_detail as $cart_detail){
                                        $count_sneed_out_stock += $cart_detail->pivot->quantity;
                                    }
                                    $count_need_out_stock_cart += $item->cart_detail_count;
                                }
                            @endphp
                            @if($count_success_sale > 0 && $count_success_cart > 0)
                                <h5>Số lượng: {{$count_sneed_out_stock}} ({{$count_need_out_stock_cart}} đơn hàng)</h5>
                            @else
                                <h5>Tháng này không có sản phẩm nào cần xuất kho</h5>
                            @endif
                        @else
                            <h5>Tháng này không có sản phẩm nào cần xuất kho</h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-plus fa-6x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Số phiếu nhập kho</h5>
                        <h5>{{count($product['stockTranIn'])}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">

                    <i class="fa-solid fa-minus fa-6x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h5 class="fw-bold mt-2">Số phiếu xuất kho</h5>
                        <h5>{{count($product['stockTranOut'])}}</h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-center align-items-center">
        </div>
    </div>
</div>
@endsection
