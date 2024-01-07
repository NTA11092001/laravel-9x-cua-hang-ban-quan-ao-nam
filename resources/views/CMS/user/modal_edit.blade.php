<div class="modal-header">
    <h3 class="modal-title">Sửa thông tin tài khoản</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body m-3">
    <form action="{{route('admin.user.updateModal')}}" autocomplete="off" method="POST" id="registerForm">
        @csrf
        @method('post')
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập Tên" value="{{$user->name}}"/>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập số điện thoại" value="{{$user->phone}}"/>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="register_email">Email</label>
                    <input type="email" name="email" id="register_email" class="form-control form-control-lg" autocomplete="off" placeholder="Nhập email" value="{{$user->email}}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chức vụ</label>
                    <select class="form-control form-select form-select-lg" name="level">
                        <option value="1" @if($user->level == 1) selected @endif>Quản lý</option>
                        <option value="2" @if($user->level == 2) selected @endif>Nhân viên</option>
                    </select>
                </div>
            </div>

            <div>
                <!-- Button -->
                <div>
                    <button class="btn btn-dark" type="button" id="btn_register_account">Sửa tài khoản</button>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    $(function () {

        $('#btn_register_account').click( function () {

            var data = new FormData($('#registerForm')[0]);

            $.ajax({
                method:"POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('admin.user.updateModal')}}',
                data: data,
                processData: false,
                contentType: false,
                success: function (res) {
                    $('#EditMember').modal('hide')
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        text: res.message,
                        showConfirmButton: false,
                        toast: false,
                        timer: 3500,
                        didClose: () => {
                            location.reload(true)
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
