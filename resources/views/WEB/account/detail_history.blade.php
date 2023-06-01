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
                <h3><strong>TÌNH TRẠNG THANH TOÁN:</strong></h3>
                <div>
                    @if($cart->payment_type=='cod')
                        Thanh toán COD
                    @elseif($cart->payment_type=='ttnh')
                        Thanh toán chuyển khoản
                    @endif
                </div>
                <p style="margin-top: 5px; font-style: italic;">
                    @if($cart->status == -1)
                        <span class="text-warning">Đơn hàng mới</span>
                    @elseif($cart->status == 0)
                        <span class="text-primary">Đã xác nhận</span>
                    @elseif($cart->status == 1)
                        <span class="text-success">Đã thanh toán</span>
                    @elseif($cart->status == -2)
                        <span class="text-danger">Đã hủy</span>
                    @endif
                </p>
            </div>
            <div class="info_oder__head___col">
                <h3><strong>THỜI GIAN GIAO HÀNG:</strong></h3>
                <div>Dự kiến giao hàng vào Thứ Bảy, {{date('d/m/Y',strtotime('+5 day',strtotime($cart->cart_date)))}}</div>
                <div>Ghi chú: {{$transport->note}}</div>
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
                                            <img src="{{asset($item->hinhanh)}}" class="thumbnail" alt="Quần âu nam Aristino ATR00203">
                                        </a>
                                        <div class="infoProduction">
                                            <h3 class="infoProduction_name">Quần âu nam Aristino ATR00203</h3>
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
    @if($cart->status == -1)
        <form action="{{route('WEB.cart.cancel',['id'=>$cart->id])}}" method="POST" id="formCartCancel" class="text-end">
            @csrf
            @method('post')
            <button class="btn btn-danger btn-cancel-cart" type="button">Hủy đơn hàng</button>
        </form>
    @endif
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

    })
</script>
