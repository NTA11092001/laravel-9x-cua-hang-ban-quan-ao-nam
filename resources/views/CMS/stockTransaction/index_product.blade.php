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
                                    <th width="50px" class="text-white text-center" rowspan="2">#</th>
                                    @if($type == 'in')
                                        <th class="text-white" rowspan="2">Tên sản phẩm</th>
                                        <th class="text-white text-center" rowspan="2">Số lượng còn lại</th>
                                    @elseif($type == 'out')
                                        <th class="text-white" rowspan="2">Mã đơn hàng</th>
                                        <th class="text-white text-center">Chi tiết sản phẩm cần xuất kho</th>
                                    @endif
                                    <th class="text-white" rowspan="2">Quản lý</th>
                                </tr>
                            </thead>
                                @if($type == 'in')
                                    @if(count($data_array) > 0)
                                        <tbody class="text-dark">
                                            @foreach($data_array as $i=>$item)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>{{$item->ten}} {{$item->masp}}</td>
                                                    <td class="text-center">{{$item->soluong ? $item->soluong : 0}}</td>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="{{route('admin.stockTransaction.create',['type'=>$type,'product_id'=>$item->id])}}">
                                                        <i class="fas fa-plus-circle"></i> Nhập kho</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr class="text-center">
                                                <td colspan="8">Không có sản phẩm cần nhập kho nào</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @elseif($type == 'out')
                                    @if(count($data_array) > 0)
                                        <tbody class="text-dark">
                                            @foreach($data_array as $i=>$item)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>DH{{$item->id}}</td>
                                                    @if(count($item->cart_detail)>0)
                                                        <td>
                                                            @foreach($item->cart_detail as $cart_detail)
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
                                                        </td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="{{route('admin.stockTransaction.create',['type'=>$type,'cart_id'=>$item->id])}}">
                                                            @if($type == 'in') <i class="fas fa-plus-circle"></i> @else <i class="fas fa-minus-circle"></i> @endif {{ucfirst($title_stock)}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr class="text-center">
                                                <td colspan="8">Không có sản phẩm cần {{$title_stock}} nào</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
