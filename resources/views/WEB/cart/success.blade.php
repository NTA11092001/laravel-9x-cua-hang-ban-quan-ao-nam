@extends('WEB.master')
@section('content')
@include('WEB.includes.payment_bar',['cart'=>$cart])
<div class="container-fluid">
    <section class="page_checkout">
        <div class="row">
            <div class="col-4">
                <div class="page_checkout_col_codeOder">
                    <h3 class="my_order_code">MÃ ĐƠN HÀNG: DH{{$cart_detail->id}}</h3>
                    <p>Trạng thái: <span class="color-success">Đơn hàng mới</span></p>

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
                            <p>@if($cart_detail->payment_type == 'cod') Thanh toán COD @elseif($cart_detail->payment_type == 'ttnh') Thanh toán chuyển khoản @endif</p>

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
                        <h2 class="text_status_order">ĐẶT HÀNG THÀNH CÔNG</h2>
                        <p>Cảm ơn {{$transport->name}} đã cho BAL shop cơ hội được phục vụ!</p>
                        <p>Đơn hàng của Quý Khách đã được đặt thành công. Hệ thống sẽ tự động gửi Email hòm thư mà Quý Khách đã cung cấp.</p>
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
                                                    <img src="{{$item->hinhanh}}" class="thumbnail" alt="{{$item->ten}}">
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
                                            @if($item->giakm != null)
                                                {{number_format($item->pivot->quantity*$item->giakm,0,',','.')}} VNĐ
                                            @elseif($item->giathuong != null)
                                                {{number_format($item->pivot->quantity*$item->giathuong,0,',','.')}} VNĐ
                                            @endif
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
                            <form action="{{route('WEB.change-status')}}" method="POST" id="formCartCancel">
                                @csrf
                                @method('post')
                                <input type="hidden" name="id" value="{{$cart_detail->id}}">
                                <button type="button" class="btn btn-cancel-cart">Hủy đơn hàng</button>
                            </form>
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
        })
    </script>
@endpush
