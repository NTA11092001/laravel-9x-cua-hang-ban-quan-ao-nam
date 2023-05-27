<!DOCTYPE html>
<html lang="en">

<head>
    @include('CMS.includes.head')
</head>

<body class="bg-light">

<div id="db-wrapper">
    <!-- navbar vertical -->
    <!-- Sidebar -->
    @include('CMS.includes.left_menu')
    <!-- Page content -->
    <div id="page-content">
        @include('CMS.includes.top_menu')
        <!-- Container fluid -->
        @yield('content')
    </div>
</div>
@include('CMS.includes.scripts')
@include('Validation.error')
@stack('scripts')
</body>

</html>
