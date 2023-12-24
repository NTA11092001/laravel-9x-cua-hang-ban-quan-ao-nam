@extends('WEB.master')
@section('content')
@include('WEB.includes.payment_bar',['cart'=>$cart])
<div class="container-fluid">
    <section class="page_checkout">
        <div class="row">
            <div class="col-4">
                <div class="page_checkout_col_codeOder">
                    <h3 class="my_order_code">MÃ ĐƠN HÀNG: DH{{$cart_detail->id}}</h3>
                    <p>Trạng thái:
                        @if($cart_detail->status == -1)
                            <span class="text-warning">Đã đặt hàng</span>
                        @elseif($cart_detail->status == 0)
                            <span class="text-primary">Đang chuẩn bị hàng</span>
                        @elseif($cart_detail->status == 1)
                            <span class="text-primary">Đang vận chuyển</span>
                        @elseif($cart_detail->status == 2)
                            <span class="text-primary">Đang giao hàng</span>
                        @elseif($cart_detail->status == 3)
                            <span class="text-success">Đã nhận hàng</span>
                        @elseif($cart_detail->status == -2)
                            <span class="text-danger">Đã hủy</span>
                        @endif
                    </p>

                    <hr>
                    <ul class="list-checkout-info">
                        <li>
                            <h3 class="title_codeOder">Địa chỉ nhận hàng:</h3>
                            <p>{{$transport->name}}</p>
                            <p>Địa chỉ: {{$transport->address}}</p>
                            <p>Điện thoại: {{$transport->phone}}</p>
                        </li>
                        <li>
                            <h3 class="title_codeOder">HÌNH THỨC THANH TOÁN:</h3>
                            <p>@if($cart_detail->payment_type == 'cod') Thanh toán COD @elseif($cart_detail->payment_type == 'vnpay') Thanh toán VNPAY @endif</p>

                        </li>
                        <li>
                            <h3 class="title_codeOder">TRẠNG THÁI THANH TOÁN:</h3>
                            <p>
                                @if($cart_detail->bill_status == 0)
                                    <span class="text-warning">@if($cart_detail->payment_type == 'cod') Chưa thanh toán @else Thanh toán thất bại @endif</span>
                                @elseif($cart_detail->bill_status == 1)
                                    <span class="text-success">@if($cart_detail->payment_type == 'cod') Đã thanh toán @else Thanh toán thành công @endif</span>
                                @endif
                            </p>

                        </li>
                        <li>

                            <h3 class="title_codeOder">THỜI GIAN GIAO HÀNG</h3>
                            <p>Dự kiến giao hàng trong vòng 2-7 ngày</p>
                            <p>Ghi chú: {{$transport->note}}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="page_checkout_col_infomation_content">
                    <div class="content_cart">
                        <h2 class="text_status_order">{{$title}}</h2>
                        <p>Cảm ơn {{$transport->name}} đã cho BAL shop cơ hội được phục vụ!</p>
                        <p>Đơn hàng của Quý Khách đã được đặt thành công.
{{--                            Hệ thống sẽ tự động gửi Email hòm thư mà Quý Khách đã cung cấp.--}}
                        </p>
                        <hr>
                    </div>
                    <div class="list_infamation_cart">
                        <h3 class="heading">THÔNG TIN SẢN PHẨM</h3>
                        <table class="table list_cart_temp1">
                            <thead class="table-secondary">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cart_detail->cart_detail!=null)
                                @foreach($cart_detail->cart_detail as $item)
                                    <tr>
                                        <td width="80%">
                                            <div class="list_cart_temp1-item border-0">
                                                <a href="https://aristino.com/quan-au-nam-aristino-atr00203.html" target="_blank">
                                                    <img src="{{asset($item->hinhanh)}}" class="thumbnail" alt="{{$item->ten}}">
                                                </a>
                                                <div class="infoProduction">
                                                    <h3 class="infoProduction_name">{{$item->ten}} {{$item->masp}}</h3>
                                                    <div class="infoProduction_option">

                                                        Size: {{$item->pivot->size}}
                                                        <br>

                                                        Số lượng: {{$item->pivot->quantity}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{number_format($item->pivot->quantity*$item->pivot->price,0,',','.')}} VNĐ
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    Không có dữ liệu cho đơn hàng này
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">

                                    <div class="text-end">
                                        <br>
                                        <div>Tạm tính: {{number_format($cart_detail->total,0,',','.')}} VNĐ</div>
                                        <div>Phí vận chuyển: 0 VNĐ</div>
                                        <div>Tổng thanh toán: <strong>{{number_format($cart_detail->total,0,',','.')}} VNĐ</strong></div>
                                        <br>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>



                        <div class="d-flex justify-content-between  align-items-center">
                            <div class="d-flex justify-content-start">
                                @if($cart_detail->bill_status == 0 && $cart_detail->payment_type=='vnpay')
                                    <form action="{{route('vnpayment',['id'=>$cart_detail->id])}}" method="POST" id="formCartPayment" class="text-end">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="total" value="{{$cart_detail->total}}">
                                        <button class="btn btn-primary btn-payment" type="button">Thanh toán lại</button>
                                    </form>
                                @elseif($cart_detail->status == -1)
                                    <form action="{{route('WEB.change-status')}}" method="POST" id="formCartCancel">
                                        @csrf
                                        @method('post')
                                        <input type="hidden" name="id" value="{{$cart_detail->id}}">
                                        <button type="button" class="btn btn-cancel-cart">Hủy đơn hàng</button>
                                    </form>
                                @endif
                            </div>

                            <button type="button" class="btn btn-dark" onclick="location.href='{{route('WEB.history')}}'">Theo dõi đơn hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $('.btn-cancel-cart').click(function () {
                Swal.fire({
                    text: 'Bạn có chắc chắn muốn hủy đơn hàng này ?',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonColor: '#212B36',
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: 'Huỷ bỏ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formCartCancel').submit()
                    }
                })
            })
            $('.btn-payment').click(function () {
                Swal.fire({
                    text: 'Bạn có chắc chắn muốn thanh toán lại đơn hàng này ?',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonColor: '#212B36',
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: 'Huỷ bỏ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formCartPayment').submit()
                    }
                })
            })
        })
    </script>
@endpush
