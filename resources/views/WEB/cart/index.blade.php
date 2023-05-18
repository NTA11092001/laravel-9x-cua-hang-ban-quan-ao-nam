@extends('WEB.master')
@section('content')

    <div class="d-flex justify-content-center" style="margin-left: 30%;">
        <!-- thanh quá trình thanh toán -->
        <div class="container">
            <!-- Responsive Arrow Progress Bar -->
            <div class="arrow-steps clearfix">
                <div class="step current"> <span> <a href="{{route('WEB.cart.list')}}" >Giỏ hàng</a></span> </div>
                @if(auth('member')->user() != null)
                <div class="step"> <span><a href="#" >Thông tin giao hàng</a></span> </div>
                <div class="step"> <span><a href="#" >Thanh toán</a><span> </div>
                @else
                <div class="step" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#registerModal"> <span>Thông tin giao hàng</span> </div>
                <div class="step" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#registerModal"> <span>Thanh toán<span> </div>
                @endif
            </div>
            <!-- end Responsive Arrow Progress Bar -->
        </div>
    </div>
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="container-fluid d-flex justify-content-center">
            <div class="w-25 alert alert-success p-2 mt-3 rounded text-center">
                <p class="text-success">{{ $message }}</p>
            </div>
        </div>
    @endif

    <!-- giỏ hàng -->
    <div class="row" style="margin-top:20px">
        <h4 style="text-align: center;"><i class="fas fa-shopping-cart"></i> Giỏ hàng</h4>
        <div style="width: 78%">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width: 12%">Sản phẩm</th>
                    <th style="width: 15%">Thông tin</th>
                    <th style="width: 10%">Giá bán</th>
                    <th style="width: 10%" class="text-center">Số lượng</th>
                    <th style="width: 5%" class="text-center">Size</th>
                    <th style="width: 10%">Thành tiền</th>
                    <th colspan="2" @if(count($cart)>0) style="width: 1%" @else style="width: 5%" @endif class="text-center">Quản Lý</th>
                </tr>
                </thead>
                <tbody>
                @if(count($cart)>0)
                    @foreach($cart as $item)
                        <tr>
                            <td>
                                <div class="img">
                                    <img src="{{asset($item->attributes['image'])}}" class="img-responsive" style="width:100%">
                                    <input type="hidden" name="image" value="{{$item->attributes['image']}}">
                                </div>
                            </td>
                            <td>
                                <div class="info">
                                    <h5 class="nomargin">{{$item->name}}</h5>
                                    <p>
                                        <label>Mã SP</label>: <span></span>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="price">

                                    <span style="color:red">{{number_format($item->price,0,',','.')}} VNĐ</span>

                                </div>

                            </td>
                            <td>
                                <input name="quantity" type="number" value="{{$item->quantity}}">
                            </td>
                            <td class="text-center">
                                <select class="bootstrap-select p-1 text-center" name="size">
                                    @for($i=38;$i<=42;$i++)
                                        <option value="{{$i}}" @if($item->attributes['size'] == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <span style="color: red">{{number_format($item->price*$item->quantity,0,',','.')}} VNĐ</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-dark text-center btn-update-cart" data-id="{{$item->id}}"><i class="fa fa-save"></i></button>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{route('WEB.cart.remove')}}">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="8">
                            <img src="{{asset('CMS/fonts/feather-icons/icons/feather_shopping-cart.svg')}}" alt="feather_shopping-cart">
                            <p>Giỏ hàng của bạn chưa có sản phẩm.</p>
                            <a class="link-offset-2 text-decoration-none link-underline link-underline-opacity-0" href="{{route('WEB.home.index')}}">Chọn sản phẩm ngay</a>
                        </td>
                    </tr>
                @endif
                </tbody>

            </table>
        </div>
        <div style="width: 22%">
            <div class="row d-flex">
                <div class="col-5">
                    <h5>Tổng Tiền:</h5>
                </div>
                <div class="col-7">
                    <h5 style="color:red">{{ number_format(Cart::getTotal(),0,',','.') }} VNĐ</h5>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <form method="POST" action="{{route('WEB.cart.clear')}}">
                    @csrf
                    @method('post')
                    <button type="submit" style="width:260px" class="btn btn-outline-danger">Xoá tất cả giỏ hàng</button>
                </form>
            </div>
            <div class="row" style="margin-top:20px">
                <a class="text-decoration-none" href="{{route('WEB.home.index')}}"><button style="width:260px" class="btn btn-outline-dark">Quay trở lại trang chủ</button></a>
            </div>
            <div class="row" style="margin-top:20px">
                @if(auth('member')->user() != null)
                    <a class="text-decoration-none" href="#"><button style="width:260px" class="btn btn-outline-dark">Thông tin giao hàng</button></a>
                @else
                    <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#registerModal"><button style="width:260px" class="btn btn-outline-dark">Đăng ký đặt hàng</button></a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid style">
    <h1 style="margin-top:50px">GỢI Ý SẢN PHẨM KHUYẾN MÃI</h1>
    <div class="container">
        <div class="row clearfix slider">
            @if(count($promotion)>0)
                @foreach($promotion as $item)
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
            $('.btn-update-cart').click(function () {
                let id = $(this).attr('data-id')
                let quantity = $('input[name="quantity"]').val()
                let size = $('input[name="size"]').val()
                let image = $('input[name="image"]').val()
                var data = {id: id,quantity: quantity,size: size,image: image}
                $.post('{{route('WEB.cart.update')}}',data,function (res) {
                    if(res.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 2500,
                            toast: true,
                            didClose: () => {
                                location.reload()
                            }
                        });
                    }
                })
            })
        })
    </script>
@endpush
