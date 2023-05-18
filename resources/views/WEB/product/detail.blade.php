@extends('WEB.master')
@section('content')
    @include('WEB.includes.banner')
<div class="container" id="product-section" style="margin-bottom: 60px">
    <h1 style="margin-bottom: 50px">{{$product->ten}} {{$product->masp}}</h1>
    <form method="POST" action="{{route('WEB.cart.store')}}">
        @csrf
        @method('post')
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                <div class="col-8">
                    <!-- Carousel wrapper -->
                    <div id="detailProduct" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <!-- Slides -->
                        <div class="carousel-inner mb-5">
                            <div class="carousel-item active">
                                <img src="{{asset($product->hinhanh)}}" class="d-block w-100" alt="..." />
                            </div>
                            @if($product!=null)
                                @foreach($images = explode(',',$product->images) as $item)
                                    <div class="carousel-item">
                                        <img src="{{asset($item)}}" class="d-block w-100" alt="..." />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- Slides -->

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#detailProduct" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#detailProduct"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <!-- Controls -->

                        <!-- Thumbnails -->
                        <div class="carousel-indicators" style="margin-bottom: -20px;">
                            <button type="button" data-bs-target="#detailProduct" data-bs-slide-to="0" class="active"
                                    aria-current="true" aria-label="Slide 1" style="width: 100px;">
                                <img class="d-block w-100"
                                     src="{{asset($product->hinhanh)}}" class="img-fluid" />
                            </button>
                            @if($product!=null)
                                @foreach($images = explode(',',$product->images) as $i=>$item)
                                    <button type="button" data-bs-target="#detailProduct" data-bs-slide-to="{{$i+1}}"
                                            aria-label="Slide {{$i+2}}" style="width: 100px;">
                                        <img class="d-block w-100"
                                             src="{{asset($item)}}" class="img-fluid" />
                                    </button>
                                @endforeach
                            @endif

                        </div>
                        <!-- Thumbnails -->
                    </div>
                    <!-- Carousel wrapper -->
                </div>
            </div>
            <div class="col-md-6">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="product-price">Danh mục</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>{{$product->category->ten}}</h6>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="product-price">Số lượng</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-5">
                            <input type="number" name="quantity" value="1">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="product-price">Size</h6>
                    </div>
                    <div class="col-md-6">
                        <select class="bootstrap-select p-1 text-center" name="size" style="height: 34px;width: 127px">
                            <option value="">--Chọn size--</option>
                            @for($i=38;$i<=42;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-md-6">
                        <h6 class="product-price">Giá Thường</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 class="product-price-1" style="text-decoration: line-through">{{number_format($product->giathuong,0,',','.')}} VNĐ</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="product-price">Giá Khuyến Mãi</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 class="product-price-1" style="color:red">{{number_format($product->giakm,0,',','.')}} VNĐ</h6>
                    </div>
                </div>
                <div class="wrapper1">

                    <div class="tab-wrapper">
                        <ul class="tabs">
                            <li class="tab-link active" data-tab="1"> Chi tiết sản phẩm</li>
                            <li class="tab-link" data-tab="2"> Giao trả hàng</li>
                        </ul>
                    </div>

                    <div class="content-wrapper">

                        <div id="tab-1" class="tab-content active" style="text-align:justify">
                            {!! $product->chitiet !!}
                        </div>

                        <div id="tab-2" class="tab-content " style="text-align:justify">
                            🛒 Đơn hàng có hóa đơn thanh toán nguyên giá từ 500k hoặc đơn hàng đã thanh toán bằng hình thức chuyển khoản, qua ví điện tử online: áp dụng freeship (phí ship 0 đồng)<br>

                            🛒 Đơn hàng có hóa đơn thanh toán từ 500k trở lên và có chứa sản phẩm giảm giá: áp dụng phí ship 20.000đ<br>

                            🛒 Đơn hàng có hóa đơn thanh toán dưới 500k: Áp dụng thu phí ship 30.000đ<br>

                            🛒 Đơn hàng nội thành Hà Nội cần ship nhanh trong 6h: áp dụng thu phí ship 40.000đ<br>

                            🛒 Toàn bộ đơn hàng online đều không áp dụng đồng kiểm (xem hàng trước khi nhận)<br>

                            🛒 Khách hàng thanh toán, nhận hàng đều được áp dụng chính sách đổi trả theo quy định đổi trả của công ty.<br>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <button class="btn btn-outline-dark" id="themgiohang" type="submit">Thêm Vào Giỏ Hàng <i class="fas fa-shopping-cart"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container-fluid style" style="margin-top: 80px">
    <h2 class="text-center">SẢN PHẨM TƯƠNG TỰ</h2>
    <div class="container">
        <div class="row clearfix slider">
            @if(count($similar)>0)
                @foreach($similar as $item)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="card product_item">
                            <div class="body">
                                <form method="POST" action="{{route('WEB.cart.store')}}">
                                    @csrf
                                    @method('post')
                                    <input name="id" type="hidden" value="{{$item->id}}">
                                    <div class="cp_img">
                                        <a href="{{route('WEB.product.detail',['id'=>$item->id])}}"><img src="{{asset($item->hinhanh)}}" alt="Product" class="img-fluid"></a>
                                        <div class="hover">
                                            <a class="btn btn-outline-dark btn-sm waves-effect me-2" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><i class="fas fa-search-plus"></i></button></a>
                                            <button type="submit" class="btn btn-outline-dark btn-sm waves-effect me-2" ><i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                    <div class="product_details">
                                        <a class="link-offset-2 link-underline link-underline-opacity-0 text-dark" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><h5>{{$item->ten}} {{$item->masp}}</h5></a>
                                        <ul class="product_price list-unstyled">
                                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-dark" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><li class="old_price" style="text-decoration: line-through">{{number_format($item->giathuong,0,',','.')}} VNĐ</li></a>
                                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-danger" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><li class="new_price">{{number_format($item->giakm,0,',','.')}} VNĐ</li></a>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-3 col-md-4 col-sm-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            Dữ liệu đang được cập nhật
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('input[type="number"]').inputSpinner()
        })
    </script>
@endpush
