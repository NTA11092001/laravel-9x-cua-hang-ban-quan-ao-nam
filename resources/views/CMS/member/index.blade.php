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
                    <h3 class="mb-0 fw-bold">Danh sách tài khoản khách hàng</h3>
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
                                <th class="text-white text-center">Quản Lý</th>
                            </tr>
                            </thead>
                            @if(count($member)>0)
                                <tbody class="text-dark">
                                @foreach($member as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-danger btn-sm btn-delete-user" data-user-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Không có tài khoản khách hàng nào</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $member->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
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
                                        location.reload(true)
                                    }
                                })

                            })
                        }

                    })

                }
            })

        })
    </script>
@endpush

