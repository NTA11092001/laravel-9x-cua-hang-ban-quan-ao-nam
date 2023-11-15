<!DOCTYPE html>
<html lang="en">
<head>
    @include('WEB.includes.head')
    @stack('head')
</head>
<body>
    @php $category = category() @endphp
    @include('WEB.includes.header',['category'=>$category])

    @yield('content')

    @include('WEB.auth.login')
    @include('WEB.auth.register')

    @include('WEB.includes.footer')

    @include('WEB.includes.scripts')
    @include('Validation.alert')
    <script>
        $('#btnSearch').click(function() {
            var tukhoa = $('#keyWord').val()
            if (tukhoa != ''){
                 window.location.replace('https://' + window.location.hostname + '/tim-kiem/' + tukhoa)
            } else {
                SwalText('top-start','info','Bạn cần nhập từ khóa tìm kiếm!')
            }
        })
    </script>
    @stack('scripts')
</body>
</html>
