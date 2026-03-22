@extends('adminlte::page')

@section('title', 'Quản lý Bài viết')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold">
                    <i class="fas fa-newspaper mr-2"></i>Quản lý bài viết
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle mr-1"></i> Thêm bài viết mới
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        {{-- 1. Khung Tìm kiếm & Lọc --}}
        <div class="card card-default shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.blogs.index') }}" method="GET" class="row">
                    <div class="col-md-8 col-sm-12 mb-2">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tiêu đề hoặc ID..." value="{{ request('keyword') }}">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 text-right">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-default">Làm mới</a>
                        <button type="submit" class="btn btn-info">Lọc dữ liệu</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- 2. Thông báo thành công --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <h5><i class="icon fas fa-check-circle"></i> Thành công!</h5>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- 3. Bảng dữ liệu --}}
        <div class="card card-primary card-outline shadow">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bold">Danh sách bài viết ({{ $blogs->total() }})</h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-hover table-valign-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%" class="text-center">ID</th>
                            <th style="width: 10%">Hình ảnh</th>
                            <th style="width: 35%">Tiêu đề</th>
                            <th style="width: 15%">Danh mục</th>
                            <th style="width: 15%" class="text-center">Trạng thái</th>
                            <th style="width: 20%" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr>
                            <td class="text-center font-weight-bold text-muted">{{ $blog->id }}</td>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" class="img-thumbnail shadow-sm" width="70" style="height: 50px; object-fit: cover;" alt="{{ $blog->title }}">
                                @else
                                    <div class="bg-secondary text-white text-center rounded d-flex align-items-center justify-content-center" style="width: 70px; height: 50px; font-size: 10px;">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="d-block font-weight-bold text-dark">{{ Str::limit($blog->title, 50) }}</span>
                                <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $blog->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info px-2 py-1"><i class="fas fa-tag mr-1 small"></i>{{ $blog->category_name }}</span>
                            </td>
                            <td class="text-center">
                                @if($blog->is_active)
                                    <span class="badge badge-success px-3 py-2" style="border-radius: 50px;">
                                        <i class="fas fa-check-circle mr-1"></i> Hiển thị
                                    </span>
                                @else
                                    <span class="badge badge-danger px-3 py-2" style="border-radius: 50px;">
                                        <i class="fas fa-eye-slash mr-1"></i> Đã ẩn
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning mr-1 shadow-sm" title="Sửa bài viết">
                                        <i class="fas fa-pencil-alt text-white"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('⚠️ Chú ý: Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Xóa bài viết">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Không tìm thấy bài viết nào phù hợp.</p>
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">Thêm bài viết đầu tiên</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 4. Phân trang --}}
            @if($blogs->hasPages())
            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Hiển thị từ {{ $blogs->firstItem() }} đến {{ $blogs->lastItem() }} trên tổng số {{ $blogs->total() }} bài viết
                    </div>
                    <div>
                        {{ $blogs->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop

@section('css')
<style>
    /* Bo tròn bảng và các thẻ con */
    .card { border-radius: 12px; }
    .table thead th { border-top: 0; border-bottom: 2px solid #dee2e6; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; }
    .table tbody td { vertical-align: middle !important; }
    .badge { font-weight: 500; font-size: 11px; }
    .btn-sm { border-radius: 6px; padding: 5px 10px; }
    .pagination { margin-bottom: 0; }
    /* Hover Row Effect */
    .table-hover tbody tr:hover { background-color: rgba(0,123,255,.05); }
    /* Thumbnail Styling */
    .img-thumbnail { border: none; padding: 0; }
</style>
@stop