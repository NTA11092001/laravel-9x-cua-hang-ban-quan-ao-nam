<div class="modal-header">
    <h3 class="modal-title">Lịch sử trạng thái DH{{$id}}</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <div>
        <div class="container d-flex px-15 py-2">
            <table class="table table-borderless">
                <tbody>
                    @foreach($statusHistory as $item)
                        @if($item->cart_status == -1)
                            <tr class="text-warning">
                                <td class="text-center"><i class="fa-solid fa-clipboard-list fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đã đặt hàng</td>
                            </tr>
                        @elseif($item->cart_status == 0)
                            <tr class="text-primary">
                                <td class="text-center"><i class="fa-solid fa-box-open fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đang chuẩn bị hàng</td>
                            </tr>
                        @elseif($item->cart_status == 1)
                            <tr class="text-primary">
                                <td class="text-center"><i class="fa-solid fa-truck fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đang vận chuyển</td>
                            </tr>
                        @elseif($item->cart_status == 2)
                            <tr class="text-primary">
                                <td class="text-center"><i class="fa-solid fa-truck fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đang giao hàng</td>
                            </tr>
                        @elseif($item->cart_status == 3)
                            <tr class="text-success">
                                <td class="text-center"><i class="fa-solid fa-circle-check fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đã nhận hàng</td>
                            </tr>
                        @elseif($item->cart_status == -2)
                            <tr class="text-danger">
                                <td class="text-center"><i class="fa-solid fa-circle-xmark fa-2xl"></i></td>
                                <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                <td>Đã hủy</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
