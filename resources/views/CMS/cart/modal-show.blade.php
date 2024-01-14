<div class="modal-header">
    <h3 class="modal-title">Thông tin đơn hàng</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <div class="row">
        <div class="info_oder__head">
            <div class="info_oder__head___col">
                <h3><strong>ĐỊA CHỈ NHẬN HÀNG:</strong></h3>
                <div>{{$transport->name}}</div>
                <div>Địa chỉ: {{$transport->address}}</div>
                <div>Điện thoại: {{$transport->phone}}</div>
            </div>
            <div class="info_oder__head___col">
                <h3><strong>HÌNH THỨC THANH TOÁN:</strong></h3>
                <div class="mb-3">
                    @if($cart->payment_type=='cod')
                        Thanh toán COD
                    @elseif($cart->payment_type=='vnpay')
                        Thanh toán VNPAY
                    @endif
                </div>

                <h3><strong>TÌNH TRẠNG THANH TOÁN:</strong></h3>
                <div class="mb-3">
                    @if($cart->payment_type == 'cod')
                        @if($cart->bill_status == 0)
                            <span class="text-warning">Chưa thanh toán</span>
                        @elseif($cart->bill_status == 1)
                            <span class="text-success">Đã thanh toán</span>
                        @endif
                    @else
                        @if($cart->bill_status == 0)
                            <span class="text-warning">Thanh toán thất bại</span>
                        @elseif($cart->bill_status == 1)
                            <span class="text-success">Thanh toán thành công</span>
                        @endif
                    @endif
                </div>

                <h3><strong>TRẠNG THÁI:</strong></h3>
                <p style="margin-top: 5px; font-style: italic;">
                    @if($cart->status == -1)
                        <span class="text-warning">Đã đặt hàng</span>
                    @elseif($cart->status == 0)
                        <span class="text-primary">Đang chuẩn bị hàng</span>
                    @elseif($cart->status == 1)
                        <span class="text-primary">Đang vận chuyển</span>
                    @elseif($cart->status == 2)
                        <span class="text-primary">Đang giao hàng</span>
                    @elseif($cart->status == 3)
                        <span class="text-success">Đã nhận hàng</span>
                    @elseif($cart->status == -2)
                        <span class="text-danger">Đã hủy</span>
                    @endif
                </p>
            </div>
            <div class="info_oder__head___col">
                <h3><strong>THỜI GIAN GIAO HÀNG:</strong></h3>
                <div>Dự kiến giao hàng vào ngày {{date('d/m/Y',strtotime($cart->estimated_arrival_date))}}</div>
                <div>Ghi chú: {{$transport->note ? $transport->note : 'Không'}}</div>
            </div>

        </div>
        <div class="info_oder__body">
            <div class="list_infamation_cart">
                <table class="table list_cart_temp1">
                    <thead class="table-secondary">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($cart->cart_detail != null)
                        @foreach($cart->cart_detail as $item)
                            <tr>
                                <td width="80%">
                                    <div class="list_cart_temp1-item no-border">
                                        <a href="">
                                            <img src="{{asset($item->hinhanh)}}" class="thumbnail" alt="{{$item->ten}}">
                                        </a>
                                        <div class="infoProduction">
                                            <h3 class="infoProduction_name">{{$item->ten}} {{$item->masp}}</h3>
                                            <div class="infoProduction_option">
                                                Size: {{$item->pivot->size}}<br>
                                                Số lượng: {{$item->pivot->quantity}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{number_format($item->pivot->price*$item->pivot->quantity,0,',','.')}} VNĐ</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <div class="text-right priceTotal">
                                    <br>
                                    <div>Chiết khấu: 0 VNĐ</div>
                                    <div>Phí vận chuyển: 0 VNĐ</div>
                                    <div>Tổng cộng: <strong>{{number_format($cart->total,0,',','.')}} VNĐ</strong> </div>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between  align-items-center">
        @if($cart->status == -1 || $cart->status == -2)
{{--            <form action="{{route('admin.cart.cancel',['id'=>$cart->id])}}" method="POST" id="formCartCancel" class="text-end">--}}
{{--                @csrf--}}
{{--                @method('post')--}}
{{--                <button class="btn btn-danger btn-cancel-cart" type="button">Hủy đơn hàng</button>--}}
{{--            </form>--}}
        @elseif($cart->status == 0 || $cart->status == 1)
            <form action="{{route('admin.cart.status',['cart_id'=>$cart->id,'cart_status'=>$cart->status+1])}}" method="POST" id="formChangeStatus" class="text-end">
                @csrf
                @method('post')
                <button class="btn btn-primary btn-change-status" type="button">@if($cart->status == 0) Vận chuyển @elseif($cart->status == 1) Giao hàng @endif</button>
            </form>
        @endif
    </div>
</div>

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

        $('.btn-change-status').click(function() {
            var text = ''
            @if($cart->status == 0)
                text += 'vận chuyển'
            @elseif($cart->status == 1)
                text += 'giao'
            @endif
            Swal.fire({
                text: 'Bạn có chắc chắn muốn ' + text + ' đơn hàng này ?',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonColor: '#212B36',
                confirmButtonText: 'Xác nhận',
                denyButtonText: 'Huỷ bỏ',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formChangeStatus').submit()
                }
            })
        })


    })
</script>
