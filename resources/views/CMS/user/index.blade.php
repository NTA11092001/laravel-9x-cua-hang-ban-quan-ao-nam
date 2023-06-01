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
                    <h3 class="mb-0 fw-bold">Danh sách tài khoản @if($status == 1) đã duyệt @elseif($status == 0) chưa duyệt @endif</h3>
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
                                <th class="text-white">Tên Tài khoản</th>
                                <th class="text-white">Số điện thoại</th>
                                <th class="text-white">Email</th>
                                <th class="text-white text-center">Chức vụ</th>
                                <th class="text-white text-center">Trạng thái</th>
                                <th class="text-white text-center">Quản Lý</th>
                            </tr>
                            </thead>
                            @if(count($user)>0)
                                <tbody class="text-dark">
                                @foreach($user as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td class="text-center">
                                            @if($item->level == 1)
                                                <div class="alert alert-success">Quản lý</div>
                                            @elseif($item->level == 2)
                                                <div class="alert alert-primary">Nhân viên</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($status == 1)
                                                <a class="btn btn-dark btn-sm btn-unapproved-user" data-user-id="{{$item->id}}"><i class="fa-solid fa-xmark"></i></a>
                                            @elseif($status == 0)
                                                <a class="btn btn-success btn-sm btn-approved-user" data-user-id="{{$item->id}}"><i class="fa-solid fa-check"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-user" data-bs-toggle="modal" data-bs-target="#EditMember" data-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-user" data-user-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                <tr class="text-center">
                                    <td colspan="8">Không có tài khoản @if($status == 1) đã duyệt @elseif($status == 0) chưa duyệt @endif nào</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $user->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditMember" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="contentMember">
                {{--                @include('CMS.member.modal_edit')--}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            $('.btn-delete-user').click(function() {
                let userId = $(this).attr('data-user-id')
                if(userId !== undefined) {
                    Swal.fire({
                        text: 'Bạn chắn chắn muốn xoá ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('{{route('admin.user.delete')}}', {user_id: userId}, function (res) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2500,
                                    toast: true,
                                    didClose: () => {
                                        location.reload()
                                    }
                                })

                            })
                        }

                    })

                }
            })

            @if($status == 1)
            $('.btn-unapproved-user').click(function() {
            @elseif($status == 0)
            $('.btn-approved-user').click(function() {
            @endif
                let userId = $(this).attr('data-user-id')
                if(userId !== undefined) {
                    Swal.fire({
                        text: 'Bạn chắn chắn muốn đổi trạng thái tài khoản ?',
                        showDenyButton: true,
                        // showCancelButton: true,
                        confirmButtonColor: '#212B36',
                        confirmButtonText: 'Xác nhận',
                        denyButtonText: 'Huỷ bỏ',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('{{route('admin.user.status')}}', {user_id: userId}, function (res) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: res.message,
                                    showConfirmButton: false,
                                    timer: 2500,
                                    toast: true,
                                    didClose: () => {
                                        @if($status == 1)
                                            window.location.replace("{{route('admin.user.index',['status'=>0])}}")
                                        @elseif($status == 0)
                                            window.location.replace("{{route('admin.user.index',['status'=>1])}}")
                                        @endif
                                    }
                                })

                            })
                        }

                    })

                }
            })

            $('.btn-edit-user').click(function(){
                var userId = $(this).attr('data-id')
                if(userId !== undefined) {
                    $.get('{{route('admin.user.editModal')}}', {user_id: userId}, function(res) {
                        $('#contentMember').html(res)
                        $('#EditMember').modal('show')
                    })
                }
            })

        })
    </script>
@endpush

