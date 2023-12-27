@extends('CMS.master')
@section('content')
<div class="container-fluid p-6">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 mb-4">
                <h3 class="mb-0 fw-bold">Thống kê</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-clipboard-list fa-6x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng mới</h6>
                        <h6>{{$data_total['total_new']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-box-open fa-6x text-primary"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đang chuẩn bị</h6>
                        <h6>{{$data_total['total_ready']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-truck fa-5x text-primary"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đang vận chuyển</h6>
                        <h6>{{$data_total['total_delivery']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-truck fa-5x text-primary"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đang giao</h6>
                        <h6>{{$data_total['total_shipping']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-circle-check fa-6x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đã hoàn thành</h6>
                        <h6>{{$data_total['total_complete']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-circle-xmark fa-6x text-danger"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đã hủy</h6>
                        <h6>{{$data_total['total_cancel']}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-square-check fa-6x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng đã thanh toán</h6>
                        <h6>{{$data_total['payment_success']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">

                    <i class="fa-solid fa-square-xmark fa-6x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Đơn hàng chưa thanh toán</h6>
                        <h6>{{$data_total['payment_fail']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-money-bill-wave fa-5x text-success"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6 class="mt-2">Tổng tiền đã thanh toán</h6>
                        <h6>{{number_format($data_total['total_payment_success'], 0, ',', '.')}} VND</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                    <i class="fa-solid fa-money-bill fa-5x text-warning"></i>
                    <div class="w-75 d-flex flex-column text-center dashboard-text">
                        <h6>Tổng tiền chưa thanh toán</h6>
                        <h6>{{number_format($data_total['total_payment_fail'],0, ',', '.')}} VND</h6>
                    </div>
                </div>
            </div>
        </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-12 p-6">
                    <div class="text-center"><h4>Thống kê trạng thái đơn hàng</h4></div>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'],
                                datasets: [
                                    {
                                        label: 'Đơn hàng mới',
                                        data: {{$data_12_month['order_new']}},
                                        borderWidth: 1,
                                        backgroundColor: '#F59E0B',
                                    },
                                    {
                                        label: 'Đơn hàng đang chuẩn bị',
                                        data: {{$data_12_month['order_ready']}},
                                        borderWidth: 1,
                                        backgroundColor: '#624BFF',
                                    },
                                    {
                                        label: 'Đơn hàng đang vận chuyển',
                                        data: {{$data_12_month['order_delivery']}},
                                        borderWidth: 1,
                                        backgroundColor: '#624BFF',
                                    },
                                    {
                                        label: 'Đơn hàng đang giao',
                                        data: {{$data_12_month['order_shipping']}},
                                        borderWidth: 1,
                                        backgroundColor: '#624BFF',
                                    },
                                    {
                                        label: 'Đơn hàng đã hoàn thành',
                                        data: {{$data_12_month['order_complete']}},
                                        borderWidth: 1,
                                        backgroundColor: '#198754',
                                    },
                                    {
                                        label: 'Đơn hàng đã hủy',
                                        data: {{$data_12_month['order_cancel']}},
                                        borderWidth: 1,
                                        backgroundColor: '#DC3545',
                                    },
                                    {
                                        label: 'Đơn hàng chưa thanh toán',
                                        data: {{$data_12_month['fail_pay']}},
                                        borderWidth: 1,
                                        backgroundColor: '#F59E0B'
                                    },
                                    {
                                        label: 'Đơn hàng đã thanh toán',
                                        data: {{$data_12_month['success_pay']}},
                                        borderWidth: 1,
                                        backgroundColor: '#198754'
                                    },
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                </div>

                <div class="col-12 p-10">
                    <div class="text-center"><h4>Thống kê doanh thu</h4></div>
                    <div>
                        <canvas id="Total"></canvas>
                    </div>

                    <script>
                        var total = document.getElementById('Total');

                        new Chart(total, {
                            type: 'line',
                            data: {
                                labels: ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'],
                                datasets: [

                                    {
                                        label: 'Số tiền chưa thanh toán',
                                        data: {{$data_12_month['total_fail_12_month']}},
                                        borderWidth: 1,
                                        backgroundColor: '#F59E0B',
                                        borderColor: '#F59E0B'
                                    },
                                    {
                                        label: 'Số tiền đã thanh toán',
                                        data: {{$data_12_month['total_success_12_month']}},
                                        borderWidth: 1,
                                        backgroundColor: '#198754',
                                        borderColor: '#198754'
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                </div>
            </div>

    </div>
</div>
@endsection
