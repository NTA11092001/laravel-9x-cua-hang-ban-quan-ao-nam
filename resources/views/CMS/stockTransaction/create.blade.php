@extends('CMS.master')
@section('content')

    <div class="container-fluid p-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="border-bottom pb-4 mb-4 d-flex flex-row justify-content-between align-content-center">
                    <div>
                        <h3 class="mb-0 fw-bold">{{ucfirst($title_stock)}}</h3>
                    </div>
                    <a class="btn btn-dark btn-block" href="{{route('admin.stockTransaction.product',$type)}}">
                        <i class="fa fa-arrow-alt-circle-left"></i> Quay lại
                    </a>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.stockTransaction.store')}}" autocomplete="off" method="POST">
                                @csrf
                                @method('post')
                                @if($type == 'in')
                                    <div class="mb-3">
                                        <label class="form-label">Tên nhà cung cấp</label>
                                        <select class="form-control form-select" name="supplier_id">
                                            @if(count($suppliers) > 0)
                                                <option value="">--Chọn nhà cung cấp--</option>
                                                @foreach($suppliers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @else
                                                <option value="">--Không có nhà cung cấp nào--</option>
                                            @endif
                                        </select>
                                    </div>
                                    @include('CMS.stockTransaction.form_create_stock_in',['product'=>$data_array])
                                @else
                                    @include('CMS.stockTransaction.form_create_stock_out',['cart'=>$data_array])
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
