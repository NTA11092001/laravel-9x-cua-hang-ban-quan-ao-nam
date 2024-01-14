@extends('CMS.master')
@section('content')
    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">{{$title}}</h3>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead style="background-color: #212B36">
                            <tr>
                                <th width="50px" class="text-white text-center">#</th>
                                <th class="text-white" @if($type == 'in') width="320px" @else width="250px" @endif >@if($type == 'in') Chi tiết sản phẩm @else Mã đơn hàng @endif</th>
                                <th class="text-white">@if($type == 'in') Tên nhà cung cấp @else Chi tiết sản phẩm @endif</th>
                                <th class="text-white">Người thực hiện</th>
                                @if($type == 'in')
                                    <th class="text-white text-center">Tổng tiền (VNĐ)</th>
                                @endif
                                <th class="text-white">Ngày {{$title_stock}}</th>
                                <th class="text-white">Trạng thái</th>
                                {{-- <th class="text-white text-center">Quản lý</th> --}}
                            </tr>
                            </thead>
                            @if(count($stocks)>0)
                                <tbody class="text-dark">
                                @foreach($stocks as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>
                                            @if($type == 'in')
                                                <div class="list_cart-item no-border">
                                                    <a href="">
                                                        <img src="{{asset($item->product->hinhanh)}}" class="thumbnail" alt="{{$item->product->ten}}">
                                                    </a>
                                                    <div class="infoProduction">
                                                        <h3 class="infoProduction_name">{{$item->product->ten}} {{$item->product->masp}}</h3>
                                                        <div class="infoProduction_option">
                                                            Số lượng nhập: {{$item->quantity}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                DH{{$item->cart->id}}
                                            @endif
                                        </td>

                                        <td>
                                            @if($type == 'in')
                                                {{$item->supplier->name}}
                                            @else
                                                @if(count($item->cart->cart_detail)>0)
                                                    @foreach($item->cart->cart_detail as $cart_detail)
                                                        <div class="list_cart-item no-border">
                                                            <a href="">
                                                                <img src="{{asset($cart_detail->hinhanh)}}" class="thumbnail" alt="{{$cart_detail->ten}}">
                                                            </a>
                                                            <div class="infoProduction">
                                                                <h3 class="infoProduction_name">{{$cart_detail->ten}} {{$cart_detail->masp}}</h3>
                                                                <div class="infoProduction_option">
                                                                    Size: {{$cart_detail->pivot->size}}<br>
                                                                    Số lượng: {{$cart_detail->pivot->quantity}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else

                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$item->user->name}}</td>
                                        @if($type == 'in')
                                            <td class="text-center">{{number_format($item->stock_in_price*$item->quantity,0,',','.')}}</td>
                                        @endif
                                        <td>{{date('d/m/Y H:i:s',strtotime($item->created_at))}}</td>
                                        <td>
                                            @if($type == 'in')
                                                @if($item->status==1)
                                                    Đã nhập kho
                                                @else
                                                    Đang chờ phê duyệt
                                                @endif
                                            @else
                                                @if($item->status==1)
                                                    Đã xuất kho
                                                @else
                                                    Đang chờ phê duyệt
                                                @endif
                                            @endif
                                        </td>
                                        {{-- <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-check"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Không có phiếu {{$title_stock}} nào</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $stocks->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
