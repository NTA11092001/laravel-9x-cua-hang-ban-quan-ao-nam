<div class="card">
    <div class="card-body">
        <div class="container-fluid">

            <div class="text-left my-3">
                <h5 class="fw-bold text-uppercase mb-3">Thông tin tài khoản</h5>

                <p class="text-muted mb-2 font-13"><strong>Tên :</strong> <span class="ml-2">{{auth('member')->user()->name}}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Số điện thoại :</strong> <span class="ml-2">{{auth('member')->user()->phone}}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{auth('member')->user()->email}}</span></p>

                <p class="text-muted mb-1 font-13"><strong>Địa chỉ :</strong> <span class="ml-2">{{auth('member')->user()->address}}</span></p>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="d-flex flex-column gap-3">

                <a href="{{route('WEB.account')}}" class="btn {{request()->routeIs('WEB.account') ? 'btn-dark' : 'btn-outline-dark'}}">Thông tin tài khoản</a>

                <a href="{{route('WEB.history')}}" class="btn {{request()->routeIs('WEB.history') ? 'btn-dark' : 'btn-outline-dark'}}">Lịch sử đặt hàng</a>

            </div>
        </div>
    </div>
</div>
