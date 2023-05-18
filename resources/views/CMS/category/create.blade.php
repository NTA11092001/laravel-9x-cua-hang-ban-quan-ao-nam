@extends('CMS.master')
@section('content')

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Thêm danh mục sản phẩm</h3>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" autocomplete="off" method="POST" enctype="multipart/form-data" id="CreateCategory">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tên danh mục</label>
                                        <input class="form-control form-control-lg" type="text" name="ten" placeholder="Nhập tên danh mục"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Thứ tự</label>
                                        <input class="form-control form-control-lg" type="number" name="thutu" value="1"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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

                            <div class="mt-3">
                                <button class="btn btn-dark btn-block" id="BtnCreateCategory" type="button">Thêm danh mục sản phẩm</button>
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
            $("input[type='number']").inputSpinner()
        })

        $('#BtnCreateCategory').on('click', function () {
            if($("input[name='thutu']").val()>0){
                var data = new FormData($('#CreateCategory')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    type: "POST",
                    encytype: 'multipart/form-data',
                    url: '{{route('admin.category.store')}}',
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
                                window.location.replace("{{route('admin.category.index')}}")
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
@endpush
