<!-- Modal -->
<div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;text-align:center">ĐỔI MẬT KHẨU</h4>
                    <div class="text-center">
                        <img src="{{asset('img/BAL-logo.png')}}" alt="BAL-logo" class="img-fluid rounded-circle" width="132" height="132" />
                    </div>
                </div>
                <form action="" autocomplete="off" method="post" id="changePassForm">
                    <!-- row -->
                    <div class="mb-3">
                        <label for="currentPassword" class="col-sm-4 col-form-label form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control" name="current" placeholder="Nhập mật khẩu hiện tại" id="currentPassword">
                    </div>
                    <!-- row -->
                    <div class="mb-3">
                        <label for="currentNewPassword" class="col-sm-4 col-form-label form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="new" placeholder="Nhập mật khẩu mới" id="currentNewPassword">
                    </div>
                    <!-- row -->
                    <div class="mb-3">
                        <label for="confirmNewpassword" class="col-sm-4 col-form-label form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" name="confirm_new" placeholder="Xác nhận mật khẩu mới" id="confirmNewpassword">
                        <!-- list -->
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-dark btn-change-pass">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

