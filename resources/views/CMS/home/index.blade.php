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
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">
                        <i class="fa-solid fa-square-check fa-6x" style="color: #589F4C"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6 class="mt-2">Đơn hàng đã thanh toán</h6>
                            <h6>{{$total_success}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">

                        <i class="fa-solid fa-square-minus fa-6x" style="color: #F59E34"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6 class="mt-2">Đơn hàng đã xác nhận</h6>
                            <h6>{{$total_wait}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">
                        <i class="fa-solid fa-square-plus fa-6x"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6 class="mt-2">Đơn hàng mới</h6>
                            <h6>{{$total_cancel}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-start align-items-center">

                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">
                        <i class="fa-solid fa-square-xmark fa-6x" style="color: #dd0000"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6 class="mt-2">Đơn hàng đã hủy</h6>
                            <h6>{{$total_fail}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">
                        <i class="fa-solid fa-money-bill-wave fa-5x" style="color: #589F4C"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6 class="mt-2">Đã thanh toán</h6>
                            <h6>{{number_format($payment_success, 0, ',', '.')}} VND</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted" style="height: 100px">
                        <i class="fa-solid fa-money-bill fa-5x" style="color: #F59E34"></i>
                        <div class="w-75 d-flex flex-column text-center" style="font-family: NeoSansIntelBold, sans-serif;font-weight: 700;text-transform: uppercase;">
                            <h6>Chưa thanh toán</h6>
                            <h6>{{number_format($payment_wait,0, ',', '.')}} VND</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-start align-items-center">
                <div class="col-12">

                    <div>
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
                                datasets: [
                                    {
                                        label: 'Đã thanh toán',
                                        data: {{$order_success}},
                                        borderWidth: 1,
                                        backgroundColor: '#589F4C',
                                    },
                                    {
                                        label: 'Đã xác nhận',
                                        data: {{$order_wait}},
                                        borderWidth: 1,
                                        backgroundColor: '#F59E34',
                                    },
                                    {
                                        label: 'Đơn hàng mới',
                                        data: {{$order_cancel}},
                                        borderWidth: 1,
                                        backgroundColor: '#637381',
                                    },
                                    {
                                        label: 'Đã hủy',
                                        data: {{$order_fail}},
                                        borderWidth: 1,
                                        backgroundColor: '#DD0000',
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
