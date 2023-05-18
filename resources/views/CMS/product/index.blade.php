@extends('CMS.master')
@section('content')
    <style type="text/css">
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }
    </style>

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">Danh sách sản phẩm</h3>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead style="background-color: #212B36">
                                <tr>
                                    <th scope="col" class="text-white text-center" width="50px">#</th>
                                    <th scope="col" class="text-white" style="width: 150px">Tên sản phẩm</th>
                                    <th scope="col" class="text-white text-center">Mã SP</th>
                                    <th scope="col" class="text-white text-center">Hình ảnh</th>
                                    <th scope="col" class="text-white text-center" style="width: 180px">Giá thường (VNĐ)</th>
                                    <th scope="col" class="text-white text-center" style="width: 150px">Giá KM (VNĐ)</th>
                                    <th scope="col" class="text-white text-center" style="width: 120px">Danh mục</th>
                                    <th scope="col" class="text-white text-center" style="width: 105px">Trạng thái</th>
                                    <th scope="col" class="text-white text-center">Quản lý</th>
                                </tr>
                            </thead>
                            @if(count($products)>0)
                                <tbody class="text-dark">
                                @foreach($products as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>{{$item->ten}}</td>
                                        <td class="text-center">{{$item->masp}}</td>
                                        <td><img src="{{asset($item->hinhanh)}}" height="150px"></td>
                                        <td class="text-center">{{number_format($item->giathuong,0,',','.')}}</td>
                                        <td class="text-center">{{number_format($item->giakm,0,',','.')}}</td>
                                        <td>{{$item->category->ten}}</td>

                                        <td class="text-center">
                                            <select name="status" data-id="{{$item->id}}" style="background-color: transparent; border: none; outline: none">
                                                <option value="1" @if($item->status == 1) selected @endif>Hiển thị</option>
                                                <option value="0" @if($item->status == 0) selected @endif>Ẩn</option>
                                            </select>
                                        </td>

                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-product" data-bs-toggle="modal" data-bs-target="#EditProduct" data-product-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-product" data-product-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                <tr class="text-center">
                                    <td colspan="8">Không có sản phẩm nào</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $products->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditProduct" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="contentProduct">
                {{--                @include('CMS.product.modal-edit')--}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            $('.btn-delete-product').click(function() {
                let productId = $(this).attr('data-product-id')
                if(productId !== undefined) {
                    Swal.fire({
                        text: 'Bạn chắn chắn muốn xoá ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('{{route('admin.product.delete')}}', {product_id: productId}, function (res) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2500,
                                    toast: true,
                                    didClose: () => {
                                        location.reload(true)
                                    }
                                })

                            })
                        }

                    })

                }
            })

            $('.btn-edit-product').click(function(){
                var productId = $(this).attr('data-product-id')
                if(productId !== undefined) {
                    $.get('{{route('admin.product.edit')}}', {product_id: productId}, function(res) {
                        $('#contentProduct').html(res)
                        $('#EditProduct').modal('show')
                    })
                }
            })

            $('select[name="status"]').change(function() {
                let product_id = $(this).attr('data-id')
                let status = $(this).val()
                let data = { id: product_id, status: status}

                $.post('{{route('admin.product.status')}}', data, function(res) {
                    if(res.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 4000,
                            toast: true,
                        });
                    }
                })
            })

        })
    </script>
@endpush
