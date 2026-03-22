@extends('adminlte::page')

@section('title', 'Quản lý Booking')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-list-alt mr-2"></i>Danh Sách Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quản lý Booking</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary">
        <h3 class="card-title"><i class="fas fa-search mr-1"></i> Bộ lọc & Tìm kiếm</h3>
    </div>
    
    <div class="card-body border-bottom bg-light">
        <form action="{{ route('admin.bookings.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm ID đơn, Tên khách, Tên tour..." value="{{ request('keyword') }}">
                </div>
                
                <div class="col-md-2 mb-2">
                    <select name="status" class="form-control">
                        <option value="">-- Trạng thái Đơn --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã duyệt</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div class="col-md-3 mb-2">
                    <select name="payment" class="form-control">
                        <option value="">-- Trạng thái Thanh toán --</option>
                        <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Đã thanh toán (100%)</option>
                        <option value="deposit_paid" {{ request('payment') == 'deposit_paid' ? 'selected' : '' }}>Đã đặt cọc</option>
                        <option value="unpaid" {{ request('payment') == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                        <option value="refund_pending" {{ request('payment') == 'refund_pending' ? 'selected' : '' }}>Chờ hoàn tiền</option>
                    </select>
                </div>
                
                <div class="col-md-2 mb-2">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-info w-100"><i class="fas fa-filter"></i> Lọc dữ liệu</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped text-nowrap table-valign-middle">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Mã Đơn</th>
                    <th>Khách Hàng</th>
                    <th>Thông Tin Tour</th>
                    <th class="text-right">Tài Chính</th>
                    <th class="text-center">Trạng Thái Đơn</th>
                    <th class="text-center">Thanh Toán</th>
                    <th class="text-center">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $item)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.bookings.show', $item->bookingid) }}" class="font-weight-bold">
                            #{{ $item->bookingid }}
                        </a>
                    </td>
                    <td>
                        <strong class="text-primary">{{ $item->user->username ?? 'Khách vãng lai' }}</strong><br>
                        <small class="text-muted"><i class="fas fa-users"></i> {{ $item->numadults }} Lớn, {{ $item->numchildren }} Nhỏ</small>
                    </td>
                    <td>
                        {{ Str::limit($item->tour->title ?? 'N/A', 35) }}<br>
                        <small class="text-muted"><i class="far fa-calendar-alt"></i> Ngày đặt: {{ \Carbon\Carbon::parse($item->bookingdate)->format('d/m/Y') }}</small>
                    </td>
                    <td class="text-right">
                        <div>Tổng: <strong class="text-danger">{{ number_format($item->totalprice, 0, ',', '.') }}đ</strong></div>
                        <div><small class="text-success">Đã thu: {{ number_format($item->paid_amount ?? 0, 0, ',', '.') }}đ</small></div>
                    </td>
                    <td class="text-center">
                        @if($item->bookingstatus == 'confirmed')
                            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Đã duyệt</span>
                        @elseif($item->bookingstatus == 'pending')
                            <span class="badge badge-warning"><i class="fas fa-hourglass-half"></i> Chờ duyệt</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Đã hủy</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->paymentstatus == 'paid')
                            <span class="badge badge-success">Đã thanh toán</span>
                        @elseif($item->paymentstatus == 'deposit_paid')
                            <span class="badge badge-info">Đã đặt cọc</span>
                        @elseif($item->paymentstatus == 'refund_pending')
                            <span class="badge badge-warning">Chờ hoàn tiền</span>
                        @else
                            <span class="badge badge-secondary">Chưa thanh toán</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.bookings.show', $item->bookingid) }}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-eye"></i> Xử lý
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="fas fa-box-open fa-3x mb-3 text-light"></i><br>
                        Không tìm thấy đơn hàng nào phù hợp với bộ lọc
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="card-footer clearfix mt-2">
        <div class="float-right">
            {{ $bookings->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@stop