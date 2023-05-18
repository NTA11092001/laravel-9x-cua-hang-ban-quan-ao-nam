<!-- Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐĂNG KÝ</h4>
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
                        <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Nhập Tên"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Nhập số điện thoại"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="register_email">Email</label>
                        <input type="email" name="email" id="register_email" class="form-control" autocomplete="off" placeholder="Nhập email"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="register_password">Mật khẩu</label>
                        <input type="password" name="password" id="register_password" class="form-control" autocomplete="off" placeholder="Nhập mật khẩu"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" autocomplete="off" placeholder="Nhập địa chỉ"/>
                    </div>

                    <div>
                        <!-- Button -->
                        <div class="d-grid">
                            <button class="btn btn-dark" type="button" id="btn_register_account">Đăng Ký</button>
                        </div>

                        <p class="mt-5 pb-lg-2" style="color: #393f81;">Đã có tài khoản? <a class="login-modal" href="#">Đăng Nhập</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
