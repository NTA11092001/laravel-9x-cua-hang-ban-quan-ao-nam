@extends('WEB.master')
@section('content')
<div class="container-fluid">
    <div class="row p-3">
        <div class="col-3">

            @include('WEB.account.menu_account')

        </div>

        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <section class="layout_dasboard">
                        <div class="row p-3">
                            <table class="table table-striped">
                                <thead>
                                <tr class="table-secondary">
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày mua</th>
                                    <th class="text-center">Sản phẩm</th>
                                    <th width="170px">Giá tiền (VNĐ)</th>
                                    <th class="text-center" width="250px">Trạng thái</th>
                                    <th class="text-center" width="300px">Tình trạng thanh toán</th>
                                </tr>
                                </thead>
                                @if(count($cart)>0)
                                <tbody>

                                    @foreach($cart as $item)
                                        <tr>
                                            <td>
                                                <span class="color-info">DH{{$item->id}}</span>
                                            </td>
                                            <td>{{date('d/m/Y',strtotime($item->cart_date))}}</td>
                                            <td class="text-center show-cart-detail" data-bs-toggle="modal" data-bs-target="#ShowCart" data-id="{{$item->id}}" style="cursor: pointer"><i class="fa fa-eye"></i></td>
                                            <td>{{number_format($item->total,0,',','.')}}</td>
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
                                                        <a class="btn btn-show-status" data-bs-toggle="modal" data-bs-target="#ShowStatus" data-cart-id="{{$item->id}}"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                </div>
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
                                                        <a class="btn btn-show-bill-status" data-bs-toggle="modal" data-bs-target="#ShowBillStatus" data-cart-id="{{$item->id}}"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">Bạn chưa có đơn hàng nào</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </section>
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
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.show-cart-detail').click(function(){
                var cartId = $(this).attr('data-id')
                if(cartId !== undefined) {
                    $.get('{{route('WEB.cart_detail')}}', {cart_id: cartId}, function(res) {
                        $('#contentCart').html(res)
                        $('#ShowCart').modal('show')
                    })
                }
            })

            $('.btn-show-status').click(function(){
                var cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    $.get('{{route('WEB.cart.showStatus')}}', {cart_id: cartId}, function(res) {
                        $('#contentStatus').html(res)
                        $('#ShowStatus').modal('show')
                    })
                }
            })

            $('.btn-show-bill-status').click(function(){
                var cartId = $(this).attr('data-cart-id')
                if(cartId !== undefined) {
                    $.get('{{route('WEB.cart.showBillStatus')}}', {cart_id: cartId}, function(res) {
                        $('#contentBillStatus').html(res)
                        $('#ShowBillStatus').modal('show')
                    })
                }
            })
        })
    </script>
@endpush
