<!DOCTYPE html>
<html lang="en">
<head>
    @include('WEB.includes.head')
    @stack('head')
    <title>BAL shop</title>
</head>
<body>
    
    @yield('content')

    @include('WEB.includes.scripts')
    @stack('scripts')
</body>
</html>