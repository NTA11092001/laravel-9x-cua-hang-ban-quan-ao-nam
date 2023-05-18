<div class="modal-header">
    <h3 class="modal-title">Sửa danh mục sản phẩm</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="updateCategory">
        @csrf
        @method('post')
        <div class="row">
            <input type="hidden" name="id" value="{{$category->id}}">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tên danh mục</label>
                    <input class="form-control form-control-lg" type="text" name="ten" placeholder="Nhập tên danh mục" value="{{$category->ten}}"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Thứ tự</label>
                    <input class="form-control form-control-lg" type="number" name="thutu" value="{{$category->thutu}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-control form-select-lg" name="status">
                        <option value="1" @if($category->status == 1) selected @endif>Hiển thị</option>
                        <option value="0" @if($category->status == 0) selected @endif>Ẩn</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-dark btn-block" id="btnUpdateCategory" type="button">Sửa danh mục sản phẩm</button>
        </div>
    </form>
</div>

<script>
    $(function () {
        $("input[type='number']").inputSpinner()
    })

    $('#btnUpdateCategory').on('click', function () {
        if($("input[name='thutu']").val()>0){
            var data = new FormData($('#updateCategory')[0]);

            $.ajax({
                method:"POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('admin.category.update')}}',
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
        }else{
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                text: 'Thứ tự phải là 1 số và lớn hơn 1',
                showConfirmButton: false,
                toast: false,
                timer: 3500
            })
        }

    })
</script>
