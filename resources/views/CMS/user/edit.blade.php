@extends('CMS.master')
@section('content')
    <style type="text/css">
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }
    </style>

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->

                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Thông tin tài khoản</h3>

                </div>

            </div>
        </div>
        <div class="row mb-8">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="mb-4 mb-lg-0">
                    <h4 class="mb-1">Chỉnh sửa thông tin tài khoản</h4>
                </div>

            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body">
                            <form action="" autocomplete="off" method="POST" id="editUserForm">
                                <!-- row -->

                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label form-label">Tên</label>
                                    <div class="col-md-8 col-12">
                                        <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Nhập Tên" value="{{$user->name}}"/>
                                    </div>
                                </div>

                                <!-- row -->
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label form-label">Số điện thoại</label>
                                    <div class="col-md-8 col-12">
                                        <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Nhập số điện thoại" value="{{$user->phone}}"/>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label form-label">Email</label>
                                    <div class="col-md-8 col-12">
                                        <input type="email" name="email" id="editUser_email" class="form-control" autocomplete="off" placeholder="Nhập email" value="{{$user->email}}"/>
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row align-items-center">
                                    <div class="offset-md-4 col-md-8 mt-4">
                                        <button type="button" class="btn btn-dark btn-edit-user">Sửa thông tin tài khoản</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-8">
                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                    <div class="mb-4 mb-lg-0">
                        <h4 class="mb-1">Chỉnh sửa mật khẩu</h4>
                    </div>

                </div>

                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <!-- card -->
                    <div class="card" id="edit">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="" autocomplete="off" method="post" id="changePassForm">
                                <!-- row -->
                                <div class="mb-3 row">
                                    <label for="currentPassword" class="col-sm-4 col-form-label form-label">Mật khẩu hiện tại</label>

                                    <div class="col-md-8 col-12">
                                        <input type="password" class="form-control" name="current" placeholder="Nhập mật khẩu hiện tại" id="currentPassword">
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="mb-3 row">
                                    <label for="currentNewPassword" class="col-sm-4 col-form-label form-label">Mật khẩu mới</label>

                                    <div class="col-md-8 col-12">
                                        <input type="password" class="form-control" name="new" placeholder="Nhập mật khẩu mới" id="currentNewPassword">
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row align-items-center">
                                    <label for="confirmNewpassword" class="col-sm-4 col-form-label form-label">Xác nhận mật khẩu mới</label>
                                    <div class="col-md-8 col-12 mb-2 mb-lg-0">
                                        <input type="password" class="form-control" name="confirm_new" placeholder="Xác nhận mật khẩu mới" id="confirmNewpassword">
                                    </div>
                                    <!-- list -->
                                    <div class="offset-md-4 col-md-8 col-12 mt-4">
                                        <button type="button" class="btn btn-dark btn-change-pass">Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                    <div class="mb-4 mb-lg-0">
                        <h4 class="mb-1">Xóa tài khoản</h4>
                    </div>

                </div>

                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <!-- card -->

                    <div class="card mb-6">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="mb-6">
                                <h4 class="mb-1">Vùng nguy hiểm</h4>

                            </div>
                            <div>
                                <!-- text -->
                                <p>Khi bạn ấn vào nút này sẽ xóa vĩnh viễn tài khoản của bạn</p>
                                <button class="btn btn-danger btn-destroy-user">Xóa vĩnh viễn tài khoản</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $('.btn-edit-user').click( function () {

                var data = new FormData($('#editUserForm')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    type: "POST",
                    encytype: 'multipart/form-data',
                    url: '{{route('admin.user.update')}}',
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
                                location.reload()
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

                    if (res.responseJSON.errors !== undefined) {
                        Object.keys(res.responseJSON.errors).forEach(key => {
                            errTxt += '<li class="py-1">' + res.responseJSON.errors[key][0] + '</li>';
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

            $('.btn-change-pass').click( function () {

                var data = new FormData($('#changePassForm')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    type: "POST",
                    encytype: 'multipart/form-data',
                    url: '{{route('admin.user.password')}}',
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
                                location.reload()
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

                    if (res.responseJSON.errors !== undefined) {
                        Object.keys(res.responseJSON.errors).forEach(key => {
                            errTxt += '<li class="py-1">' + res.responseJSON.errors[key][0] + '</li>';
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

            $('.btn-destroy-user').click(function() {
                Swal.fire({
                    text: 'Bạn chắn chắn muốn xoá ?',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonColor: '#212B36',
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: 'Huỷ bỏ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('{{route('admin.user.destroy')}}', function (res) {
                            Swal.fire({
                                position: 'top-start',
                                icon: 'success',
                                text: res.message,
                                showConfirmButton: false,
                                toast: false,
                                timer: 3500,
                                didClose: () => {
                                    window.location.replace('{{route('login')}}')
                                }
                            })

                        })
                    }

                })
            })

        })
    </script>
@endpush

