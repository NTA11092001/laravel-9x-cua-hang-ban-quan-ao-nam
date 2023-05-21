@extends('WEB.master')
@section('content')
<div class="container-fluid">
    <section class="layout_dasboard">
        <div class="row p-3">
            <h5 class="mb-4 text-center"><strong>LỊCH SỬ ĐƠN HÀNG</strong></h5>
            <table class="table table-striped">
                <thead>
                <tr class="table-secondary">
                    <th>Mã đơn hàng</th>
                    <th>Ngày mua</th>
                    <th>Sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Tình trạng</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                        <span class="color-info">DH190520230057781</span>
                    </td>
                    <td>19/05/2023</td>
                    <td>DH190520230057781</td>
                    <td>895.000đ</td>
                    <td><span class="color-warning">Hủy</span></td>
                </tr>
                <tr class="info_oder order_57781" style="display: table-row;">
                    <td colspan="5">
                        <div class="info_oder__head">
                            <div class="info_oder__head___col">
                                <h3><strong>ĐỊA CHỈ NHẬN HÀNG:</strong></h3>
                                <div>Lộc</div>
                                <div>Địa chỉ: ngõ 123 Trần Cung</div>
                                <div>Điện thoại: 0988341273</div>
                            </div>
                            <div class="info_oder__head___col">
                                <h3><strong>TÌNH TRẠNG THANH TOÁN:</strong></h3>
                                <div>Thanh toán COD</div>
                                <p style="margin-top: 5px; color: #BD7509; font-style: italic;">Thanh toán thành công.</p>
                            </div>
                            <div class="info_oder__head___col">
                                <h3><strong>THỜI GIAN GIAO HÀNG:</strong></h3>
                                <div>Dự kiến giao hàng vào Thứ Bảy, 20/05</div>
                                <div>Ghi chú: Giao hàng trong giờ hành chính</div>
                            </div>
                        </div>

                        <div class="info_oder__body">
                            <div class="list_infamation_cart">
                                <table class="table list_cart_temp1">
                                    <tbody>

                                    <tr>
                                        <td width="80%">
                                            <div class="list_cart_temp1-item no-border">
                                                <a href="https://aristino.com/quan-au-nam-aristino-atr00203.html">
                                                    <img src="/Data/ResizeImage/images/product/quan-au/atr00203/NTC_4455x650x650x4.webp" class="thumbnail" alt="Quần âu nam Aristino ATR00203">
                                                </a>
                                                <div class="infoProduction">
                                                    <h3 class="infoProduction_name">Quần âu nam Aristino ATR00203</h3>
                                                    <div class="infoProduction_option">
                                                        Màu: Xanh tím than 50 kẻ / 29<br>
                                                        Số lượng: 1
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">895.000đ</td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <div class="text-right priceTotal">
                                                <br>
                                                <div>Chiết khấu: 0đ</div>
                                                <div>Phí vận chuyển: 0đ</div>
                                                <div>Tổng cộng: <strong>895.000đ</strong> </div>
                                                <br>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between  align-items-center">
                            <button type="button" class="btn btn-default border border-1 border-dark" onclick="$('.info_oder').hide()">
                                Rút gọn
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="angle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-angle-up fa-w-8 fa-2x">
                                    <path fill="currentColor" d="M136.5 185.1l116 117.8c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L128 224.7 27.6 326.9c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17l116-117.8c4.7-4.6 12.3-4.6 17 .1z" class=""></path>
                                </svg>
                            </button>
                        </div>


                        <div class="modal fade modal-customer modal-cancel" id="modal-order-57781" tabindex="-1" data-backdrop="false" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" id="cancel_form_57781" name="cancel_form_57781">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"></path>
                                                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"></path>
                                            </svg>
                                        </button>
                                        <div class="modal-body">
                                            <div class="page_checkout__form">
                                                <div class="form_checkout">
                                                    <label class="label">
                                                        Xác nhận hủy đơn hàng
                                                    </label>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Lý do hủy đơn hàng</label>
                                                            <select class="form-select form-control" id="ReasonID" name="ReasonID">
                                                                <option value="0">Chọn lý do</option>
                                                                <option value="58579">Đổi sản phẩm</option><option value="58580">Thay đổi ý định</option><option value="58581">Lý do khác</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ghi chú</label>
                                                            <input type="hidden" name="code" value="DH190520230057781">
                                                            <textarea class="form-control" name="ReasonContent" rows="2" placeholder="Ghi chú khi hủy đơn hàng..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                            <button type="button" class="btn btn-primary" onclick="cancel_order_57781()">Hủy đơn</button>
                                            <input type="submit" style="display: none">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
