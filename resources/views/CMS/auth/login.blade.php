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
                        <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG NHẬP TRANG QUẢN TRỊ</h4>
                        <div class="text-center">
                            <img src="{{asset('img/BAL-logo.png')}}" alt="BAL-logo" class="img-fluid rounded-circle" width="132" height="132" />
                        </div>
                    </div>
                    <!-- Form -->
                    @include('Validation.error')
                    <form action="{{route('loginPost')}}" autocomplete="off" method="POST">
                    @csrf
                    @method('post')
                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label">Tài khoản (Số điện thoại hoặc email)</label>
                            <input class="form-control" type="text" name="username" placeholder="Nhập tài khoản" value="{{old('username')}}"/>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" value="{{old('password')}}"/>
                        </div>
                        <!-- Checkbox -->
                        <div class="d-lg-flex justify-content-between align-items-center mb-4">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="rememberme" name="remember">
                                <label class="form-check-label" for="rememberme">Ghi nhớ</label>
                            </div>

                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Đăng Nhập</button>
                            </div>

                            <p class="mt-5 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a href="{{route('register')}}">Đăng Ký</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('CMS.includes.scripts')

</body>

</html>
