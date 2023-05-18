@extends('CMS.master')
@section('content')

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Thêm sản phẩm</h3>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="CreateProduct">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tên sản phẩm</label>
                                        <input class="form-control form-control-lg" type="text" name="ten" placeholder="Nhập tên sản phẩm" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mã sản phẩm</label>
                                        <input class="form-control form-control-lg" type="text" name="masp" placeholder="Nhập mã sản phẩm"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Giá thường (đơn vị VNĐ)</label>
                                        <input class="form-control form-control-lg" type="number" name="giathuong" placeholder="Nhập giá thường" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Giá khuyến mãi (đơn vị VNĐ)</label>
                                        <input class="form-control form-control-lg" type="number" name="giakm" placeholder="Nhập giá khuyến mãi"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Danh mục sản phẩm</label>
                                    <select class="form-control form-select-lg" name="id_danhmuc">
                                        <option value="">--Chọn danh mục sản phẩm--</option>
                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <select class="form-control form-select-lg" name="status">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Số lượng</label>
                                        <input class="form-control form-control-lg" type="number" name="soluong" placeholder="Nhập số lượng" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hình ảnh đại diện</label>
                                        <input type="file" class="form-control form-control-lg" name="hinhanh" id="fileProduct">
                                        <div class="mt-3 show-images-product d-flex justify-content-center">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Bộ sưu tập ảnh (Có thể chọn nhiều ảnh)</label>
                                    <input type="file" class="form-control form-control-lg" name="images[]" multiple id="fileProductMultiple">
                                    <div class="mt-3 show-images-product-multiple d-flex flex-wrap">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Chi tiết sản phẩm</label>
                                    <textarea class="form-control form-control-lg" name="chitiet" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-dark btn-block" id="BtnCreateProduct" type="button">Thêm sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

            $("input[name='soluong']").inputSpinner()

            CKEDITOR.replace( 'chitiet' );

            $('#fileProduct').change(function(){
                let strfile = '';
                $.each(this.files, (index, file) => {
                    let tmpUrl = URL.createObjectURL(file)
                    strfile += '<img src="'+tmpUrl+'" height="100" class="d-inline-block me-2" alt=""/>';
                })
                // alert(strfile)
                $('.show-images-product').html(strfile)
            });

            $('#fileProductMultiple').change(function(){
                let strfile = '';
                $.each(this.files, (index, file) => {
                    let tmpUrl = URL.createObjectURL(file)
                    strfile += '<img src="'+tmpUrl+'" height="100" class="d-inline-block me-2" alt=""/>';
                })
                // alert(strfile)
                $('.show-images-product-multiple').html(strfile)
            });

            $('#BtnCreateProduct').on('click', function () {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var data = new FormData($('#CreateProduct')[0]);
                $.ajax({
                    method: "POST",
                    type: "POST",
                    encytype: 'multipart/form-data',
                    url: '{{route('admin.product.store')}}',
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
                            timer: 3500,
                            didClose: () => {
                                window.location.replace("{{route('admin.product.index')}}")
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
@endpush
