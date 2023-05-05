<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
    <title>Đăng Ký Trang Quản Trị</title>
</head>
<body style="background: #E4E9F7;">
@include('Validation.error')
<section class="vh-100">
    <div class="container py-6 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-11">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">

                        <div class="col-md-12 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <div class="d-flex justify-content-center mb-3 pb-1">
                                    <img src="/img/BAL-logo.png" style="width:40%">
                                </div>

                                <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG KÝ TRANG QUẢN TRỊ</h4>
                                <form action="" autocomplete="off" method="POST" id="registerForm">
                                    @csrf
                                    @method('post')
                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="form2Example17">Tên</label>
                                        <input type="text" name="name" id="form2Example17" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="form2Example17">Số điện thoại</label>
                                        <input type="text" name="phone" id="form2Example17" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="register_email">Email</label>
                                        <input type="email" name="email" id="register_email" class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="register_password">Mật Khẩu</label>
                                        <input type="password" name="password" id="register_password" class="form-control form-control-lg" />
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="button" id="btn_register_account">Đăng Ký</button>
                                    </div>
                                </form>
                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Đã có tài khoản? <a href="{{route('login')}}" style="color: #393f81;">Đăng Nhập</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                var errTxt = '<div class="alert alert-danger d-flex justify-content-center align-content-center"><ul class="list-unstyled">';

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
                    // timer: 3500
                })
            })


        })
    })

</script>

</body>
</html>
