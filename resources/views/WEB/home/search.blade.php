@extends('WEB.master')
@section('content')
    @include('WEB.includes.banner')
    <div class="container" id="product-section">
        <h1>Bạn đang tìm kiếm theo từ khóa : {{Request::get('tukhoa')}}</h1>
        <div class="container-fluid style">
            <div class="container">
                <div class="row clearfix">
                    @if(count($product)>0)
                        @foreach($product as $item)
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
                        <div class="col-12 text-center">
                            <div class="card">
                                <div class="card-body">
                                    Không có kết quả tìm kiếm nào
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-end">
                {!! $product->links('vendor/pagination/bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
