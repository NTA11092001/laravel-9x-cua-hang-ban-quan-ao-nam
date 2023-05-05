<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
    <title>Đăng Nhập Trang Quản Trị</title>
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

                                <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG NHẬP TRANG QUẢN TRỊ</h4>

                                <form action="{{route('loginPost')}}" autocomplete="off" method="POST">
                                    @csrf
                                    @method('post')
                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="form2Example17">Tài Khoản</label>
                                        <input type="text" name="username" id="form2Example17" class="form-control form-control-lg" value="{{old('username')}}"/>
                                    </div>

                                    <div class="form-outline mb-4 justify-content-center">
                                        <label class="form-label" for="form2Example27">Mật Khẩu</label>
                                        <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" value="{{old('password')}}"/>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check1" name="remember">
                                        <label class="form-check-label">Ghi nhớ</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit" name="dangnhap">Đăng Nhập</button>
                                    </div>
                                </form>
                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a href="{{route('register')}}" style="color: #393f81;">Đăng Ký</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
