@extends('adminlte::page')

@section('title', 'Quản Lý Đánh Giá')

@section('content_header')
    <h1>Quản Lý Đánh Giá (Reviews)</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Danh sách đánh giá từ khách hàng</h4>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Khách hàng</th>
                            <th width="15%">Tour</th>
                            <th width="25%">Đánh giá & Bình luận</th>
                            <th width="20%">Phản hồi của Admin</th>
                            <th width="10%" class="text-center">Trạng thái</th>
                            <th width="10%" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $item)
                            <tr>
                                <td>{{ $item->reviewid }}</td>
                                <td>
                                    <strong>{{ $item->user->name ?? $item->user->username ?? 'Khách' }}</strong><br>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->createdat)->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <span class="text-primary">{{ $item->tour->title ?? 'Tour đã bị xóa' }}</span>
                                </td>
                                <td>
                                    <div class="text-warning mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $item->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <p class="mb-0" style="font-size: 14px;">{{ $item->comment }}</p>
                                </td>
                                <td>
                                    @if($item->admin_reply)
                                        <div class="p-2 bg-light border-left border-warning" style="font-size: 13px; border-left-width: 3px !important;">
                                            {{ $item->admin_reply }}
                                        </div>
                                    @else
                                        <span class="badge badge-secondary">Chưa phản hồi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.reviews.toggle', $item->reviewid) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $item->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                            <i class="fas {{ $item->status == 1 ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                            {{ $item->status == 1 ? 'Hiện' : 'Ẩn' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#replyModal{{ $item->reviewid }}">
                                        <i class="fas fa-reply"></i> Trả lời
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="replyModal{{ $item->reviewid }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.reviews.reply', $item->reviewid) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Phản hồi khách hàng</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-muted">Khách viết: <em>"{{ $item->comment }}"</em></p>
                                                <div class="form-group">
                                                    <label class="fw-bold">Nội dung trả lời:</label>
                                                    <textarea name="admin_reply" class="form-control" rows="4" required>{{ $item->admin_reply }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu phản hồi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Chưa có đánh giá nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $reviews->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .table td { vertical-align: middle !important; }
    </style>
@stop