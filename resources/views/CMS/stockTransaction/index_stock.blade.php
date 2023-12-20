@extends('CMS.master')
@section('content')
    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4">
                    <h3 class="mb-0 fw-bold">{{$title}}</h3>
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
                                <th class="text-white">Tên sản phẩm</th>
                                <th class="text-white">Tên nhà cung cấp</th>
                                <th class="text-white">Người thực hiện</th>
                                <th class="text-white text-center">Số lượng</th>
                                <th class="text-white">Ngày {{$title_stock}}</th>
                                <th class="text-white text-center">Quản lý</th>
                            </tr>
                            </thead>
                            @if(count($stocks)>0)
                                <tbody class="text-dark">
                                @foreach($stocks as $i=>$item)
                                    <tr>
                                        <td scope="row" class="text-center">{{$i+1}}</td>
                                        <td>{{$item->product->ten}}</td>
                                        <td>{{$item->supplier->name}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{date('d/m/Y H:i:s',strtotime($item->created_at))}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm btn-delete-stock" data-stock-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Không có phiếu {{$title_stock}} nào</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $stocks->links('vendor/pagination/bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
