@include('Clients.blocks.header')

<div class="user-profile py-5" style="background:#f5f7fb; min-height: 80vh;">
    <div class="container">
        
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark">Quản Lý Hồ Sơ</h2>
                <p class="text-muted">Cập nhật thông tin cá nhân và quản lý hành trình của bạn</p>
            </div>
        </div>

        {{-- Hệ thống thông báo --}}
        <div class="row justify-content-center mb-3">
            <div class="col-lg-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm border-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-times-circle me-1"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            {{-- CỘT TRÁI: AVATAR & ĐỔI MK --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 text-center mb-4" style="border-radius: 15px;">
                    <div class="card-body pt-5">
                        <div class="position-relative d-inline-block mb-3">
                            <img id="avatar-preview" class="rounded-circle shadow-sm border border-4 border-white"
                                 src="{{ $user->avatar ? asset('clients/assets/images/avatars/' . $user->avatar) : asset('clients/assets/images/avatars/default.png') }}"
                                 style="width:150px; height:150px; object-fit:cover;">
                        </div>
                        <h5 class="fw-bold mb-0">{{ $user->username }}</h5>
                        <p class="text-muted small mb-4">{{ $user->email }}</p>

                        <form method="POST" action="{{ route('user.avatar') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control form-control-sm" type="file" name="avatar" id="avatar-input" accept="image/*" required>
                            </div>
                            <button class="btn btn-primary w-100 rounded-pill shadow-sm">
                                <i class="fas fa-cloud-upload-alt me-1"></i> Cập nhật ảnh
                            </button>
                        </form>
                    </div>
                </div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-header bg-white border-0 pt-4 pb-0">
        <h6 class="mb-0 text-dark fw-bold">
            <i class="fas fa-lock text-warning me-2"></i>Đổi mật khẩu
        </h6>
    </div>

    <div class="card-body pt-3">

        <form method="POST" action="{{ route('user.password') }}">
            @csrf

            <div class="mb-3">
                <label class="text-muted small fw-bold">Mật khẩu hiện tại</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-key text-muted"></i>
                    </span>
                    <input 
                        class="form-control bg-light border-0 shadow-none"
                        name="old_password"
                        type="password"
                        placeholder="Nhập mật khẩu hiện tại"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="text-muted small fw-bold">Mật khẩu mới</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input 
                        class="form-control bg-light border-0 shadow-none"
                        name="new_password"
                        type="password"
                        placeholder="Nhập mật khẩu mới"
                        required>
                </div>
            </div>

            <div class="mb-4">
                <label class="text-muted small fw-bold">Xác nhận mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-check text-muted"></i>
                    </span>
                    <input 
                        class="form-control bg-light border-0 shadow-none"
                        name="confirm_password"
                        type="password"
                        placeholder="Nhập lại mật khẩu mới"
                        required>
                </div>
            </div>

            <button class="btn btn-warning w-100 rounded-pill shadow-sm fw-bold">
                <i class="fas fa-sync-alt me-1"></i> Cập nhật mật khẩu
            </button>

        </form>

    </div>
</div>
            </div>

            {{-- CỘT PHẢI: TABS NỘI DUNG --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 bg-white" style="border-radius: 15px;">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <ul class="nav nav-tabs profile-tabs border-0" id="profileTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active fw-bold border-0 bg-transparent px-3 pb-3" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                                    <i class="fas fa-user-edit text-success me-1"></i> Thông tin cá nhân
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-bold border-0 bg-transparent px-3 pb-3" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                                    <i class="fas fa-history text-primary me-1"></i> Lịch sử đặt Tour
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link fw-bold border-0 bg-transparent px-3 pb-3" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button" role="tab">
                                    <i class="fas fa-heart text-danger me-1"></i> Tour yêu thích
                                </button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-body p-4 pt-2">
                        <div class="tab-content" id="profileTabContent">
                            
                            {{-- TAB 1: THÔNG TIN CÁ NHÂN --}}
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <form method="POST" action="{{ route('user.update') }}">
                                    @csrf
                                    <div class="row g-4 mt-1">
                                        <div class="col-md-12">
                                            <label class="text-muted small fw-bold">Họ và tên</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i class="fas fa-user text-muted"></i></span>
                                                <input class="form-control bg-light border-0 shadow-none" name="username" value="{{ old('username', $user->username) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small fw-bold">Số điện thoại</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i class="fas fa-phone-alt text-muted"></i></span>
                                                <input class="form-control bg-light border-0 shadow-none" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small fw-bold">Email (Không thể thay đổi)</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0" style="background: #e2e8f0;"><i class="fas fa-envelope text-muted"></i></span>
                                                <input class="form-control border-0 shadow-none" style="background: #e2e8f0;" value="{{ $user->email }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="text-muted small fw-bold">Địa chỉ</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                                <input class="form-control bg-light border-0 shadow-none" name="address" value="{{ old('address', $user->address) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm fw-bold">Lưu Thay Đổi</button>
                                    </div>
                                </form>
                            </div>

                            {{-- TAB 2: LỊCH SỬ ĐẶT TOUR --}}
                            <div class="tab-pane fade" id="history" role="tabpanel">
                                <div class="table-responsive mt-3">
                                    <table class="table table-hover align-middle border-0">
                                        <thead class="table-light">
                                            <tr class="small text-muted">
                                                <th>MÃ VÉ</th>
                                                <th>TÊN TOUR</th>
                                                <th>NGÀY ĐẶT</th>
                                                <th>TỔNG TIỀN</th>
                                                <th>TRẠNG THÁI</th>
                                                <th class="text-center">HÀNH ĐỘNG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($bookings as $booking)
                                                <tr>
                                                    <td><span class="fw-bold">#{{ $booking->bookingid }}</span></td>
                                                    <td>
                                                        <span class="fw-bold text-truncate d-inline-block" style="max-width: 200px; color: #0d47a1;">
                                                            {{ $booking->title }}
                                                        </span>
                                                    </td>
                                                    <td class="small">{{ \Carbon\Carbon::parse($booking->bookingdate)->format('d/m/Y') }}</td>
                                                    <td class="text-danger fw-bold">{{ number_format($booking->totalprice) }} đ</td>
                                                    <td>
                                                        @if($booking->bookingstatus == 'pending')
                                                            <span class="badge rounded-pill bg-warning text-dark px-3">Chờ duyệt</span>
                                                        @elseif($booking->bookingstatus == 'confirmed')
                                                            <span class="badge rounded-pill bg-success px-3 text-white">Thành công</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-secondary px-3 text-white">Đã hủy</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            {{-- Nút Chi tiết --}}
                                                            <button class="btn btn-sm btn-outline-info rounded-circle" 
                                                                    data-bs-toggle="collapse" 
                                                                    data-bs-target="#detail{{ $booking->bookingid }}"
                                                                    title="Xem chi tiết">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                            
                                                            {{-- Nút Hủy (Chỉ hiện khi đang chờ duyệt) --}}
                                                            @if($booking->bookingstatus == 'pending')
                                                                <form action="{{ route('booking.cancelled', $booking->bookingid) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-outline-danger rounded-circle" 
                                                                            onclick="return confirm('Xác nhận hủy đơn đặt tour này?')"
                                                                            title="Hủy đơn">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            {{-- Nút Đặt lại (Chỉ hiện khi đã hủy) --}}
                                                            @if($booking->bookingstatus == 'cancelled')
                                                                <form action="{{ route('booking.rebook', $booking->bookingid) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-outline-primary rounded-circle" title="Đặt lại tour này">
                                                                        <i class="fa fa-rotate-right"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                {{-- Chi tiết ẩn --}}
                                                <tr class="collapse border-0" id="detail{{ $booking->bookingid }}">
                                                    <td colspan="6" class="p-0 border-0">
                                                        <div class="p-3 m-2 bg-light rounded shadow-inner border-start border-4 border-info">
                                                            <div class="row small">
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>Ngày khởi hành:</strong> {{ \Carbon\Carbon::parse($booking->startdate)->format('d/m/Y') }}</p>
                                                                    <p class="mb-0"><strong>Số lượng khách:</strong> {{ $booking->numadults }} Lớn / {{ $booking->numchildren }} Trẻ em</p>
                                                                </div>
                                                                <div class="col-md-6 text-md-end border-start">
                                                                    <p class="mb-1 text-muted">Ghi chú yêu cầu:</p>
                                                                    <p class="mb-0 fw-bold">{{ $booking->specialrequest ?? 'Không có yêu cầu đặc biệt' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-5 text-muted">
                                                        <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                                        <p>Bạn chưa có lịch sử đặt tour nào.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- TAB 3: TOUR YÊU THÍCH --}}
                            <div class="tab-pane fade" id="wishlist" role="tabpanel">
                                <div class="text-center py-5">
                                    <i class="fas fa-heart fa-4x text-light mb-3"></i>
                                    <h5 class="text-muted">Danh sách yêu thích đang trống</h5>
                                    <a href="{{ route('Tours') }}" class="btn btn-sm btn-outline-primary rounded-pill mt-2 px-4">Khám phá tour ngay</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Tabs Custom */
    .profile-tabs .nav-link { 
        color: #6c757d; 
        position: relative; 
        transition: all 0.3s;
    }
    .profile-tabs .nav-link:hover { color: #198754; }
    .profile-tabs .nav-link.active { color: #198754 !important; }
    .profile-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #198754;
        border-radius: 3px 3px 0 0;
    }
    /* Password form */
.card-body input:focus{
    background:#fff !important;
    box-shadow:0 0 0 2px rgba(25,135,84,0.1);
}

.btn-warning{
    background: linear-gradient(45deg,#ffc107,#ff9800);
    border:none;
}

.btn-warning:hover{
    transform:translateY(-1px);
    box-shadow:0 5px 10px rgba(0,0,0,0.15);
}

    /* Table & Effects */
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,0.01); }
    .input-group-text { min-width: 45px; justify-content: center; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Preview Ảnh Đại Diện
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    
    if(avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Tự động mở Tab từ URL Hash
    let hash = window.location.hash;
    if (hash) {
        let triggerEl = document.querySelector(`.nav-link[data-bs-target="${hash}"]`);
        if (triggerEl) {
            bootstrap.Tab.getOrCreateInstance(triggerEl).show();
        }
    }
});
</script>

@include('Clients.blocks.footer')