<!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG NHẬP</h4>
                    <div class="text-center">
                        <img src="{{asset('img/BAL-logo.png')}}" alt="BAL-logo" class="img-fluid rounded-circle" width="132" height="132" />
                    </div>
                </div>
                <form action="" autocomplete="off" method="POST" id="loginForm">
                @csrf
                @method('post')
                <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Tài khoản (Số điện thoại hoặc email)</label>
                        <input class="form-control" type="text" name="username" placeholder="Nhập tài khoản" id="username"/>
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" id="password"/>
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
                            <button type="button" class="btn btn-dark" id="loginBtn">Đăng Nhập</button>
                        </div>

                        <p class="mt-5 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a class="register-modal" href="#">Đăng Ký</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
