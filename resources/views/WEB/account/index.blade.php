@extends('WEB.master')
@section('content')
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-3">

                @include('WEB.account.menu_account')

            </div>

            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('WEB.member.update')}}" autocomplete="off" method="POST" id="editUserForm">
                            @csrf
                            @method('post')
                            <!-- row -->
                            <h5 class="fw-bold text-uppercase mb-3">Chỉnh sửa thông tin tài khoản</h5>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label form-label">Tên</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Nhập Tên" value="{{auth('member')->user()->name}}">
                                </div>
                            </div>

                            <!-- row -->
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label form-label">Số điện thoại</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Nhập số điện thoại" value="{{auth('member')->user()->phone}}">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label form-label">Email</label>
                                <div class="col-md-8 col-12">
                                    <input type="email" name="email" id="editUser_email" class="form-control" autocomplete="off" placeholder="Nhập email" value="{{auth('member')->user()->email}}">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label form-label">Địa chỉ</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" name="address" class="form-control" autocomplete="off" placeholder="Nhập địa chỉ" value="{{auth('member')->user()->address}}">
                                </div>
                            </div>
                            <!-- row -->
                            <div class="row align-items-center">
                                <div class="offset-md-4 col-md-8 mt-4">
                                    <button type="submit" class="btn btn-dark btn-edit-user">Sửa thông tin tài khoản</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{route('WEB.member.password')}}" autocomplete="off" method="post" id="changePassForm">
                            @csrf
                            @method('post')
                            <!-- row -->
                            <h5 class="fw-bold text-uppercase mb-3">Chỉnh sửa mật khẩu</h5>
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
                                    <button type="submit" class="btn btn-dark btn-change-pass">Đổi mật khẩu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
