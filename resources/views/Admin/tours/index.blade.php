@extends('adminlte::page')

@section('title', 'Quản lý Tour')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-map-marked-alt text-primary mr-2"></i>Danh Sách Tour</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle"></i> Thêm Tour Mới
            </a>
        </div>
    </div>
@stop

@section('content')

    {{-- Hiển thị thông báo (Success / Error) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Bộ lọc tìm kiếm --}}
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Bộ lọc & Tìm kiếm</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('admin.tours.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="Nhập ID, tên tour hoặc điểm đến..." value="{{ request('keyword') }}">
                    </div>
                    
                    <div class="col-md-3 mb-2">
                        <select name="domain" class="form-control">
                            <option value="">-- Tất cả vùng miền --</option>
                            <option value="b" {{ request('domain') == 'b' ? 'selected' : '' }}>Miền Bắc</option>
                            <option value="t" {{ request('domain') == 't' ? 'selected' : '' }}>Miền Trung</option>
                            <option value="n" {{ request('domain') == 'n' ? 'selected' : '' }}>Miền Nam</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <select name="availability" class="form-control">
                            <option value="">-- Tất cả trạng thái --</option>
                            <option value="1" {{ request('availability') == '1' ? 'selected' : '' }}>Đang mở bán</option>
                            <option value="0" {{ request('availability') == '0' ? 'selected' : '' }}>Đang tạm ngưng</option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-info w-100 mb-1"><i class="fas fa-search"></i> Tìm</button>
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-default w-100 btn-sm"><i class="fas fa-sync"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bảng dữ liệu --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" width="5%">ID</th>
                            <th class="text-center" width="10%">Hình ảnh</th>
                            <th width="35%">Thông tin Tour</th>
                            <th class="text-right" width="15%">Giá (VNĐ)</th>
                            <th class="text-center" width="15%">Trạng thái</th>
                            <th class="text-center" width="15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tours as $tour)
                        <tr>
                            <td class="text-center align-middle"><strong>#{{ $tour->tourid }}</strong></td>
                            
                            <td class="text-center align-middle">
                                @if($tour->images)
                                    <img src="{{ asset('clients/assets/images/gallery-tours/' . $tour->images) }}" alt="Ảnh" class="img-thumbnail shadow-sm" style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">Không có ảnh</span>
                                @endif
                            </td>
                            
                            <td class="align-middle">
                                <h6 class="mb-1 font-weight-bold text-primary">{{ $tour->title }}</h6>
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-map-marker-alt text-danger"></i> Điểm đến: {{ $tour->destination }}
                                </div>
                                <div class="small">
                                    <i class="far fa-calendar-alt text-info"></i> Lịch: 
                                    {{ \Carbon\Carbon::parse($tour->startdate)->format('d/m/Y') }} 
                                    <i class="fas fa-arrow-right text-xs"></i> 
                                    {{ \Carbon\Carbon::parse($tour->enddate)->format('d/m/Y') }}
                                </div>
                                <div class="mt-1">
                                    @if($tour->domain == 'b') <span class="badge badge-success">Miền Bắc</span>
                                    @elseif($tour->domain == 't') <span class="badge badge-warning">Miền Trung</span>
                                    @elseif($tour->domain == 'n') <span class="badge badge-info">Miền Nam</span>
                                    @endif
                                    
                                    <span class="badge badge-secondary"><i class="far fa-clock"></i> {{ $tour->duration }}</span>
                                </div>
                            </td>
                            
                            <td class="text-right align-middle">
                                <div><span class="text-danger font-weight-bold">{{ number_format($tour->priceadult) }}đ</span> <small class="text-muted">/NL</small></div>
                                <div><span class="text-muted">{{ number_format($tour->pricechild) }}đ</span> <small class="text-muted">/TE</small></div>
                            </td>
                            
                            <td class="text-center align-middle">
                                @if($tour->availability == 1)
                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle"></i> Mở bán</span>
                                    <div class="small mt-1 text-muted">Còn: <b class="text-dark">{{ $tour->quantity }}</b> chỗ</div>
                                @else
                                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-ban"></i> Tạm ngưng</span>
                                @endif
                            </td>
                            
                            <td class="text-center align-middle">
                                <a href="{{ route('admin.tours.edit', $tour->tourid) }}" class="btn btn-sm btn-info shadow-sm mb-1" data-toggle="tooltip" title="Chỉnh sửa Tour">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {{-- Lưu ý: Kiểm tra route name của bạn. Thường hàm xóa trong resource controller sẽ là 'admin.tours.destroy' --}}
                                <form action="{{ route('admin.tours.delete', $tour->tourid) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa toàn bộ dữ liệu của Tour này không? Hành động này không thể hoàn tác!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm mb-1" data-toggle="tooltip" title="Xóa Tour">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-3x mb-3 text-light"></i>
                                <h5>Không tìm thấy tour nào phù hợp!</h5>
                                <p class="text-sm">Hãy thử thay đổi từ khóa hoặc bộ lọc.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Phân trang --}}
        @if($tours->hasPages())
        <div class="card-footer clearfix bg-white border-top">
            <div class="float-right">
                {{ $tours->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .table td, .table th { vertical-align: middle !important; }
        .img-thumbnail { border-radius: 6px; }
        .badge { font-size: 85%; font-weight: 500; padding: 0.35em 0.6em; }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            // Kích hoạt tooltip cho các nút
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop