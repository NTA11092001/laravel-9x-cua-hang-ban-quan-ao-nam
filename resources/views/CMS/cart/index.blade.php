@extends('CMS.master')
@section('content')
    <style type="text/css">
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }
    </style>

    <div class="container-fluid p-6">
        <div class="row">
            <div class="container-fluid border-bottom pb-4 mb-4">
                <div class="row">
                    <div class="col-6">
                        <!-- Page header -->
                        <h3 class="mb-0 fw-bold">Danh sách đơn hàng</h3>
                    </div>

                    <div class="col-6">
                        <form class="row justify-content-end" action="{{route('admin.cart.index')}}" method="GET">
                            <div class="col-5">
                                <input class="form-control" type="text" name="madh" placeholder="Nhập mã đơn hàng" value="{{request('madh') ? request('madh') : ''}}">
                            </div>
                            <div class="col-5">
                                <input class="form-select" id="datepicker" type="text" name="date" placeholder="Chọn ngày mua" value="{{request('date') ? request('date') : ''}}" autocomplete="off">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-dark" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
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
                                <th class="text-white">Mã đơn hàng</th>
                                <th class="text-white">Khách hàng</th>
                                <th class="text-white">Ngày mua</th>
                                <th class="text-white text-center">Giá tiền (VNĐ)</th>
                                <th class="text-white text-center">Trạng thái</th>
                                <th class="text-white text-center">Tình trạng xuất kho</th>
                                <th class="text-white text-center" width="300px">Tình trạng thanh toán</th>
                                <th class="text-white text-center">Quản lý</th>
                            </tr>
                            </thead>
                            @if(count($cart)>0)
                                <tbody class="text-dark">
                                @foreach($cart as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>DH{{$item->id}}</td>
                                        <td>{{$item->member->name}}</td>
                                        <td>{{date('d/m/Y',strtotime($item->cart_date))}}</td>
                                        <td class="text-center">{{number_format($item->total,0,',','.')}}</td>
                                        <td style="text-align: center;vertical-align: center">
                                            <div class="d-flex justify-content-between align-content-center">
                                                <div>
                                                    @if($item->status == -1)
                                                        <span class="text-warning">Đã đặt hàng</span>
                                                    @elseif($item->status == 0)
                                                        <span class="text-primary">Đang chuẩn bị hàng</span>
                                                    @elseif($item->status == 1)
                                                        <span class="text-primary">Đang vận chuyển</span>
                                                    @elseif($item->status == 2)
                                                        <span class="text-primary">Đang giao hàng</span>
                                                    @elseif($item->status == 3)
                                                        <span class="text-success">Đã nhận hàng</span>
                                                    @elseif($item->status == -2)
                                                        <span class="text-danger">Đã hủy</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a class="btn btn-primary btn-sm btn-show-status" data-bs-toggle="modal" data-bs-target="#ShowStatus" data-cart-id="{{$item->id}}"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->stock == null)
                                                <span class="text-primary">Chưa xuất kho</span>
                                            @else
                                                <span class="text-success">Đã xuất kho</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;vertical-align: center">
                                            <div class="d-flex justify-content-between align-content-center">
                                                <div class="w-75 d-flex flex-wrap text-start">
                                                    <div class="w-100">@if($item->payment_type == 'cod') Hình thức: COD @else Hình thức: VNPAY @endif</div>
                                                    @if($item->bill_status == 0)
                                                        <span class="text-warning">@if($item->payment_type == 'cod') Chưa thanh toán @else Thanh toán thất bại @endif</span>
                                                    @elseif($item->bill_status == 1)
                                                        <span class="text-success">@if($item->payment_type == 'cod') Đã thanh toán @else Thanh toán thành công @endif</span>
                                                    @endif
                                                </div>
                                                <div class="w-25">
                                                    <a class="btn btn-primary btn-sm btn-show-bill-status" data-bs-toggle="modal" data-bs-target="#ShowBillStatus" data-cart-id="{{$item->id}}"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-cart" data-bs-toggle="modal" data-bs-target="#ShowCart" data-cart-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
{{--                                            <a class="btn btn-danger btn-sm btn-delete-cart" data-cart-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Không có đơn hàng nào</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $cart->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ShowCart" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="contentCart">
                {{--                @include('CMS.cart.modal-show')--}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="ShowStatus" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="contentStatus">
                {{--                @include('CMS.cart.modal-status')--}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="ShowBillStatus" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="contentBillStatus">
                {{--                @include('CMS.cart.modal-bill-status')--}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "dd/mm/yy"
            })

            $('.btn-show-status').click(function(){
                var cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    $.get('{{route('admin.cart.showStatus')}}', {cart_id: cartId}, function(res) {
                        $('#contentStatus').html(res)
                        $('#ShowStatus').modal('show')
                    })
                }
            })

            $('.btn-show-bill-status').click(function(){
                var cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    $.get('{{route('admin.cart.showBillStatus')}}', {cart_id: cartId}, function(res) {
                        $('#contentBillStatus').html(res)
                        $('#ShowBillStatus').modal('show')
                    })
                }
            })

            $('.btn-edit-cart').click(function(){
                var cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    $.get('{{route('admin.cart.show')}}', {cart_id: cartId}, function(res) {
                        $('#contentCart').html(res)
                        $('#ShowCart').modal('show')
                    })
                }
            })

            $('.btn-delete-cart').click(function() {
                let cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    Swal.fire({
                        text: 'Bạn chắn chắn muốn xoá ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('{{route('admin.cart.delete')}}', {cart_id: cartId}, function (res) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2500,
                                    toast: true,
                                    didClose: () => {
                                        location.reload(true)
                                    }
                                })

                            })
                        }

                    })

                }
            })

        })
    </script>
@endpush

