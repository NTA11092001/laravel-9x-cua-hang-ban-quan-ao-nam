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
@if(session('notice_success'))
    <div class="alert alert-danger">
        <p class="text-center text-danger">{{session('notice_success')}}</p>
    </div>
@endif
    <a href="{{route('logoutPost')}}" class="btn btn-success">Đăng xuất</a>
</body>
</html>
