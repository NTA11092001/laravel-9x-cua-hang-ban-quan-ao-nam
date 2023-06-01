<div class="modal-header">
    <h3 class="modal-title">Sửa sản phẩm</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="updateProduct">
        @csrf
        @method('post')
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input class="form-control form-control-lg" type="text" name="ten" placeholder="Nhập tên sản phẩm" value="{{$product->ten}}"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Mã sản phẩm</label>
                    <input class="form-control form-control-lg" type="text" name="masp" placeholder="Nhập mã sản phẩm" value="{{$product->masp}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Giá thường (đơn vị VNĐ)</label>
                    <input class="form-control form-control-lg" type="number" name="giathuong" placeholder="Nhập giá thường" value="{{$product->giathuong}}"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Giá khuyến mãi (đơn vị VNĐ)</label>
                    <input class="form-control form-control-lg" type="number" name="giakm" placeholder="Nhập giá khuyến mãi" value="{{$product->giakm}}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <label class="form-label">Danh mục sản phẩm</label>
                <select class="form-control form-select-lg" name="id_danhmuc">
                    <option value="">--Chọn danh mục sản phẩm--</option>
                    @foreach($categories as $item)
                        <option value="{{$item->id}}" @if($item->id==$product->id_danhmuc) selected @endif>{{$item->ten}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-control form-select-lg" name="status">
                        <option value="1" @if($product->status == 1) selected @endif>Hiển thị</option>
                        <option value="0" @if($product->status == 0) selected @endif>Ẩn</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Số lượng</label>
                    <input class="form-control form-control-lg" type="number" name="soluong" placeholder="Nhập số lượng" value="{{$product->soluong}}"/>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Hình ảnh đại diện</label>
                    <input type="file" class="form-control form-control-lg" name="hinhanh" id="fileEditProduct">
                    <div class="mt-3 show-images-edit-product d-flex justify-content-center">
                        <img src="{{asset($product->hinhanh)}}" alt="{{$product->ten}}" height="100" class="d-inline-block me-2">
                    </div>
                    <div class="mt-3 show-images-update-product d-flex justify-content-center">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-3">
                <label class="form-label">Bộ sưu tập ảnh (Có thể chọn nhiều ảnh)</label>
                <input type="file" class="form-control form-control-lg" name="images[]" multiple id="fileEditProductMultiple">
                <div class="mt-3 show-images-edit-product-multiple d-flex flex-wrap">
                    @foreach($images = explode(',',$product->images) as $image)
                        <img src="{{asset($image)}}" alt="{{$product->ten}}" height="100" class="d-inline-block me-2">
                    @endforeach
                </div>
                <div class="mt-3 show-images-update-product-multiple d-flex flex-wrap">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-3">
                <label class="form-label">Chi tiết sản phẩm</label>
                <textarea class="form-control form-control-lg" name="chitiet" rows="10">{!! $product->chitiet !!}</textarea>
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-dark btn-block" id="btnUpdateProduct" type="button">Sửa sản phẩm</button>
        </div>
    </form>
</div>

<script>
    $(function () {

        $("input[name='soluong']").inputSpinner()

        CKEDITOR.replace( 'chitiet' );

        $('#fileEditProduct').change(function(){
            let strfile = '';
            $.each(this.files, (index, file) => {
                let tmpUrl = URL.createObjectURL(file)
                strfile += '<img src="'+tmpUrl+'" height="100" class="d-inline-block me-2" alt=""/>';
            })
            // alert(strfile)
            $('.show-images-edit-product').addClass('d-none')
            $('.show-images-update-product').html(strfile)
        });

        $('#fileEditProductMultiple').change(function(){
            let strfile = '';
            $.each(this.files, (index, file) => {
                let tmpUrl = URL.createObjectURL(file)
                strfile += '<img src="'+tmpUrl+'" height="100" class="d-inline-block me-2" alt=""/>';
            })
            // alert(strfile)
            $('.show-images-edit-product-multiple').addClass('d-none')
            $('.show-images-update-product-multiple').html(strfile)
        });

        $('#btnUpdateProduct').on('click', function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = new FormData($('#updateProduct')[0]);

            $.ajax({
                method:"POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('admin.product.update')}}',
                data: data,
                processData: false,
                contentType: false,
                success: function (res) {
                    $('#EditProduct').modal('hide')
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        text: res.message,
                        showConfirmButton: false,
                        toast: false,
                        timer: 3500,
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
                        timer: 3500,
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

    })
</script>
