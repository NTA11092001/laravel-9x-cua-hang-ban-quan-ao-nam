<div class="modal-header">
    <h3 class="modal-title">Lịch sử tình trạng thanh toán DH{{$id}}</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <div>
        <div class="container d-flex px-15 py-2">
            <table class="table table-borderless">
                <tbody>
                @foreach($billHistory as $item)
                    @if($item->bill_status == 0)
                        <tr class="text-warning">
                            <td class="text-center"><i class="fas fa-window-close fa-lg"></i></td>
                            <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                            <td>@if($item->cart->payment_type == 'cod') Chưa thanh toán @else Thanh toán thất bại @endif</td>
                        </tr>
                    @elseif($item->bill_status == 1)
                        <tr class="text-success">
                            <td class="text-center"><i class="fas fa-check-square fa-lg"></i></td>
                            <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                            <td>@if($item->cart->payment_type == 'cod') Đã thanh toán @else Thanh toán thành công @endif</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
