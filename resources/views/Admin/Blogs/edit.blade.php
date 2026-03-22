@extends('adminlte::page')

@section('title', 'Chỉnh sửa bài viết | ' . $blog->title)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark font-weight-bold">
                <i class="fas fa-edit text-primary mr-2"></i>CẬP NHẬT BÀI VIẾT
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Admin</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="form-blog">
    @csrf
    @method('PUT')
    
    {{-- 1. STICKY ACTION BAR --}}
    <div class="sticky-action-bar shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="text-muted small d-none d-md-block">
                <i class="fas fa-history mr-1"></i> Cập nhật lần cuối: <strong>{{ $blog->updated_at->format('d/m/Y H:i') }}</strong>
            </div>
            <div class="actions">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary mr-2 btn-flat">Hủy</a>
                <button type="submit" class="btn btn-primary shadow-sm btn-flat font-weight-bold">
                    <i class="fas fa-save mr-1"></i> LƯU THAY ĐỔI
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        {{-- ================= CỘT TRÁI: NỘI DUNG & SEO ================= --}}
        <div class="col-lg-8 col-md-12">
            <div class="card card-outline card-primary shadow-lg border-0">
                <div class="card-body">
                    {{-- Tiêu đề --}}
                    <div class="form-group mb-4">
                        <label class="h5 font-weight-bold text-dark">Tiêu đề bài viết <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg border-0 shadow-none bg-light" 
                               value="{{ old('title', $blog->title) }}" required style="font-size: 1.6rem; font-weight: 700;">
                        @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    {{-- Đường dẫn (Slug) - Mặc định khóa để tránh hỏng SEO --}}
                    <div class="form-group mb-4 bg-light p-2 rounded border-left border-primary shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="small font-weight-bold text-uppercase text-muted mb-0">URL Slug (Đường dẫn tĩnh)</label>
                            <button type="button" class="btn btn-xs btn-link text-primary font-weight-bold" id="btn-edit-slug">
                                <i class="fas fa-lock" id="slug-lock-icon"></i> CHỈNH SỬA
                            </button>
                        </div>
                        <div class="d-flex align-items-center mt-1">
                            <span class="text-muted mr-1 small">{{ url('/blog') }}/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}" class="form-control form-control-sm border-0 bg-transparent p-0 font-weight-bold text-primary" readonly required>
                        </div>
                    </div>

                    {{-- Soạn thảo nội dung --}}
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <label class="h6 font-weight-bold mb-0"><i class="fas fa-edit mr-1"></i> Nội dung chi tiết</label>
                            <div class="editor-stats text-muted small">
                                <span class="mr-2"><i class="fas fa-font"></i> <span id="word-count">0</span> chữ</span>
                                <span><i class="fas fa-clock"></i> <span id="reading-time">0</span> phút đọc</span>
                            </div>
                        </div>
                        <textarea name="content" id="editor">{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SEO PREVIEW --}}
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold text-muted text-uppercase small"><i class="fab fa-google text-success mr-2"></i>Xem trước kết quả tìm kiếm Google</h3>
                </div>
                <div class="card-body">
                    <div class="google-preview-box mb-4">
                        <div class="google-url">{{ url('/') }}/blog/<span id="google-slug">{{ $blog->slug }}</span></div>
                        <div class="google-title" id="google-title">{{ $blog->title }}</div>
                        <div class="google-desc" id="google-desc">{{ $blog->description ?? 'Chưa có mô tả...' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold text-uppercase text-muted">Mô tả SEO (Meta Description)</label>
                        <textarea name="description" id="description" class="form-control border-0 bg-light" rows="3" maxlength="160">{{ old('description', $blog->description) }}</textarea>
                        <div class="progress progress-xxs mt-2">
                            <div id="desc-progress" class="progress-bar bg-success" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= CỘT PHẢI: TÙY CHỌN ================= --}}
        <div class="col-lg-4 col-md-12">
            {{-- XUẤT BẢN --}}
            <div class="card shadow-lg border-0 card-primary card-outline">
                <div class="card-header"><h3 class="card-title font-weight-bold small text-uppercase">Cài đặt</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="is_active" class="form-control border-0 bg-light">
                            <option value="1" {{ $blog->is_active == 1 ? 'selected' : '' }}>🟢 Công khai (Public)</option>
                            <option value="0" {{ $blog->is_active == 0 ? 'selected' : '' }}>🟡 Bản nháp (Draft)</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label>Lượt xem (Views)</label>
                        <input type="number" class="form-control border-0 bg-light" value="{{ $blog->views }}" readonly>
                    </div>
                    <hr>
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="mb-0">Danh mục bài viết <span class="text-danger">*</span></label>
                            <button type="button" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#modalCategory">
                                <i class="fas fa-cog"></i> QUẢN LÝ
                            </button>
                        </div>
                        <select name="category_name" id="category_select" class="form-control select2 shadow-none" required>
                            {{-- AJAX Load --}}
                        </select>
                    </div>
                </div>
            </div>

            {{-- ẢNH ĐẠI DIỆN --}}
            <div class="card shadow-lg border-0 card-warning card-outline">
                <div class="card-header"><h3 class="card-title font-weight-bold small text-uppercase">Ảnh đại diện</h3></div>
                <div class="card-body text-center">
                    <div class="image-upload-wrapper {{ $blog->image ? 'has-image' : '' }}" onclick="document.getElementById('customFile').click()">
                        @if($blog->image)
                            <img id="imagePreview" src="{{ asset($blog->image) }}" style="width:100%; border-radius:12px;">
                            <div id="imagePlaceholder" style="display:none;">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                                <p class="text-muted font-weight-bold mb-0">Tải ảnh mới</p>
                            </div>
                        @else
                            <img id="imagePreview" src="" style="display:none; width:100%; border-radius:12px;">
                            <div id="imagePlaceholder">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-2"></i>
                                <p class="text-muted font-weight-bold mb-0">Tải ảnh đại diện</p>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="image" id="customFile" class="d-none" accept="image/*" onchange="previewImage(event)">
                    <button type="button" id="btn-remove-img" class="btn btn-sm btn-outline-danger btn-block mt-3" style="{{ $blog->image ? '' : 'display:none;' }}" onclick="removeImage()">
                        <i class="fas fa-trash mr-1"></i> Thay đổi ảnh
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- MODAL QUẢN LÝ DANH MỤC --}}
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h6 class="modal-title font-weight-bold">Quản lý nhanh</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3 text-sm">
                    <input type="text" id="new_category_input" class="form-control border-0 bg-light" placeholder="Danh mục mới...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="btn_add_category_quick">THÊM</button>
                    </div>
                </div>
                <small class="text-muted font-weight-bold text-uppercase d-block mb-2">Danh sách hiện tại</small>
                <ul class="list-group list-group-flush border-top" id="category_list_manage" style="max-height: 200px; overflow-y: auto;">
                    {{-- Load qua AJAX --}}
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .sticky-action-bar { position: sticky; top: 0; z-index: 1030; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 12px 20px; margin: -15px -7.5px 20px -7.5px; border-bottom: 1px solid #eee; }
    .ck-editor__editable_inline { min-height: 500px; border: none !important; }
    .google-preview-box { border: 1px solid #ddd; border-radius: 8px; padding: 15px; max-width: 600px; }
    .google-url { color: #202124; font-size: 14px; }
    .google-title { color: #1a0dab; font-size: 20px; }
    .google-desc { color: #4d5156; font-size: 14px; }
    .image-upload-wrapper { border: 2px dashed #ccc; padding: 20px; border-radius: 12px; cursor: pointer; background: #f9f9f9; transition: 0.3s; }
    .image-upload-wrapper:hover { border-color: #007bff; background: #f0f7ff; }
    .image-upload-wrapper img { transition: 0.3s; }
    .select2-container--default .select2-selection--single { border: 0 !important; background: #f8f9fa !important; height: 38px !important; }
</style>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
$(document).ready(function() {
    // 1. CKEDITOR 5
    ClassicEditor.create(document.querySelector('#editor'), {
        ckfinder: { uploadUrl: '{{ route("admin.blogs.upload", ["_token" => csrf_token()]) }}' }
    }).then(editor => {
        const updateStats = () => {
            const content = editor.getData().replace(/<[^>]*>/g, '');
            const words = content.trim().split(/\s+/).filter(w => w.length > 0).length;
            $('#word-count').text(words);
            $('#reading-time').text(Math.ceil(words / 200));
        };
        updateStats(); // Chạy khi load
        editor.model.document.on('change:data', updateStats);
    });

    // 2. LOAD CATEGORIES & SELECT CURRENT
    function loadCategories() {
        $.get('{{ route("admin.categories.get") }}', function(data) {
            let select = $('#category_select');
            let manageList = $('#category_list_manage');
            let currentCat = "{{ $blog->category_name }}"; // Danh mục hiện tại của bài viết
            
            select.empty().append('<option value="" disabled>-- Chọn danh mục --</option>');
            manageList.empty();

            data.forEach(catName => {
                let isSelected = (catName === currentCat) ? 'selected' : '';
                select.append(`<option value="${catName}" ${isSelected}>${catName}</option>`);
                
                manageList.append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-bottom">
                        <span class="text-sm font-weight-bold">${catName}</span>
                        <button type="button" class="btn btn-xs text-danger btn-delete-cat" data-name="${catName}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </li>
                `);
            });
        });
    }
    loadCategories();

    // 3. THÊM NHANH DANH MỤC
    $('#btn_add_category_quick').click(function() {
        let name = $('#new_category_input').val().trim();
        if(!name) return;
        let newOption = new Option(name, name, true, true);
        $('#category_select').append(newOption).trigger('change');
        $('#new_category_input').val('');
        $('#modalCategory').modal('hide');
    });

    // 4. XÓA DANH MỤC
    $(document).on('click', '.btn-delete-cat', function() {
        let name = $(this).data('name');
        if(confirm(`Xóa danh mục "${name}"? Các bài viết sẽ chuyển về "Chưa phân loại".`)) {
            $.post('{{ route("admin.categories.delete") }}', { _token: '{{ csrf_token() }}', name: name }, function() {
                loadCategories();
            });
        }
    });

    // 5. SLUG & SEO
    $('#title').on('input', function() {
        let title = $(this).val();
        $('#google-title').text(title || 'Tiêu đề bài viết...');
        if ($('#slug-lock-icon').hasClass('fa-unlock')) { // Chỉ đổi slug khi đã mở khóa
            let slug = createSlug(title);
            $('#slug, #google-slug').val(slug).text(slug);
        }
    });

    $('#btn-edit-slug').click(function() {
        let lock = $('#slug-lock-icon');
        let input = $('#slug');
        if (lock.hasClass('fa-lock')) {
            if(confirm('Cảnh báo: Đổi URL bài viết cũ có thể làm mất lượt truy cập từ Google (lỗi 404). Bạn chắc chắn chứ?')) {
                lock.removeClass('fa-lock text-primary').addClass('fa-unlock text-danger');
                input.prop('readonly', false).focus();
            }
        } else {
            lock.removeClass('fa-unlock text-danger').addClass('fa-lock text-primary');
            input.prop('readonly', true);
        }
    });

    $('#description').on('input', function() {
        let text = $(this).val();
        $('#google-desc').text(text || 'Mô tả Meta SEO...');
        $('#desc-progress').css('width', Math.min((text.length / 160) * 100, 100) + '%');
    });
    
    // Khởi tạo progress bar ban đầu
    $('#desc-progress').css('width', Math.min(($('#description').val().length / 160) * 100, 100) + '%');
});

function createSlug(str) {
    str = str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").replace(/[đĐ]/g, 'd');
    return str.replace(/([^0-9a-z-\s])/g, '').replace(/(\s+)/g, '-').replace(/-+/g, '-').replace(/^-+|-+$/g, '');
}

function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function() {
        $('#imagePreview').attr('src', reader.result).show();
        $('#imagePlaceholder').hide();
        $('#btn-remove-img').show();
    }
    reader.readAsDataURL(event.target.files[0]);
}

function removeImage() {
    $('#customFile').val("");
    $('#imagePreview').hide();
    $('#imagePlaceholder').show();
    $('#btn-remove-img').hide();
}
</script>
@stop