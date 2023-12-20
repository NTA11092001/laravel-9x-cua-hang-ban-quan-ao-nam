@extends('CMS.master')
@section('content')
    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-content-center">
                    <h3 class="mb-0 fw-bold">Danh sách nhà cung cấp</h3>
                    <button class="btn btn-dark btn-block" data-bs-toggle="modal" data-bs-target="#CreateSupplier">
                        <i class="fas fa-plus-circle"></i> Thêm nhà cung cấp
                    </button>
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
                                <th class="text-white">Tên nhà cung cấp</th>
                                <th class="text-white">Người liên hệ</th>
                                <th class="text-white">Số điện thoại</th>
                                <th class="text-white text-center">Quản lý</th>
                            </tr>
                            </thead>
                            @if(count($suppliers)>0)
                                <tbody class="text-dark">
                                @foreach($suppliers as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->contact_person}}</td>
                                        <td>{{$item->contact_number}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm btn-edit-supplier" data-bs-toggle="modal" data-bs-target="#EditSupplier" data-supplier-id="{{$item->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-supplier" data-supplier-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                <tr class="text-center">
                                    <td colspan="8">Không có nhà cung cấp nào</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $suppliers->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CreateSupplier" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @include('CMS.supplier.create_modal')
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditSupplier" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="contentSupplier">
                {{--                @include('CMS.category.modal-edit')--}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        $('.btn-delete-supplier').click(function() {
            let supplierId = $(this).attr('data-supplier-id')
            if(supplierId !== undefined) {
                Swal.fire({
                    text: 'Bạn chắn chắn muốn xoá ?',
                    showDenyButton: true,
                    // showCancelButton: true,
                    confirmButtonColor: '#212B36',
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: 'Huỷ bỏ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('{{route('admin.supplier.delete')}}', {supplier_id: supplierId}, function (res) {
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

        $('.btn-edit-supplier').click(function(){
            var supplierId = $(this).attr('data-supplier-id')
            if(supplierId !== undefined) {
                $.get('{{route('admin.supplier.edit')}}', {supplier_id: supplierId}, function(res) {
                    $('#contentSupplier').html(res)
                    $('#EditSupplier').modal('show')
                })
            }
        })

        $('#btnCreateSupplier').on('click', function () {
            var data = new FormData($('#createSupplier')[0]);

            $.ajax({
                method:"POST",
                type: "POST",
                url: '{{route('admin.supplier.store')}}',
                data: data,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        text: res.message,
                        showConfirmButton: false,
                        toast: false,
                        timer: 5000,
                        didClose: () => {
                            location.reload(true)
                        }
                    })
                },
                fail: function (res) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        html: res.message,
                        showConfirmButton: false,
                        toast: false,
                        timer: 5000,
                    })
                }

            }).fail(function (res) {
                var errTxt = '<div class="bg-danger d-flex justify-content-center align-content-center"><ul class="text-start text-white pt-2">';

                if(res.responseJSON.errors !== undefined) {
                    Object.keys(res.responseJSON.errors).forEach(key => {
                        errTxt += '<li class="py-1">'+res.responseJSON.errors[key][0]+'</li>';
                    });
                }
                errTxt += '</ul></div>';

                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    html: errTxt,
                    showConfirmButton: false,
                    toast: false,
                    timer: 3500
                })
            })

        })
    </script>
@endpush
