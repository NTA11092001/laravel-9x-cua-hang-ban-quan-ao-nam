<div class="modal-header">
    <h3 class="modal-title">Cập nhật nhà cung cấp</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="updateSupplier">
        @csrf
        @method('post')
        <input type="hidden" name="id" value="{{$supplier->id}}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tên nhà cung cấp</label>
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Nhập tên nhà cung cấp" value="{{$supplier->name}}"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Người liên hệ</label>
                    <input class="form-control form-control-lg" type="text" name="contact_person" placeholder="Nhập tên người liên hệ" value="{{$supplier->contact_person}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input class="form-control form-control-lg" type="text" name="contact_number" placeholder="Nhập số điện thoại" value="{{$supplier->contact_number}}"/>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-dark btn-block" id="btnUpdateSupplier" type="button">Cập nhật nhà cung cấp</button>
        </div>
    </form>
</div>

<script>
    $('#btnUpdateSupplier').on('click', function () {
        var data = new FormData($('#updateSupplier')[0]);

        $.ajax({
            method:"POST",
            type: "POST",
            encytype: 'multipart/form-data',
            url: '{{route('admin.supplier.update')}}',
            data: data,
            processData: false,
            contentType: false,
            success: function (res) {
                Swal.fire({
                    position: 'top-start',
                    icon: 'success',
                    text: res.message,
                    showConfirmButton: false,
                    toast: false,
                    timer: 5000,
                    didClose: () => {
                        location.reload(true)
                    }
                })
            },
            fail: function (res) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    html: res.message,
                    showConfirmButton: false,
                    toast: false,
                    timer: 5000,
                })
            }

        }).fail(function (res) {
            var errTxt = '<div class="bg-danger d-flex justify-content-center align-content-center"><ul class="text-start text-white pt-2">';

            if(res.responseJSON.errors !== undefined) {
                Object.keys(res.responseJSON.errors).forEach(key => {
                    errTxt += '<li class="py-1">'+res.responseJSON.errors[key][0]+'</li>';
                });
            }
            errTxt += '</ul></div>';

            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                html: errTxt,
                showConfirmButton: false,
                toast: false,
                timer: 3500
            })
        })

    })
</script>
