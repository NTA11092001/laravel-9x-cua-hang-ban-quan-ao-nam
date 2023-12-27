<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{route('admin.home.index')}}" style="background-color: white">
            <img src="{{asset('img/BAL-logo.png')}}" alt="BAL-logo" class="img-fluid rounded-circle"/>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow {{ request()->routeIs('admin.home.index') ? 'active' : '' }}" href="{{route('admin.home.index')}}">
                    <i class="fa-solid fa-chart-simple nav-icon icon-xs me-2"></i>  Thống kê
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed {{ request()->routeIs('admin.category.index') || request()->routeIs('admin.category.create') ? 'active' : '' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
                    <i data-feather="align-justify" class="nav-icon icon-xs me-2">
                    </i> Danh mục sản phẩm
                </a>
                <div id="navAuthentication" class="collapse {{ request()->routeIs('admin.category.index') || request()->routeIs('admin.category.create') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.category.index') ? 'active' : '' }}" href="{{route('admin.category.index')}}">
                                <i data-feather="list" class="nav-icon icon-xs me-2"></i> Danh sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.category.create') ? 'active' : '' }}" href="{{route('admin.category.create')}}">
                                <i data-feather="plus-square" class="nav-icon icon-xs me-2"></i> Thêm danh mục
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed {{ request()->routeIs('admin.product.index') || request()->routeIs('admin.product.create') ? 'active' : '' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navProduct" aria-expanded="false" aria-controls="navProduct">
                    <i class="fa-solid fa-shirt nav-icon icon-xs me-2">
                    </i> Sản phẩm
                </a>
                <div id="navProduct" class="collapse {{ request()->routeIs('admin.product.index') || request()->routeIs('admin.product.create') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.product.index') ? 'active' : '' }}" href="{{route('admin.product.index')}}">
                                <i data-feather="list" class="nav-icon icon-xs me-2"></i> Danh sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.product.create') ? 'active' : '' }}" href="{{route('admin.product.create')}}">
                                <i data-feather="plus-square" class="nav-icon icon-xs me-2"></i> Thêm sản phẩm
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.cart.index') ? 'active' : '' }}" href="{{route('admin.cart.index')}}">
                    <i class="fa-solid fa-table-cells icon-xs me-2"></i> Danh sách đơn hàng
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.supplier.index') ? 'active' : '' }}" href="{{route('admin.supplier.index')}}">
                    <i class="fa-solid fa-industry icon-xs me-2"></i> Danh sách nhà cung cấp
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed {{ request()->routeIs('admin.stockTransaction.index') || request()->routeIs('admin.stockTransaction.create') || request()->routeIs('admin.stockTransaction.product') ? 'active' : '' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navStock" aria-expanded="false" aria-controls="navStock">
                    <i class="fa-solid fa-warehouse nav-icon icon-xs me-2">
                    </i> Quản lý kho
                </a>
                <div id="navStock" class="collapse {{ request()->routeIs('admin.stockTransaction.index') || request()->routeIs('admin.stockTransaction.create') || request()->routeIs('admin.stockTransaction.product') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/stock-transaction/in') ? 'active' : '' }}" href="{{route('admin.stockTransaction.index',['type'=>'in'])}}">
                                <i class="fa-solid fa-box icon-xs me-2"></i> Danh sách nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/stock-transaction/out') ? 'active' : '' }}" href="{{route('admin.stockTransaction.index',['type'=>'out'])}}">
                                <i class="fa-solid fa-box-open icon-xs me-2"></i> Danh sách xuất
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/stock-transaction/product/in') || request()->is('admin/stock-transaction/create/in') ? 'active' : '' }}" href="{{route('admin.stockTransaction.product',['type'=>'in'])}}">
                                <i class="fa-solid fa-plus icon-xs me-2"></i> Sản phẩm cần nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/stock-transaction/product/out') || request()->is('admin/stock-transaction/create/out') ? 'active' : '' }}" href="{{route('admin.stockTransaction.product',['type'=>'out'])}}">
                                <i class="fa-solid fa-minus icon-xs me-2"></i> Sản phẩm cần xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @if(auth()->user()->level == 1)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.member.index') ? 'active' : '' }}" href="{{route('admin.member.index')}}">
                    <i class="fa-solid fa-user-group icon-xs me-2"></i> Tài khoản khách hàng
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed {{ request()->is('admin/user/1') || request()->is('admin/user/0') || request()->is('admin/user/create') ? 'active' : '' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navUser" aria-expanded="false" aria-controls="navUser">
                    <i class="fa-solid fa-users nav-icon icon-xs me-2">
                    </i> Tài khoản quản trị
                </a>
                <div id="navUser" class="collapse {{ request()->is('admin/user/1') || request()->is('admin/user/0') || request()->is('admin/user/create') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/user/1') ? 'active' : '' }}" href="{{route('admin.user.index',['status'=>1])}}">
                                <i class="fa-solid fa-user-check icon-xs me-2"></i> Tài khoản đã duyệt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/user/0') ? 'active' : '' }}" href="{{route('admin.user.index',['status'=>0])}}">
                                <i class="fa-solid fa-user-xmark icon-xs me-2"></i> Tài khoản chưa duyệt
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/user/create') ? 'active' : '' }}" href="{{route('admin.user.create')}}">
                                <i data-feather="plus-square" class="nav-icon icon-xs me-2"></i> Thêm tài khoản quản trị
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link has-arrow {{ request()->routeIs('admin.user.edit') ? 'active' : '' }}" href="{{route('admin.user.edit')}}">
                    <i data-feather="user" class="nav-icon icon-xs me-2"></i>  Thông tin tài khoản
                </a>

            </li>

{{--            <!-- Nav item -->--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">--}}
{{--                    <i--}}
{{--                        data-feather="layers"--}}

{{--                        class="nav-icon icon-xs me-2">--}}
{{--                    </i> Pages--}}
{{--                </a>--}}

{{--                <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">--}}
{{--                    <ul class="nav flex-column">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link " href="./pages/profile.html">--}}
{{--                                Profile--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link has-arrow   "  href="./pages/settings.html" >--}}
{{--                                Settings--}}
{{--                            </a>--}}

{{--                        </li>--}}


{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link " href="./pages/billing.html">--}}
{{--                                Billing--}}
{{--                            </a>--}}
{{--                        </li>--}}




{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link " href="./pages/pricing.html">--}}
{{--                                Pricing--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link " href="./pages/404-error.html">--}}
{{--                                404 Error--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--            </li>--}}


{{--            <!-- Nav item -->--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="./pages/layout.html">--}}
{{--                    <i--}}
{{--                        data-feather="sidebar"--}}

{{--                        class="nav-icon icon-xs me-2"--}}
{{--                    >--}}
{{--                    </i--}}
{{--                    >--}}
{{--                    Layouts--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <!-- Nav item -->--}}
{{--            <li class="nav-item">--}}
{{--                <div class="navbar-heading">UI Components</div>--}}
{{--            </li>--}}

{{--            <!-- Nav item -->--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link has-arrow " href="./docs/accordions.html" >--}}
{{--                    <i data-feather="package" class="nav-icon icon-xs me-2" >--}}
{{--                    </i>  Components--}}
{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="nav-item">--}}
{{--                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel" aria-expanded="false" aria-controls="navMenuLevel">--}}
{{--                    <i--}}
{{--                        data-feather="corner-left-down"--}}

{{--                        class="nav-icon icon-xs me-2"--}}
{{--                    >--}}
{{--                    </i--}}
{{--                    > Menu Level--}}
{{--                </a>--}}
{{--                <div id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">--}}
{{--                    <ul class="nav flex-column">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">--}}
{{--                                Two Level--}}
{{--                            </a>--}}
{{--                            <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">--}}
{{--                                <ul class="nav flex-column">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link " href="#!">  NavItem 1</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link " href="#!">  NavItem 2</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link has-arrow  collapsed  " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThree" aria-expanded="false" aria-controls="navMenuLevelThree">--}}
{{--                                Three Level--}}
{{--                            </a>--}}
{{--                            <div id="navMenuLevelThree" class="collapse " data-bs-parent="#navMenuLevel">--}}
{{--                                <ul class="nav flex-column">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThreeOne" aria-expanded="false" aria-controls="navMenuLevelThreeOne">--}}
{{--                                            NavItem 1--}}
{{--                                        </a>--}}
{{--                                        <div id="navMenuLevelThreeOne" class="collapse collapse " data-bs-parent="#navMenuLevelThree">--}}
{{--                                            <ul class="nav flex-column">--}}
{{--                                                <li class="nav-item">--}}
{{--                                                    <a class="nav-link " href="#!">--}}
{{--                                                        NavChild Item 1--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link " href="#!">  Nav Item 2</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <!-- Nav item -->--}}
{{--            <li class="nav-item">--}}
{{--                <div class="navbar-heading">Documentation</div>--}}
{{--            </li>--}}

{{--            <!-- Nav item -->--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link has-arrow " href="./docs/index.html" >--}}
{{--                    <i data-feather="clipboard" class="nav-icon icon-xs me-2" >--}}
{{--                    </i>  Docs--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link has-arrow " href="./docs/changelog.html" >--}}
{{--                    <i data-feather="git-pull-request" class="nav-icon icon-xs me-2" >--}}
{{--                    </i>  Changelog--}}
{{--                </a>--}}
{{--            </li>--}}




        </ul>

    </div>
</nav>
