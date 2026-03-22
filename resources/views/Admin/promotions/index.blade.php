@extends('adminlte::page')

@section('title', 'Quản Lý Mã Giảm Giá')

@section('content_header')
    <h1>Quản Lý Mã Giảm Giá (Promotions)</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Danh sách mã giảm giá</h4>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addPromotionModal">
                <i class="fas fa-plus"></i> Thêm mã mới
            </button>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Mã Code</th>
                            <th class="text-center">Mức giảm</th>
                            <th class="text-center">Thời gian áp dụng</th>
                            <th class="text-center">Số lượng còn</th>
                            <th class="text-center">Tình trạng</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promotions as $item)
                            <tr>
                                <td>{{ $item->promotionid }}</td>
                                <td><span class="badge badge-primary" style="font-size: 14px;">{{ $item->code }}</span></td>
                                <td class="text-center text-danger font-weight-bold">{{ $item->discount_percent }}%</td>
                                <td class="text-center">
                                    <small class="d-block">Từ: {{ \Carbon\Carbon::parse($item->startdate)->format('d/m/Y') }}</small>
                                    <small class="d-block">Đến: {{ \Carbon\Carbon::parse($item->enddate)->format('d/m/Y') }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $item->quantity > 0 ? 'badge-info' : 'badge-danger' }}">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-center">
                                    @php $now = \Carbon\Carbon::now(); @endphp
                                    @if($item->quantity <= 0)
                                        <span class="badge badge-danger">Hết lượt</span>
                                    @elseif($now->lt($item->startdate))
                                        <span class="badge badge-warning">Chưa bắt đầu</span>
                                    @elseif($now->gt($item->enddate))
                                        <span class="badge badge-secondary">Đã hết hạn</span>
                                    @else
                                        <span class="badge badge-success">Đang hoạt động</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $item->promotionid }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <form action="{{ route('admin.promotions.destroy', $item->promotionid) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $item->promotionid }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.promotions.update', $item->promotionid) }}" method="POST">
                                            @csrf
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title">Sửa mã giảm giá</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <div class="form-group">
                                                    <label>Mã Code</label>
                                                    <input type="text" name="code" class="form-control" value="{{ $item->code }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phần trăm giảm (%)</label>
                                                    <input type="number" name="discount_percent" class="form-control" value="{{ $item->discount_percent }}" min="1" max="100" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Ngày bắt đầu</label>
                                                        <input type="date" name="startdate" class="form-control" value="{{ \Carbon\Carbon::parse($item->startdate)->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Ngày kết thúc</label>
                                                        <input type="date" name="enddate" class="form-control" value="{{ \Carbon\Carbon::parse($item->enddate)->format('Y-m-d') }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Số lượng</label>
                                                    <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" min="0" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Chưa có mã giảm giá nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                {{ $promotions->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPromotionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.promotions.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Thêm Mã Giảm Giá Mới</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã Code (Ví dụ: SUMMER2026)</label>
                        <input type="text" name="code" class="form-control" style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label>Phần trăm giảm (%)</label>
                        <input type="number" name="discount_percent" class="form-control" min="1" max="100" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Ngày bắt đầu</label>
                            <input type="date" name="startdate" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ngày kết thúc</label>
                            <input type="date" name="enddate" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số lượng lượt dùng</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Tạo mã</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop