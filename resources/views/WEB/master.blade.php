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
    @stack('scripts')
</body>
</html>
