@extends('adminlte::page')

@section('title', 'Dashboard Tổng Quan')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard Tổng Quan - GoViet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalBookings ?? 0 }}</h3>
                    <p>Tổng Booking</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>
                    <p>Doanh Thu Thực Tế</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="#" class="small-box-footer">Xem báo cáo <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                    <p>Khách Hàng</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Quản lý User <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $pendingBookings ?? 0 }}</h3>
                    <p>Booking Chờ Duyệt</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="#" class="small-box-footer">Xử lý ngay <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-success">
                <div class="card-header border-0">
                    <h3 class="card-title">Doanh Thu Theo Tháng (Năm nay)</h3>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="revenueChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-info">
                <div class="card-header border-0">
                    <h3 class="card-title">Tỉ Lệ Trạng Thái Đơn Hàng</h3>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary border-0">
                    <h3 class="card-title">Top 5 Tour Bán Chạy Nhất</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Tour</th>
                                <th>Lượt Đặt (Đã duyệt)</th>
                                <th>Doanh Thu Mang Lại</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topTours as $index => $top)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ Str::limit($top->tour->title ?? 'Tour đã xóa', 50) }}</td>
                                <td>
                                    <span class="badge badge-success px-2 py-1">{{ $top->total_bookings }} Lượt</span>
                                </td>
                                <td>
                                    <b class="text-danger">{{ number_format($top->total_earned, 0, ',', '.') }}đ</b>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Chưa có dữ liệu thống kê</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Tour Vừa Thêm</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($recentTours as $tour)
                        <li class="item">
                            <div class="product-img">
                                @if($tour->images)
                             <img src="{{ asset('clients/assets/images/gallery-tours/' . $tour->images) }}" alt="Tour Image" class="img-size-50">
                                @else
                                    <img src="{{ asset('vendor/adminlte/dist/img/default-150x150.png') }}" alt="No Image" class="img-size-50">
                                @endif
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title">{{ Str::limit($tour->title, 30) }}
                                    <span class="badge badge-info float-right">{{ number_format($tour->priceadult, 0, ',', '.') }}đ</span>
                                </a>
                                <span class="product-description">
                                    {{ $tour->duration }} | {{ $tour->destination }}
                                </span>
                            </div>
                        </li>
                        @empty
                        <li class="item text-center p-3">Chưa có tour nào trong hệ thống</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="uppercase">Xem tất cả Tour</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Booking Mới Nhất</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Tour</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td><a href="#">#{{ $booking->bookingid }}</a></td>
                                    <td>{{ $booking->user->username ?? 'Khách vãng lai' }}</td>
                                    <td>{{ Str::limit($booking->tour->title ?? 'N/A', 30) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->bookingdate)->format('d/m/Y') }}</td>
                                    <td>{{ number_format($booking->totalprice, 0, ',', '.') }}đ</td>
                                    <td>
                                        @if($booking->bookingstatus == 'confirmed')
                                            <span class="badge badge-success">Đã duyệt</span>
                                        @elseif($booking->bookingstatus == 'pending')
                                            <span class="badge badge-warning">Chờ xử lý</span>
                                        @else
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">Chưa có dữ liệu booking</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="#" class="btn btn-sm btn-info float-left">Thêm Booking Mới</a>
                    <a href="#" class="btn btn-sm btn-secondary float-right">Xem Tất Cả Booking</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Nhật Ký Hệ Thống</h3>
                </div>
                <div class="card-body">
                    <div class="timeline timeline-inverse">
                        @forelse($histories as $history)
                        <div>
                            @if(str_contains(mb_strtolower($history->actionType), 'hủy'))
                                <i class="fas fa-times bg-danger"></i>
                            @elseif(str_contains(mb_strtolower($history->actionType), 'duyệt'))
                                <i class="fas fa-check bg-success"></i>
                            @else
                                <i class="fas fa-info bg-primary"></i>
                            @endif
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->timestamp)->diffForHumans() }}</span>
                                <h3 class="timeline-header border-0">
                                    <a href="#">{{ $history->user->username ?? 'Hệ thống' }}</a> {{ $history->actionType }}
                                </h3>
                            </div>
                        </div>
                        @empty
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                            <div class="timeline-item border-0">
                                <div class="timeline-body">Chưa có hoạt động nào.</div>
                            </div>
                        </div>
                        @endforelse
                        <div><i class="far fa-clock bg-gray"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(function () {
        // =====================================
        // 1. BIỂU ĐỒ DOANH THU (BAR CHART)
        // =====================================
        var monthlyRevenueData = @json($monthlyRevenue);
        
        var revenueChartCanvas = $('#revenueChart').get(0).getContext('2d');
        var revenueChartData = {
            labels  : ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [
                {
                    label               : 'Doanh thu (VNĐ)',
                    backgroundColor     : '#28a745',
                    borderColor         : '#28a745',
                    data                : monthlyRevenueData
                }
            ]
        };

        var revenueChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: { display: false },
            scales: {
                xAxes: [{ gridLines : { display : false } }],
                yAxes: [{
                    gridLines : { display : true },
                    ticks: {
                        callback: function(value, index, values) {
                            if(value >= 1000000) return (value / 1000000) + 'M';
                            if(value >= 1000) return (value / 1000) + 'K';
                            return value;
                        }
                    }
                }]
            }
        };

        new Chart(revenueChartCanvas, {
            type: 'bar',
            data: revenueChartData,
            options: revenueChartOptions
        });

        // =====================================
        // 2. BIỂU ĐỒ TRẠNG THÁI (DOUGHNUT CHART)
        // =====================================
        var statusData = @json($statusChart);
        
        var statusChartCanvas = $('#statusChart').get(0).getContext('2d');
        var statusChartData = {
            labels: ['Đã duyệt', 'Chờ xử lý', 'Đã hủy'],
            datasets: [
                {
                    data: [statusData.confirmed, statusData.pending, statusData.cancelled],
                    backgroundColor : ['#28a745', '#ffc107', '#dc3545'],
                }
            ]
        };
        var statusChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: { position: 'bottom' }
        };

        new Chart(statusChartCanvas, {
            type: 'doughnut',
            data: statusChartData,
            options: statusChartOptions
        });
    });
</script>
@stop