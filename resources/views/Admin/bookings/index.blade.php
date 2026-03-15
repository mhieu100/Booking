@extends('adminlte::page')

@section('title', 'Quản lý Booking')

@section('content_header')
    <h1>Danh Sách Booking</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Tất cả đơn đặt Tour</h3>
    </div>
    
    <div class="card-body border-bottom">
        <form action="{{ route('admin.bookings.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm ID đơn, Tên khách, Tên tour..." value="{{ request('keyword') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <select name="status" class="form-control">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã duyệt</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-info w-100"><i class="fas fa-search"></i> Lọc / Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách Hàng</th>
                    <th>Tour</th>
                    <th>Ngày Đặt</th>
                    <th>Số Lượng Khách</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $item)
                <tr>
                    <td>{{ $item->bookingid }}</td>
                    <td>{{ $item->user->username ?? 'Khách vãng lai' }}</td>
                    <td>{{ Str::limit($item->tour->title ?? 'N/A', 30) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->bookingdate)->format('d/m/Y') }}</td>
                    <td>{{ $item->numadults }} NL, {{ $item->numchildren }} TE</td>
                    <td class="text-danger font-weight-bold">{{ number_format($item->totalprice, 0, ',', '.') }}đ</td>
                    <td>
                        @if($item->bookingstatus == 'confirmed')
                            <span class="badge badge-success">Đã duyệt</span>
                        @elseif($item->bookingstatus == 'pending')
                            <span class="badge badge-warning">Chờ xử lý</span>
                        @else
                            <span class="badge badge-danger">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $item->bookingid) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Xem / Xử lý
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center">Không tìm thấy đơn hàng nào phù hợp với bộ lọc</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $bookings->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>
@stop