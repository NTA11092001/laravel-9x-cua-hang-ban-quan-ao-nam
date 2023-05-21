<div class="d-flex justify-content-center" style="margin-left: 30%;">
    <!-- thanh quá trình thanh toán -->
    <div class="container">
        <!-- Responsive Arrow Progress Bar -->
        <div class="arrow-steps clearfix">
            <div class="step {{request()->routeIs('WEB.cart.list') ? 'current' : ''}} {{request()->routeIs('WEB.payment') ? 'done' : ''}} {{request()->routeIs('WEB.payment.success') ? 'done' : ''}}"> <span> <a href="{{route('WEB.cart.list')}}" >Giỏ hàng</a></span> </div>
            @if(auth('member')->user() != null)
                <div class="step count-cart {{request()->routeIs('WEB.payment') ? 'current' : ''}} {{request()->routeIs('WEB.payment.success') ? 'done' : ''}}"> <span><a href="{{count($cart)>0 ? route('WEB.payment') : '#'}}" >Đặt hàng</a></span> </div>
                <div class="step count-cart check-submit {{request()->routeIs('WEB.payment.success') ? 'current' : ''}}"> <span><a href="{{$cart==null ? route('WEB.payment.success') : '#'}}" >Thành công</a><span> </div>
            @else
                <div class="step count-cart" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#registerModal"> <span>Đặt hàng</span> </div>
                <div class="step count-cart" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#registerModal"> <span>Thành công<span> </div>
            @endif
        </div>
        <!-- end Responsive Arrow Progress Bar -->
    </div>
</div>
