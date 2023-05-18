<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/menu.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
<script src="{{asset('js/slick.js')}}"></script>
<script src="{{asset('js/ADV.js')}}"></script>
<script src="{{asset('js/JS.js')}}"></script>
<script src="{{asset('js/bootstrap-input-spinner.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(function () {
        $('.register-modal').click(function () {
            $('#loginModal').modal('hide')
            $('#registerModal').modal('show')
        })
        $('.login-modal').click(function () {
            $('#registerModal').modal('hide')
            $('#loginModal').modal('show')
        })

        $('#btn_register_account').click( function () {

            var data = new FormData($('#registerForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('registerWebPost')}}',
                data: data,
                processData: false,
                contentType: false,
                success: function (res) {
                    $('#registerModal').modal('hide')
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        text: res.message,
                        showConfirmButton: false,
                        toast: false,
                        timer: 4000,
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

        $('#loginBtn').click( function () {

            var data = new FormData($('#loginForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                type: "POST",
                encytype: 'multipart/form-data',
                url: '{{route('loginWebPost')}}',
                data: data,
                processData: false,
                contentType: false,
                success: function (res) {
                    if(res.success === true){
                        $('#loginModal').modal('hide')
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            toast: false,
                            timer: 4000,
                            didClose: () => {
                                location.reload()
                            }
                        })
                    }else if (res.success === false){
                        Swal.fire({
                            position: 'top-start',
                            icon: 'error',
                            text: res.message,
                            showConfirmButton: false,
                            toast: false,
                            timer: 4000,
                        })
                    }

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
