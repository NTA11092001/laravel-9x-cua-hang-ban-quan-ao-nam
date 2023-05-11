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

                <table class="table table-bordered table-hover">
                    <thead style="background-color: #212B36">
                    <tr>
                        <th width="50px" class="text-white text-center">STT</th>
                        <th class="text-white">Tên Danh Mục</th>
                        <th class="text-white">Quản Lý</th>
                    </tr>
                    </thead>
                    @if(count($category)>0)
                        <tbody class="text-dark">
                        @foreach($category as $i=>$item)
                            <tr>
                                <td scope="row" class="text-center">{{$item->thutu}}</td>
                                <td>{{$item->ten}}</td>
                                <td>
                                    <a class="btn btn-sm" style="color: black" data-bs-toggle="modal" data-bs-target="#EditCategory"><i class="fas fa-edit"></i></a> |
                                    <a class="btn btn-sm" style="color: red" ><i class="fas fa-trash-alt"></i></a>
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
                    {!! $category->links('pagination.custom') !!}
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="EditCategory" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user
                        notifications, or completely custom content.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
