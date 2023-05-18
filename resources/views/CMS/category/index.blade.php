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
                    <h3 class="mb-0 fw-bold">Danh sách danh mục sản phẩm</h3>
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
                                <th width="50px" class="text-white text-center">#</th>
                                <th class="text-white">Tên Danh Mục</th>
                                <th class="text-white text-center">Trạng thái</th>
                                <th class="text-white text-center">Quản Lý</th>
                            </tr>
                            </thead>
                            @if(count($category)>0)
                                <tbody class="text-dark">
                                @foreach($category as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$item->thutu}}</td>
                                        <td>{{$item->ten}}</td>
                                        <td class="text-center">
                                            <select name="status" data-category-id="{{$item->id}}" style="background-color: transparent; border: none; outline: none">
                                                <option value="1" @if($item->status == 1) selected @endif>Hiển thị</option>
                                                <option value="0" @if($item->status == 0) selected @endif>Ẩn</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-category" data-bs-toggle="modal" data-bs-target="#EditCategory" data-category-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-category" data-category-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                <tr class="text-center">
                                    <td colspan="8">Không có danh mục sản phẩm nào</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $category->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditCategory" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="contentCategory">
{{--                @include('CMS.category.modal-edit')--}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            $('.btn-delete-category').click(function() {
                let categoryId = $(this).attr('data-category-id')
                if(categoryId !== undefined) {
                    Swal.fire({
                        text: 'Bạn chắn chắn muốn xoá ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('{{route('admin.category.delete')}}', {category_id: categoryId}, function (res) {
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

            $('.btn-edit-category').click(function(){
                var categoryId = $(this).attr('data-category-id')
                if(categoryId !== undefined) {
                    $.get('{{route('admin.category.edit')}}', {category_id: categoryId}, function(res) {
                        $('#contentCategory').html(res)
                        $('#EditCategory').modal('show')
                    })
                }
            })

            $('select[name="status"]').change(function() {
                let categoryId = $(this).attr('data-category-id')
                let status = $(this).val()
                let data = { id: categoryId, status: status}

                $.post('{{route('admin.category.status')}}', data, function(res) {
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
