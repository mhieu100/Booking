@include('Clients.blocks.header')

<div class="container mt-5 mb-5">
    <h3 class="mb-4">
        <i class="fa-solid fa-clock-rotate-left"></i> Lịch sử đặt tour
    </h3>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên tour</th>
                    <th>Ngày đặt</th>
                    <th>Khách (L/T)</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td><strong>#{{ $booking->bookingid }}</strong></td>
                        <td>{{ $booking->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->bookingdate)->format('d/m/Y') }}</td>
                        <td>{{ $booking->numadults }} / {{ $booking->numchildren }}</td>
                        <td class="text-primary"><strong>{{ number_format($booking->totalprice) }} VNĐ</strong></td>
                        <td>
                            @if($booking->bookingstatus == 'pending')
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            @elseif($booking->bookingstatus == 'confirmed')
                                <span class="badge bg-success">Đã xác nhận</span>
                            @elseif($booking->bookingstatus == 'cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                {{-- Nút Chi tiết --}}
                                <button class="btn btn-info btn-sm text-white" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#detail{{ $booking->bookingid }}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                {{-- Nút Hủy tour --}}
                                @if($booking->bookingstatus == 'pending')
                                    <form action="{{ route('booking.cancelled', $booking->bookingid) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy tour này?')">
                                            <i class="fa fa-times"></i> Hủy
                                        </button>
                                    </form>
                                @endif

                                {{-- Nút Đặt lại --}}
                                @if($booking->bookingstatus == 'cancelled')
                                    <form action="{{ route('booking.rebook', $booking->bookingid) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-rotate-right"></i> Đặt lại
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    {{-- Hàng chi tiết ẩn --}}
                    <tr class="collapse shadow-sm" id="detail{{ $booking->bookingid }}">
                        <td colspan="7" class="bg-light">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><i class="fa fa-info-circle"></i> Chi tiết hành trình</h6>
                                        <p class="mb-1"><strong>Ngày khởi hành:</strong> {{ \Carbon\Carbon::parse($booking->startdate)->format('d/m/Y') }}</p>
                                        <p class="mb-0"><strong>Yêu cầu đặc biệt:</strong> {{ $booking->specialrequest ?? 'Không có' }}</p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        {{-- Có thể thêm nút In vé hoặc liên hệ hỗ trợ ở đây --}}
                                        <small class="text-muted">Cần hỗ trợ? Gọi 1900 xxxx</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Bạn chưa có lịch sử đặt tour nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('Clients.blocks.footer')