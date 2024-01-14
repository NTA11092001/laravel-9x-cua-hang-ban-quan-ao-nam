<input type="hidden" name="cart_id" value="{{$cart->id}}">
<input type="hidden" name="type" value="out">
<div class="container-fluid p-1">
    Mã đơn hàng: DH{{$cart->id}}
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
                            <div class="list_cart-item no-border">
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
                            <div>Tổng cộng: <strong>{{number_format($cart->total,0,',','.')}} VNĐ</strong> </div>
                        <br>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Ghi chú</label>
    <textarea class="form-control form-text" name="note"></textarea>
</div>
<div class="mt-3">
    <button class="btn btn-dark btn-block" type="submit">
        {{-- <i class="fa-solid fa-minus-circle"></i> @if(auth()->user()->level == 2)Yêu cầu xuất kho @else Xuất kho @endif --}}
        <i class="fa-solid fa-minus-circle"></i> Xuất kho
    </button>
</div>
