@extends('adminlte::page')

@section('title', 'Dashboard Tổng Quan')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard Tổng Quan - GoViet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Trang chủ</a></li>
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
            <div class="small-box bg-info shadow-sm">
                <div class="inner">
                    <h3>{{ number_format($totalBookings ?? 0) }}</h3>
                    <p>Tổng Booking (Tất cả)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ url('admin/bookings') ?? '#' }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success shadow-sm">
                <div class="inner">
                    <h3>{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>
                    <p>Doanh Thu Thực Thu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="{{ url('admin/bookings?payment=paid') ?? '#' }}" class="small-box-footer" style="color: rgba(255,255,255,0.8) !important;">Bộ lọc đã thu <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning shadow-sm">
                <div class="inner">
                    <h3 class="text-white">{{ number_format($totalDebt ?? 0, 0, ',', '.') }}<sup style="font-size: 20px">đ</sup></h3>
                    <p class="text-white">Tiền Chờ Thu (Khách nợ)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <a href="{{ url('admin/bookings?payment=unpaid') ?? '#' }}" class="small-box-footer" style="color: rgba(255,255,255,0.8) !important;">Bộ lọc chờ thu <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger shadow-sm">
                <div class="inner">
                    <h3>{{ number_format($pendingBookings ?? 0) }}</h3>
                    <p>Booking Chờ Duyệt</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="{{ url('admin/bookings?status=pending') ?? '#' }}" class="small-box-footer">Xử lý ngay <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-success shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i> Doanh Thu Thực Tế Theo Tháng (Năm nay)</h3>
                </div>
                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="revenueChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-info shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Tỉ Lệ Trạng Thái Đơn Hàng</h3>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary border-0">
                    <h3 class="card-title"><i class="fas fa-trophy mr-1 text-warning"></i> Top 5 Tour Bán Chạy Nhất</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-hover table-valign-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Tour</th>
                                <th class="text-center">Lượt Đặt</th>
                                <th class="text-right">Doanh Thu Thu Về</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topTours as $index => $top)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ Str::limit($top->title ?? 'Tour đã xóa', 50) }}</strong>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-success px-2 py-1" style="font-size: 14px;">{{ $top->total_bookings }} Đơn</span>
                                </td>
                                <td class="text-right">
                                    <b class="text-danger">{{ number_format($top->total_earned, 0, ',', '.') }} đ</b>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">Chưa có dữ liệu thống kê</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header border-0 bg-secondary">
                    <h3 class="card-title"><i class="fas fa-map-marked-alt mr-1"></i> Tour Mới Thêm</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($recentTours as $tour)
                        <li class="item">
                            <div class="product-img">
                                @if($tour->images)
                                    <img src="{{ asset('clients/assets/images/gallery-tours/' . $tour->images) }}" alt="Tour Image" class="img-size-50 rounded">
                                @else
                                    <img src="{{ asset('vendor/adminlte/dist/img/default-150x150.png') }}" alt="No Image" class="img-size-50 rounded">
                                @endif
                            </div>
                            <div class="product-info">
                                <a href="{{ url('admin/tours/'.$tour->tourid.'/edit') ?? '#' }}" class="product-title">{{ Str::limit($tour->title, 35) }}
                                    <span class="badge badge-info float-right">{{ number_format($tour->priceadult, 0, ',', '.') }}đ</span>
                                </a>
                                <span class="product-description text-sm">
                                    <i class="far fa-clock"></i> {{ $tour->duration ?? 'N/A' }} | <i class="fas fa-map-marker-alt"></i> {{ $tour->destination ?? 'N/A' }}
                                </span>
                            </div>
                        </li>
                        @empty
                        <li class="item text-center p-3 text-muted">Chưa có tour nào trong hệ thống</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ url('admin/tours') ?? '#' }}" class="uppercase font-weight-bold">Xem tất cả Tour</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header border-transparent bg-dark">
                    <h3 class="card-title"><i class="fas fa-receipt mr-1"></i> Booking Mới Nhất</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover m-0">
                            <thead>
                                <tr>
                                    <th>Mã Đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Tour</th>
                                    <th>Trạng Thái Đơn</th>
                                    <th>Thanh Toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td><a href="{{ url('admin/bookings/'.$booking->bookingid) ?? '#' }}" class="font-weight-bold">#{{ $booking->bookingid }}</a></td>
                                    <td>{{ $booking->username ?? 'Khách vãng lai' }}</td>
                                    <td>
                                        {{ Str::limit($booking->title ?? 'N/A', 25) }}<br>
                                        <small class="text-muted"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($booking->bookingdate)->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        @if($booking->bookingstatus == 'confirmed')
                                            <span class="badge badge-success">Đã duyệt</span>
                                        @elseif($booking->bookingstatus == 'pending')
                                            <span class="badge badge-warning">Chờ duyệt</span>
                                        @else
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->paymentstatus == 'paid')
                                            <span class="badge badge-success"><i class="fas fa-check"></i> Đã thanh toán</span>
                                        @elseif($booking->paymentstatus == 'deposit_paid')
                                            <span class="badge badge-info"><i class="fas fa-coins"></i> Đã đặt cọc</span>
                                        @elseif($booking->paymentstatus == 'refund_pending')
                                            <span class="badge badge-warning"><i class="fas fa-undo"></i> Chờ hoàn tiền</span>
                                        @else
                                            <span class="badge badge-secondary"><i class="fas fa-times"></i> Chưa TT</span>
                                        @endif
                                        <br>
                                        <small class="text-danger font-weight-bold">{{ number_format($booking->totalprice, 0, ',', '.') }}đ</small>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu booking</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ url('admin/bookings/create') ?? '#' }}" class="btn btn-sm btn-info float-left"><i class="fas fa-plus"></i> Tạo Booking Mới</a>
                    <a href="{{ url('admin/bookings') ?? '#' }}" class="btn btn-sm btn-secondary float-right">Xem Tất Cả Booking</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header border-0 bg-light">
                    <h3 class="card-title"><i class="fas fa-history mr-1"></i> Hoạt Động Gần Đây</h3>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-inverse">
                        @forelse($histories as $history)
                        <div>
                            @if(str_contains(mb_strtolower($history->actionType), 'hủy'))
                                <i class="fas fa-times bg-danger"></i>
                            @elseif(str_contains(mb_strtolower($history->actionType), 'duyệt') || str_contains(mb_strtolower($history->actionType), 'thành công'))
                                <i class="fas fa-check bg-success"></i>
                            @elseif(str_contains(mb_strtolower($history->actionType), 'tạo'))
                                <i class="fas fa-plus bg-info"></i>
                            @else
                                <i class="fas fa-info bg-primary"></i>
                            @endif
                            
                            <div class="timeline-item shadow-none border">
                                <span class="time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($history->timestamp)->diffForHumans() }}</span>
                                <h3 class="timeline-header border-0" style="font-size: 14px;">
                                    <strong class="text-primary">{{ $history->username ?? 'Hệ thống' }}</strong> <br> 
                                    <span class="text-muted">{{ $history->actionType }}</span>
                                </h3>
                            </div>
                        </div>
                        @empty
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                            <div class="timeline-item border-0">
                                <div class="timeline-body text-muted">Chưa có hoạt động nào.</div>
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
                    label               : 'Doanh thu',
                    backgroundColor     : '#28a745',
                    borderColor         : '#28a745',
                    data                : monthlyRevenueData,
                    borderWidth         : 1,
                    borderRadius        : 4 // Làm bo tròn đầu cột nhìn hiện đại hơn
                }
            ]
        };

        var revenueChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: { display: false },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = tooltipItem.yLabel;
                        // Format số tiền trong tooltip (Hover vào cột)
                        return " Doanh thu: " + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
                    }
                }
            },
            scales: {
                xAxes: [{ 
                    gridLines : { display : false },
                    ticks: { fontStyle: 'bold' }
                }],
                yAxes: [{
                    gridLines : { 
                        display : true,
                        color: "rgba(0, 0, 0, .05)"
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if(value >= 1000000000) return (value / 1000000000) + ' Tỷ';
                            if(value >= 1000000) return (value / 1000000) + ' Triệu';
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
                    borderWidth: 0
                }
            ]
        };
        var statusChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: { 
                position: 'bottom',
                labels: { padding: 20, boxWidth: 12 }
            },
            cutoutPercentage: 65, // Làm vòng doughnut mỏng hơn
        };

        new Chart(statusChartCanvas, {
            type: 'doughnut',
            data: statusChartData,
            options: statusChartOptions
        });
    });
</script>
@stop