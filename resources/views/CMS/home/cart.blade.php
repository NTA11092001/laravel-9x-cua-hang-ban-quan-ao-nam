@extends('CMS.master')
@section('content')
<div class="container-fluid p-6">
    <div class="row">
        <div class="container-fluid border-bottom pb-4 mb-4">
            <div class="row">
                <div class="col-8">
                    <!-- Page header -->
                    <h3 class="mb-0 fw-bold">Thống kê đơn hàng tháng {{request('month') ? date('m-Y',strtotime(request('month'))) : date('m-Y')}}</h3>
                </div>

                <div class="col-4">
                    <form class="row justify-content-end" action="{{route('admin.home.cart')}}" method="GET">
                        <div class="col-6">
                            <input type="month" class="form-control" name="month" value="{{request('month') ? request('month') : date('Y-m')}}">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-dark">Lọc</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container-fluid border-bottom">
            <div class="row justify-content-between align-items-center">

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-star fa-5x text-warning"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Khách hàng mua nhiều nhất</h5>
                            <h5>{{count($member['best_buy']) > 0 ? $member['best_buy'][0]->name.' ('.$member['best_buy'][0]->cart_count.' đơn hàng)' : 'Không có khách hàng nào'}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-user-plus fa-5x text-primary"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Số khách hàng đăng ký mới</h5>
                            <h5>{{count($member['register'])}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-clipboard-list fa-6x text-warning"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng mới</h5>
                            <h5>{{$data_total['total_new']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-box-open fa-6x text-primary"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đang chuẩn bị</h5>
                            <h5>{{$data_total['total_ready']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-truck fa-5x text-primary"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đang vận chuyển</h5>
                            <h5>{{$data_total['total_delivery']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-truck fa-5x text-primary"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đang giao</h5>
                            <h5>{{$data_total['total_shipping']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-circle-check fa-6x text-success"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đã hoàn thành</h5>
                            <h5>{{$data_total['total_complete']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-circle-xmark fa-6x text-danger"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đã hủy</h5>
                            <h5>{{$data_total['total_cancel']}}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-square-check fa-6x text-success"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng đã thanh toán</h5>
                            <h5>{{$data_total['payment_success']}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">

                        <i class="fa-solid fa-square-xmark fa-6x text-warning"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Đơn hàng chưa thanh toán</h5>
                            <h5>{{$data_total['payment_fail']}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-money-bill-wave fa-5x text-success"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Tổng tiền đã thanh toán</h5>
                            <h5>{{number_format($data_total['total_payment_success'], 0, ',', '.')}} VND</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="item-report mb-4 d-flex flex-row border border-2 border-dark rounded-2 p-2 border-muted dashboard-height">
                        <i class="fa-solid fa-money-bill fa-5x text-warning"></i>
                        <div class="w-75 d-flex flex-column text-center dashboard-text">
                            <h5 class="fw-bold mt-2">Tổng tiền chưa thanh toán</h5>
                            <h5>{{number_format($data_total['total_payment_fail'],0, ',', '.')}} VND</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid border-bottom mb-4">
        <div class="row">
            <div class="container text-center p-4">
                <h4>Thống kê trạng thái đơn hàng</h4>
            </div>
            <div class="container-fluid bg-white p-2">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link text-dark active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-link" type="button" role="tab" aria-controls="general-link" aria-selected="true">Tổng quát</button>
                        <button class="nav-link text-dark" id="order_new-tab" data-bs-toggle="tab" data-bs-target="#order_new-link" type="button" role="tab" aria-controls="order_new-link" aria-selected="false">Đơn hàng mới</button>
                        <button class="nav-link text-dark" id="order_ready-tab" data-bs-toggle="tab" data-bs-target="#order_ready-link" type="button" role="tab" aria-controls="order_ready-link" aria-selected="false">Đơn hàng đang chuẩn bị</button>
                        <button class="nav-link text-dark" id="order_delivery-tab" data-bs-toggle="tab" data-bs-target="#order_delivery-link" type="button" role="tab" aria-controls="order_delivery-link" aria-selected="false">Đơn hàng đang vận chuyển</button>
                        <button class="nav-link text-dark" id="order_shipping-tab" data-bs-toggle="tab" data-bs-target="#order_shipping-link" type="button" role="tab" aria-controls="order_shipping-link" aria-selected="false">Đơn hàng đang giao</button>
                        <button class="nav-link text-dark" id="order_complete-tab" data-bs-toggle="tab" data-bs-target="#order_complete-link" type="button" role="tab" aria-controls="order_complete-link" aria-selected="false">Đơn hàng đã hoàn thành</button>
                        <button class="nav-link text-dark" id="order_cancel-tab" data-bs-toggle="tab" data-bs-target="#order_cancel-link" type="button" role="tab" aria-controls="order_cancel-link" aria-selected="false">Đơn hàng đã hủy</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="general-link" role="tabpanel" aria-labelledby="general-tab">
                        <canvas id="general"></canvas>
                        <script>
                            new Chart($('#general'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng mới',
                                            data: {{$data_1_month['order_new']}},
                                            borderWidth: 1,
                                            backgroundColor: '#F59E0B',
                                        },
                                        {
                                            label: 'Đơn hàng đang chuẩn bị',
                                            data: {{$data_1_month['order_ready']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
                                        },
                                        {
                                            label: 'Đơn hàng đang vận chuyển',
                                            data: {{$data_1_month['order_delivery']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
                                        },
                                        {
                                            label: 'Đơn hàng đang giao',
                                            data: {{$data_1_month['order_shipping']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
                                        },
                                        {
                                            label: 'Đơn hàng đã hoàn thành',
                                            data: {{$data_1_month['order_complete']}},
                                            borderWidth: 1,
                                            backgroundColor: '#198754',
                                        },
                                        {
                                            label: 'Đơn hàng đã hủy',
                                            data: {{$data_1_month['order_cancel']}},
                                            borderWidth: 1,
                                            backgroundColor: '#DC3545',
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
                    <div class="tab-pane fade" id="order_new-link" role="tabpanel" aria-labelledby="order_new-tab">
                        <canvas id="order_new"></canvas>
                        <script>
                            new Chart($('#order_new'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng mới',
                                            data: {{$data_1_month['order_new']}},
                                            borderWidth: 1,
                                            backgroundColor: '#F59E0B',
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
                    <div class="tab-pane fade" id="order_ready-link" role="tabpanel" aria-labelledby="order_ready-tab">
                        <canvas id="order_ready"></canvas>
                        <script>
                            new Chart($('#order_ready'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng đang chuẩn bị',
                                            data: {{$data_1_month['order_ready']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
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
                    <div class="tab-pane fade" id="order_delivery-link" role="tabpanel" aria-labelledby="order_delivery-tab">
                        <canvas id="order_delivery"></canvas>
                        <script>
                            new Chart($('#order_delivery'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng đang vận chuyển',
                                            data: {{$data_1_month['order_delivery']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
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
                    <div class="tab-pane fade" id="order_shipping-link" role="tabpanel" aria-labelledby="order_shipping-tab">
                        <canvas id="order_shipping"></canvas>
                        <script>
                            new Chart($('#order_shipping'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng đang giao',
                                            data: {{$data_1_month['order_shipping']}},
                                            borderWidth: 1,
                                            backgroundColor: '#624BFF',
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
                    <div class="tab-pane fade" id="order_complete-link" role="tabpanel" aria-labelledby="order_complete-tab">
                        <canvas id="order_complete"></canvas>
                        <script>
                            new Chart($('#order_complete'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng đã hoàn thành',
                                            data: {{$data_1_month['order_complete']}},
                                            borderWidth: 1,
                                            backgroundColor: '#198754',
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
                    <div class="tab-pane fade" id="order_cancel-link" role="tabpanel" aria-labelledby="order_cancel-tab">
                        <canvas id="order_cancel"></canvas>
                        <script>
                            new Chart($('#order_cancel'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng đã hủy',
                                            data: {{$data_1_month['order_cancel']}},
                                            borderWidth: 1,
                                            backgroundColor: '#DC3545',
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
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="container text-center p-4">
                <h4>Thống kê doanh thu</h4>
            </div>
            <div class="container-fluid bg-white p-2">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link text-dark active" id="bill_status-tab" data-bs-toggle="tab" data-bs-target="#bill_status-link" type="button" role="tab" aria-controls="bill_status-link" aria-selected="true">Doanh thu</button>
                        <button class="nav-link text-dark" id="total_1_month-tab" data-bs-toggle="tab" data-bs-target="#total_1_month-link" type="button" role="tab" aria-controls="total_1_month-link" aria-selected="false">Tình trạng thanh toán</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="bill_status-link" role="tabpanel" aria-labelledby="bill_status-tab">
                        <canvas id="total_1_month"></canvas>
                        <script>
                            new Chart($('#total_1_month'), {
                                type: 'line',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Số tiền chưa thanh toán',
                                            data: {{$data_1_month['total_fail_1_month']}},
                                            borderWidth: 1,
                                            backgroundColor: '#F59E0B',
                                            borderColor: '#F59E0B'
                                        },
                                        {
                                            label: 'Số tiền đã thanh toán',
                                            data: {{$data_1_month['total_success_1_month']}},
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
                    <div class="tab-pane fade" id="total_1_month-link" role="tabpanel" aria-labelledby="total_1_month-tab">
                        <canvas id="bill_status"></canvas>
                        <script>
                            new Chart($('#bill_status'), {
                                type: 'bar',
                                data: {
                                    labels: {{$labels}},
                                    datasets: [
                                        {
                                            label: 'Đơn hàng chưa thanh toán',
                                            data: {{$data_1_month['fail_pay']}},
                                            borderWidth: 1,
                                            backgroundColor: '#F59E0B'
                                        },
                                        {
                                            label: 'Đơn hàng đã thanh toán',
                                            data: {{$data_1_month['success_pay']}},
                                            borderWidth: 1,
                                            backgroundColor: '#198754'
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
    </div>
</div>
@endsection
@push('scripts')
    <script>

        {{--new Chart($('#Total'), {--}}
        {{--    type: 'line',--}}
        {{--    data: {--}}
        {{--        labels: ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'],--}}
        {{--        datasets: [--}}

        {{--            {--}}
        {{--                label: 'Số tiền chưa thanh toán',--}}
        {{--                data: {{$data_1_month['total_fail_12_month']}},--}}
        {{--                borderWidth: 1,--}}
        {{--                backgroundColor: '#F59E0B',--}}
        {{--                borderColor: '#F59E0B'--}}
        {{--            },--}}
        {{--            {--}}
        {{--                label: 'Số tiền đã thanh toán',--}}
        {{--                data: {{$data_1_month['total_success_12_month']}},--}}
        {{--                borderWidth: 1,--}}
        {{--                backgroundColor: '#198754',--}}
        {{--                borderColor: '#198754'--}}
        {{--            }--}}
        {{--        ]--}}
        {{--    },--}}
        {{--    options: {--}}
        {{--        scales: {--}}
        {{--            y: {--}}
        {{--                beginAtZero: true--}}
        {{--            }--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}
    </script>
@endpush
