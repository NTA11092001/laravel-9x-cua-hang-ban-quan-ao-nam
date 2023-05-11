<!DOCTYPE html>
<html lang="en">

<head>
    @include('CMS.includes.head')
</head>

<body class="bg-light">

<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0
        min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
                <!-- Card body -->
                <div class="card-body p-6">
                    <div class="mb-4">
                        <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG KÝ TRANG QUẢN TRỊ</h4>
                        <div class="d-flex justify-content-center mb-3 pb-1">
                            <img src="{{asset('img/BAL-logo.png')}}" style="width:40%">
                        </div>

                    </div>
                    <!-- Form -->
                    <form action="" autocomplete="off" method="POST" id="registerForm">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" name="name" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập Tên"/>
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

                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button class="btn btn-dark" type="button" id="btn_register_account">Đăng Ký</button>
                            </div>

                            <p class="mt-5 pb-lg-2" style="color: #393f81;">Đã có tài khoản? <a href="{{route('login')}}">Đăng Nhập</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('CMS.includes.scripts')
<script>
    $(function() {
        $('#btn_register_account').on('click', function () {

            var data = new FormData($('#registerForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('registerPost')}}',
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
                            window.location.replace("{{route('login')}}")
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
    })

</script>

</body>

</html>
