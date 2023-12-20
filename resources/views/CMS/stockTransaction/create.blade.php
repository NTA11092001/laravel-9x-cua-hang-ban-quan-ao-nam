@extends('CMS.master')
@section('content')

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Thêm phiếu {{$title_stock}}</h3>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" autocomplete="off" method="POST" id="registerForm">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <select class="form-control form-select-lg" name="product_id">
                                    @if(count($products) > 0)
                                        <option value="">--Chọn sản phẩm cần {{$title_stock}}--</option>
                                        @foreach($products as $item)
                                            <option value="{{$item->id}}">{{$item->ten}} {{$item->masp}}</option>
                                        @endforeach
                                    @else
                                        <option value="">--Không có sản phẩm cần {{$title_stock}}--</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên</label>
                                <input type="number" name="name" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập Tên"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập số điện thoại"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="register_email">Email</label>
                                <input type="email" name="email" id="register_email" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập email"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="register_password">Mật Khẩu</label>
                                <input type="password" name="password" id="register_password" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập mật khẩu"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Chức vụ</label>
                                <select class="form-control form-select-lg" name="level">
                                    <option value="1">Quản lý</option>
                                    <option value="2">Nhân viên</option>
                                </select>
                            </div>

                            <div>
                                <!-- Button -->
                                <div>
                                    <button class="btn btn-dark" type="button" id="btn_register_account">Thêm phiếu {{$title_stock}}</button>
                                </div>
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

            $('#btn_register_account').on('click', function () {

                var data = new FormData($('#registerForm')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    type: "POST",
                    encytype: 'multipart/form-data',
                    url: '{{route('admin.user.store')}}',
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
                                window.location.replace("{{route('admin.user.index',['status'=>1])}}")
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
