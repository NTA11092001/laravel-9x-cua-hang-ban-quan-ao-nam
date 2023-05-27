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
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Danh sách đơn hàng</h3>
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
                                        <td class="text-center">
                                            @if($item->status != -2)
                                            <select name="status" data-id="{{$item->id}}" style="background-color: transparent; border: none; outline: none">
                                                <option value="-1" @if($item->status == -1) selected @endif>Đơn hàng mới</option>
                                                <option value="0" @if($item->status == 0) selected @endif>Xác nhận</option>
                                                <option value="1" @if($item->status == 1) selected @endif>Đã thanh toán</option>
                                            </select>
                                            @else
                                                <span class="text-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-cart" data-bs-toggle="modal" data-bs-target="#ShowCart" data-cart-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-cart" data-cart-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Không có tài khoản khách hàng nào</td>
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
                {{--                @include('CMS.product.modal-edit')--}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

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

            $('select[name="status"]').change(function() {
                let cart_id = $(this).attr('data-id')
                let status = $(this).val()
                let data = { id: cart_id, status: status}

                $.post('{{route('admin.cart.status')}}', data, function(res) {
                    if(res.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 4000,
                            toast: true,
                        });
                    }
                })
            })

        })
    </script>
@endpush

