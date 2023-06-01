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
                                    <th class="text-center" width="200px">Tình trạng</th>
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
                                            <td class="text-center">
                                                @if($item->status == -1)
                                                    <span class="text-warning">Đơn hàng mới</span>
                                                @elseif($item->status == 0)
                                                    <span class="text-primary">Đã xác nhận</span>
                                                @elseif($item->status == 1)
                                                    <span class="text-success">Đã thanh toán</span>
                                                @elseif($item->status == -2)
                                                    <span class="text-danger">Đã hủy</span>
                                                @endif
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
        })
    </script>
@endpush
