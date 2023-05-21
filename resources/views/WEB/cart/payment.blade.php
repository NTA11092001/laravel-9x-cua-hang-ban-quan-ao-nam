@extends('WEB.master')
@section('content')
@include('WEB.includes.payment_bar')
@if(session('error'))
    <div class="alert alert-danger bg-danger d-flex justify-content-center align-content-center h-auto pt-2 my-3">
        <p class="text-center text-white">{{session('error')}}</p>
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger d-flex justify-content-center align-content-center bg-danger h-auto my-3">
        <ul class="pt-2 text-white">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('WEB.payment.store')}}" method="POST" id="paymentForm">
@csrf
@method('post')
<input type="hidden" name="cart_date" value="{{date('Y-m-d')}}">
    <input type="hidden" name="total" value="{{Cart::getTotal()}}">
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="heading_layout_other">
                <h2 class="mb-3 mt-3 fw-bold">GIAO HÀNG VÀ THANH TOÁN</h2>
            </div>
            <div class="form_checkout">
                <label class="label mb-3 fw-bold">
                    Thông tin giao hàng
                </label>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{auth('member')->user()->name}}" required="required" placeholder="Họ tên người nhận *">
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" value="{{auth('member')->user()->phone}}" required="required" placeholder="Số điện thoại *">
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" value="{{auth('member')->user()->email}}" placeholder="Email nhận thông tin đơn hàng">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" value="{{auth('member')->user()->address}}" required="required" placeholder="Địa chỉ cụ thể: Số nhà, tên đường, Phường/Xã,.. *">
                        </div>
                    </div>
                </div>
                <label class="label">
                    Ghi chú
                </label>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control" name="note" rows="2" placeholder="Bạn có muốn nhắn gì tới BAL shop không?"></textarea>
                        </div>
                    </div>
                </div>
                <br>

                <label class="label">
                    Chọn hình thức thanh toán
                </label>
                <ul class="list-group list-group-payment list-payment">

                    <li class="list-group-item">
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="COD" class="form-check-input" name="payment_type" value="cod" checked="checked">
                            </div>
                            <img class="ic" src="{{asset('img/cod.png')}}" alt="Thanh toán COD">
                            <label for="PaymentID13421">Thanh toán COD</label>
                        </div>
                    </li>
                    <div class="list_bank list_bank-13421">


                    </div>

                    <li class="list-group-item">
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="TTNH" class="form-check-input" name="payment_type" value="ttnh">
                            </div>
                            <img class="ic" src="{{asset('img/ttnh.png')}}" alt="Thanh toán chuyển khoản">
                            <label for="PaymentID13420">Thanh toán chuyển khoản</label>
                        </div>
                    </li>
                    <div class="list_bank d-none">
                        <div>
                            Lưu ý: Quý khách sử dụng cú pháp sau trong nội dung chuyển khoản:
                            <br>
                            <span class="auto-style1">"Tên KH - Số điện thoại mua hàng - Mã đơn hàng".</span>
                            <br>
                            Ví dụ: Nguyen Van A - 0987654321 - DH100123
                            <br>
                            <ul class="listBankATM">
                                <li>
                                    <div class="img-bank">
                                        <img src="{{asset('img/MB.png')}}"></div>
                                    <div class="detail-bank">
                                        <p><strong>Ngân hàng : Thương mại Cổ phần Quân đội</strong></p>
                                        <p>Chủ tài khoản : <strong>NGUYEN TRUNG ANH</strong></p>
                                        <p>Số tài khoản : 0977324362</p>
                                        <p>Vietcombank - CN Hải Dương - Hải Dương</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-bank"><img src="https://www.bidv.com.vn/wps/wcm/connect/8c895b83-ce8f-44d4-af3d-f1b5c1a382b0/bidv-logo.svg?MOD=AJPERES&amp;cache=none"></div>
                                    <div class="detail-bank">
                                        <p><strong>Ngân hàng : Ngân hàng Đầu tư và Phát triển Việt Nam BIDV</strong></p>
                                        <p>Chủ tài khoản : <strong>NGUYEN TRUNG ANH</strong></p>
                                        <p>Số tài khoản : 21510002959909</p>
                                        <p>BIDV - CN Cầu Giấy - Hà Nội</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                </ul>

                <label class="label">
                    Chọn phương thức giao hàng
                </label>
                <ul class="list-group list-group-payment list-delivery">   <li class="list-group-item">
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="DeliveryID13415" class="form-check-input" name="DeliveryID" data-fee="0" value="13415">
                            </div>
                            <img class="ic" src="{{asset('img/delivery.png')}}" alt="Giao hàng tiêu chuẩn">
                            <label for="DeliveryID13415">Giao hàng tiêu chuẩn</label>
                        </div>
                    </li>   <li class="list-group-item">
                        <div class="payment-box">
                            <div class="form-check">
                                <input type="radio" id="DeliveryID13418" class="form-check-input" name="DeliveryID" data-fee="0" value="13418" checked="">
                            </div>
                            <img class="ic" src="{{asset('img/delivery.png')}}" alt="Miễn phí vận chuyển">
                            <label for="DeliveryID13418">Miễn phí vận chuyển</label>
                        </div>
                    </li></ul>
            </div>
        </div>

        <div class="col-4">
            <div class="box_order_cart">

                <div class="heading_cart">
                    ĐƠN HÀNG ({{count($cart)}})<a href="{{route('WEB.cart.list')}}" class="btn_edit_cart" rel="nofollow">Sửa</a>
                </div>
                <ul class="list_cart_checkout list_cart_temp1">
                    @if(count($cart)>0)
                        @foreach($cart as $item)
                            <li class="list_cart_temp1-item">
                                <img src="{{asset($item->attributes['image'])}}" class="thumbnail" alt="Quần short nam Aristino ASO010S3">
                                <div class="infoProduction">
                                    <h3 class="infoProduction_name">{{$item->name}}</h3>
                                    <div class="infoProduction_option">
                                        Size: {{$item->attributes['size']}}

                                        <br>
                                        Số lượng: {{$item->quantity}}
                                    </div>
                                </div>

                                <span class="infoProduction_price">{{number_format($item->price*$item->quantity,0,',','.')}} VNĐ</span>

                            </li>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="8">
                                <img src="{{asset('CMS/fonts/feather-icons/icons/feather_shopping-cart.svg')}}" alt="feather_shopping-cart">
                                <p>Giỏ hàng của bạn chưa có sản phẩm.</p>
                                <a class="link-offset-2 text-decoration-none link-underline link-underline-opacity-0" href="{{route('WEB.home.index')}}">Chọn sản phẩm ngay</a>
                            </td>
                        </tr>
                    @endif
                </ul>

                <div class="box_order_cart__price">
                    <ul>
                        <li>
                            <span class="tille">Tạm tính:</span>
                            <span class="price black fw-bold">{{ number_format(Cart::getTotal(),0,',','.') }} VNĐ</span>
                        </li>
                        <li>
                            <span class="tille">Phí vận chuyển:</span>
                            <span class="price delivery-value">0 VNĐ</span>
                        </li>
                        <li>
                            <span class="tille"><strong>Thành tiền:</strong></span>
                            <span class="price text-danger fw-bold total-order">{{ number_format(Cart::getTotal(),0,',','.') }} VNĐ</span>
                        </li>
                    </ul>
                </div>

                <button type="button" class="btn btn-outline-dark btn_buy_now">
                    XÁC NHẬN ĐẶT HÀNG
                </button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
    <script>
        $(function () {

            $('#TTNH').click(function () {
                $('.list_bank').removeClass('d-none')
            })
            $('#COD').click(function () {
                $('.list_bank').addClass('d-none')
            })
            $('.btn_buy_now').click(function(){

                @if(count($cart)>0)
                Swal.fire({
                    text: 'Bạn có chắc chắn muốn xác nhận đặt hàng ?',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonColor: '#212B36',
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: 'Huỷ bỏ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#paymentForm').submit()
                    }
                })
                @else
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        text: 'Hiện tại giỏ hàng của bạn đang trống!',
                        showConfirmButton: false,
                        timer: 4000,
                        toast: true,
                    });
                @endif

            })

            $('.check-submit').click(function () {
                @if(count($cart)>0)
                    Swal.fire({
                        text: 'Bạn có chắc chắn muốn xác nhận đặt hàng ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#paymentForm').submit()
                        }
                    })
                @else
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    text: 'Hiện tại giỏ hàng của bạn đang trống!',
                    showConfirmButton: false,
                    timer: 4000,
                    toast: true,
                });
                @endif
            })
        })
    </script>
@endpush
