<div class="mb-3">
    <div class="info_oder__body">
        <div class="list_infamation_cart">
            <table class="table list_cart_temp1">
                <thead class="table-secondary">
                <tr>
                    <th>Sản phẩm</th>
                    <th class="text-center">Số lượng nhập</th>
                    <th class="text-center">Giá nhập (VNĐ)</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="60%">
                            <div class="list_cart_temp1-item no-border">
                                <a href="">
                                    <img src="{{asset($product->hinhanh)}}" class="thumbnail" alt="{{$product->ten}}">
                                </a>
                                <div class="infoProduction">
                                    <h3 class="infoProduction_name">{{$product->ten}} {{$product->masp}}</h3>
                                    <div class="infoProduction_option">

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;vertical-align: middle">
                            <div class="container p-8">
                                <input class="form-control" type="number" name="quantity" value="1">
                            </div>
                        </td>
                        <td style="text-align: center;vertical-align: middle">
                            <div class="container">
                                <input class="form-control" type="number" name="stock_in_price" value="100000">
                            </div>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="text-right priceTotal">
                            <br>
                                <div>Tổng cộng: <strong id="total">{{number_format(100000,0,',','.')}} VNĐ</strong> </div>
                            <br>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div>
    <!-- Button -->
    <div>
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="hidden" name="type" value="in">
        <button class="btn btn-dark" type="submit" >Thêm nhập kho</button>
    </div>
</div>

<script>
    $(document).change(function () {
        var quantity = $('input[name="quantity"]').val()
        var stock_in_price = $('input[name="stock_in_price"]').val()
        $.post('{{route('admin.stockTransaction.caculator')}}', {quantity:quantity,stock_in_price:stock_in_price} , function (res) {
            $('#total').text(res)
        })
    })

</script>
