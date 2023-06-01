@extends('WEB.master')
@section('content')
    @php $category = category() @endphp
    @include('WEB.includes.banner')
    <div class="container-fluid" style="margin-bottom:10px">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('img/sidebanner1.png')}}" class="img-fluid js-sidebanner1" style="cursor: pointer;float:right">
            </div>
            <div class="col-md-6">
                <img src="{{asset('img/sidebanner2.png')}}" class="img-fluid js-sidebanner2" style="cursor: pointer;">
            </div>
        </div>
    </div>

    <div class="sidebanner js-showbanner1">
        <div class="container-sidebanner">
            <i class="far fa-window-close container-sidebanner-close js-close-sidebanner1"></i>
            <img src="{{asset('img/ADV-2.png')}}" class="container-sidebanner1-img">
        </div>
    </div>
    </div>

    <div class="sidebanner js-showbanner2">
        <div class="container-sidebanner">
            <i class="far fa-window-close container-sidebanner-close js-close-sidebanner2"></i>
            <img src="{{asset('img/ADV-2.png')}}" class="container-sidebanner1-img">
        </div>
    </div>
    </div>

    <div class="container-fluid style">
        @foreach($category as $cate)
        <a href="#"><h1>{{$cate->ten}}</h1></a>
        <div class="container">
            <div class="row clearfix slider">
                @if(count($cate->product)>0)
                    @foreach($cate->product as $item)
                        @if($item->status == 1)
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
                                                        <a class="link-offset-2 link-underline link-underline-opacity-0 text-dark" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><li class="old_price" @if($item->giakm != null) style="text-decoration: line-through" @endif>{{number_format($item->giathuong,0,',','.')}} VNĐ</li></a>
                                                        @if($item->giakm != null) <a class="link-offset-2 link-underline link-underline-opacity-0 text-danger" href="{{route('WEB.product.detail',['id'=>$item->id])}}"><li class="new_price">{{number_format($item->giakm,0,',','.')}} VNĐ</li></a> @endif
                                                    </ul>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
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
        @endforeach
    </div>
@endsection


