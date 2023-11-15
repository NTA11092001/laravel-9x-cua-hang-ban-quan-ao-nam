<header class="w-100 h-auto">
    <nav class="navmenu js-navmenu">
        <a href="{{route('WEB.home.index')}}"><img src="{{asset('img/BAL-logo.png')}}" alt="" class="navmenu-logo"></a>
        <div class="navmenu-list">
            <div class="navmenu-items">
                <a href="{{route('WEB.home.index')}}" class="navmenu-items-link">Trang chủ</a>
            </div>
            <div class="navmenu-items-dad">
                <a class="navmenu-items-link">
                    Danh Mục
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="navmenu-items-chill">
                    @foreach($category as $item)
                        <li class="navmenu-item">
                            <a href="{{route('WEB.product.category',['id'=>$item->id])}}" class="navmenu-item-link">{{$item->ten}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="navmenu-items">
                <a href="{{route('WEB.contact.index')}}" class="navmenu-items-link">Liên Hệ</a>
            </div>
        </div>
        <button class="navmenu-icon-search js-button-search">
            <i class="fas fa-search"></i>
        </button>
        <div class="navmenu-search js-search">
            <input type="text" id="keyWord" placeholder="Tìm kiếm">
            <button class="navmenu-search-icon" id="btnSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="navmenu-icon">
            <ul class="navmenu-icon-list">
                @if(auth('member')->user() != null)
                <li class="navmenu-icon-item">
                    <a href="{{route('logoutWeb')}}" class="navmenu-icon-link">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                <li class="navmenu-icon-item">
                    <a href="{{route('WEB.account')}}" class="navmenu-icon-link">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
                @else
                <li class="navmenu-icon-item" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <a class="navmenu-icon-link">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </li>
                <li class="navmenu-icon-item" data-bs-toggle="modal" data-bs-target="#registerModal">
                    <a class="navmenu-icon-link">
                        <i class="fas fa-user-plus"></i>
                    </a>
                </li>
                @endif
                <li class="navmenu-icon-item">
                    <a href="{{route('WEB.cart.list')}}" class="navmenu-icon-link">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
