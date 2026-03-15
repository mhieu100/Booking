@extends('adminlte::page')

@section('title', 'Cập nhật Tour')

@section('content_header')
    <h1>Cập nhật Tour: #{{ $tour->tourid }}</h1>
@stop

@section('content')
<div class="card card-warning shadow">
    <div class="card-header">
        <h3 class="card-title text-bold">Chỉnh sửa thông tin chi tiết</h3>
    </div>
    
    <form id="tour-form" action="{{ route('admin.tours.update', $tour->tourid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Tên Tour (*)</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $tour->title) }}" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Điểm đến</label>
                                <input type="text" name="destination" class="form-control" value="{{ old('destination', $tour->destination) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vùng miền (*)</label>
                                <select name="domain" class="form-control" required>
                                    <option value="b" {{ old('domain', $tour->domain) == 'b' ? 'selected' : '' }}>Miền Bắc</option>
                                    <option value="t" {{ old('domain', $tour->domain) == 't' ? 'selected' : '' }}>Miền Trung</option>
                                    <option value="n" {{ old('domain', $tour->domain) == 'n' ? 'selected' : '' }}>Miền Nam</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Mô tả tổng quan</label>
                        <textarea name="description" id="editor" class="form-control">{{ old('description', $tour->description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title text-bold"><i class="fas fa-images"></i> Quản lý hình ảnh</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <label class="text-danger">1. Ảnh chính (Thumbnail) (*)</label>
                                
                                <div class="mb-3 p-2 border rounded bg-light">
                                    <label class="d-block text-muted small mb-2">Ảnh đang dùng:</label>
                                    @if($tour->images)
                                        <img src="{{ asset('clients/assets/images/gallery-tours/' . $tour->images) }}" alt="Ảnh chính" style="height: 100px; object-fit: cover; border-radius: 5px; border: 1px solid #ccc;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image"></i> Chưa có ảnh chính</span>
                                    @endif
                                </div>

                                <label class="small text-info">Chọn ảnh khác để thay thế (Bỏ qua nếu giữ nguyên):</label>
                                <input type="file" name="image_main" id="main-image-input" class="form-control-file" accept="image/*">
                                
                                <div id="main-image-preview" class="mt-2" style="display: none;">
                                    <span class="badge badge-warning">Ảnh sẽ thay thế</span><br>
                                    <img src="" class="img-thumbnail border-warning mt-1" style="height: 100px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="form-group border-top pt-3">
                                <label class="text-info">2. Ảnh chi tiết (Gallery)</label>
                                
                                <div class="mb-3 p-2 border rounded bg-light">
                                    <label class="d-block text-muted small mb-2">Các ảnh cũ (Bấm <i class="fas fa-times text-danger"></i> để xóa):</label>
                                    @if(isset($tour->tourImages) && $tour->tourImages->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($tour->tourImages as $img)
                                                <div class="old-image-wrapper position-relative mr-2 mb-2">
                                                    <img src="{{ asset('clients/assets/images/gallery-tours/' . $img->imageurl) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 3px; border: 1px solid #ccc;">
                                                    <button type="button" class="btn btn-danger btn-xs position-absolute" 
                                                            style="top: -5px; right: -5px; border-radius: 50%; width: 20px; height: 20px; padding: 0;"
                                                            onclick="removeOldImage({{ $img->imageid }}, this)" title="Xóa ảnh này">
                                                        <i class="fas fa-times" style="font-size: 10px;"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0"><small><i>Chưa có ảnh chi tiết nào.</i></small></p>
                                    @endif
                                </div>

                                <label class="small text-success">Chọn thêm ảnh mới (Tối đa 5 ảnh):</label>
                                <input type="file" name="image_gallery[]" id="gallery-image-input" class="form-control-file" accept="image/*" multiple>
                                
                                <div id="gallery-image-preview" class="d-flex flex-wrap mt-2 gap-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Thời lượng (Duration)</label>
                        <input type="text" name="time" class="form-control" value="{{ old('time', $tour->time) }}" placeholder="VD: Khởi hành thứ 7">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Text phụ (Time)</label>
                        <input type="text" name="duration" class="form-control" value="{{ old('duration', $tour->duration) }}" placeholder="VD: 3N2Đ">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Giá người lớn (VNĐ) (*)</label>
                        <input type="number" name="priceadult" class="form-control" value="{{ old('priceadult', $tour->priceadult) }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Giá trẻ em (VNĐ)</label>
                        <input type="number" name="pricechild" class="form-control" value="{{ old('pricechild', $tour->pricechild) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Số chỗ</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $tour->quantity) }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="availability" class="form-control">
                            <option value="1" {{ old('availability', $tour->availability) == 1 ? 'selected' : '' }}>Mở bán</option>
                            <option value="0" {{ old('availability', $tour->availability) == 0 ? 'selected' : '' }}>Tạm ngưng</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ngày đi</label>
                        <input type="date" name="startdate" class="form-control" value="{{ old('startdate', $tour->startdate) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ngày về</label>
                        <input type="date" name="enddate" class="form-control" value="{{ old('enddate', $tour->enddate) }}">
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <h4 class="text-info m-0"><i class="fas fa-calendar-alt"></i> Lịch trình chi tiết</h4>
                <button type="button" class="btn btn-sm btn-success shadow-sm" onclick="addTimeline()">
                    <i class="fas fa-plus"></i> Thêm ngày mới
                </button>
            </div>
            
            <div class="accordion" id="timeline-wrapper">
                @if(isset($tour->timeline) && count($tour->timeline) > 0)
                    @foreach($tour->timeline as $index => $item)
                        <div class="card card-outline card-secondary mb-2 timeline-item">
                            <div class="card-header p-2" id="heading-{{ $index }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-link text-left text-dark font-weight-bold flex-grow-1 text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}">
                                        <i class="fas fa-angle-down mr-2 text-muted"></i> 
                                        Ngày <span class="day-number">{{ $index + 1 }}</span>: 
                                        <span class="preview-title text-primary">{{ $item->title }}</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removeTimeline(this)" title="Xóa ngày này">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="collapse-{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}" data-parent="#timeline-wrapper">
                                <div class="card-body bg-light">
                                    <div class="form-group">
                                        <label>Tiêu đề ngày</label>
                                        <input type="text" name="timeline_title[]" class="form-control title-input" value="{{ $item->title }}" placeholder="Ví dụ: Hà Nội → Hạ Long" required onkeyup="updatePreviewTitle(this)">
                                    </div>
                                    
                                    <div class="form-group mb-0">
                                        <label>Mô tả chi tiết ngày</label>
                                        <textarea name="timeline_description[]" class="form-control" rows="4">{{ $item->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Khung trống mặc định nếu chưa có lịch trình --}}
                    <div class="card card-outline card-secondary mb-2 timeline-item">
                        <div class="card-header p-2" id="heading-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-link text-left text-dark font-weight-bold flex-grow-1 text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse-0" aria-expanded="true">
                                    <i class="fas fa-angle-down mr-2 text-muted"></i> 
                                    Ngày <span class="day-number">1</span>: 
                                    <span class="preview-title text-primary">Tiêu đề...</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removeTimeline(this)" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <div id="collapse-0" class="collapse show" data-parent="#timeline-wrapper">
                            <div class="card-body bg-light">
                                <div class="form-group">
                                    <label>Tiêu đề ngày</label>
                                    <input type="text" name="timeline_title[]" class="form-control title-input" placeholder="Ví dụ: Hà Nội → Hạ Long" onkeyup="updatePreviewTitle(this)">
                                </div>
                                
                                <div class="form-group mb-0">
                                    <label>Mô tả chi tiết ngày</label>
                                    <textarea name="timeline_description[]" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            </div>

        <div class="card-footer bg-white text-right">
            <a href="{{ route('admin.tours.index') }}" class="btn btn-default mr-2 btn-lg">Hủy bỏ</a>
            <button type="submit" class="btn btn-warning btn-lg shadow"><i class="fas fa-save"></i> CẬP NHẬT LẠI DỮ LIỆU</button>
        </div>
    </form>
</div>
@stop

@section('css')
    <style>
        .ck-editor__editable_inline { min-height: 250px; }
        .btn-link:hover, .btn-link:focus { text-decoration: none; }
        .accordion .card-header button[aria-expanded="true"] i.fa-angle-down {
            transform: rotate(180deg);
            transition: transform 0.3s;
        }
        .accordion .card-header button[aria-expanded="false"] i.fa-angle-down {
            transition: transform 0.3s;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // 1. Khởi tạo CKEditor
        ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });

        // 2. XÓA ẢNH CŨ
        function removeOldImage(imageId, btnElement) {
            if(confirm('Bạn có chắc muốn xóa ảnh này? Ảnh sẽ chính thức bị xóa khi bạn bấm nút "Cập Nhật Lại".')) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_images[]';
                input.value = imageId;
                document.getElementById('tour-form').appendChild(input);
                btnElement.closest('.old-image-wrapper').style.display = 'none';
            }
        }

        // 3. Preview Ảnh Chính Mới
        const mainInput = document.getElementById('main-image-input');
        const mainPreview = document.getElementById('main-image-preview');

        mainInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    mainPreview.querySelector('img').src = event.target.result;
                    mainPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                mainPreview.style.display = 'none';
            }
        });

        // 4. Preview Ảnh Gallery Mới
        const galleryInput = document.getElementById('gallery-image-input');
        const galleryPreview = document.getElementById('gallery-image-preview');

        galleryInput.addEventListener('change', function(e) {
            galleryPreview.innerHTML = ''; 
            const files = Array.from(e.target.files);
            
            if (files.length > 5) {
                alert("Chỉ được tải thêm tối đa 5 ảnh chi tiết 1 lần.");
            }

            const limitFiles = files.slice(0, 5); 
            limitFiles.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgBox = document.createElement('div');
                    imgBox.className = 'mr-2 mb-2';
                    imgBox.innerHTML = `<span class="badge badge-success d-block mb-1">Mới</span><img src="${event.target.result}" class="img-thumbnail border-success" style="height: 60px; width: 60px; object-fit: cover; border-radius: 5px;">`;
                    galleryPreview.appendChild(imgBox);
                }
                reader.readAsDataURL(file);
            });
        });

        // 5. THÊM LỊCH TRÌNH MỚI (ACCORDION)
        function addTimeline() {
            const wrapper = document.getElementById('timeline-wrapper');
            const count = wrapper.querySelectorAll('.timeline-item').length + 1;
            const uniqueId = Date.now(); 

            const html = `
            <div class="card card-outline card-secondary mb-2 timeline-item">
                <div class="card-header p-2" id="heading-${uniqueId}">
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-link text-left text-dark font-weight-bold flex-grow-1 text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse-${uniqueId}" aria-expanded="true">
                            <i class="fas fa-angle-down mr-2 text-muted"></i> 
                            Ngày <span class="day-number">${count}</span>: 
                            <span class="preview-title text-primary">Tiêu đề mới...</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removeTimeline(this)" title="Xóa ngày này">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div id="collapse-${uniqueId}" class="collapse show" data-parent="#timeline-wrapper">
                    <div class="card-body bg-light">
                        <div class="form-group">
                            <label>Tiêu đề ngày</label>
                            <input type="text" name="timeline_title[]" class="form-control title-input" placeholder="Ví dụ: Hà Nội → Hạ Long" onkeyup="updatePreviewTitle(this)" required>
                        </div>
                        
                        <div class="form-group mb-0">
                            <label>Mô tả chi tiết</label>
                            <textarea name="timeline_description[]" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>`;
            
            wrapper.insertAdjacentHTML('beforeend', html);
            reindexDays(); 
        }

        // 6. XÓA LỊCH TRÌNH
        function removeTimeline(btn) {
            if(confirm('Bạn có chắc chắn muốn xóa ngày này khỏi lịch trình?')) {
                btn.closest('.timeline-item').remove();
                reindexDays(); 
            }
        }

        // 7. CẬP NHẬT PREVIEW TITLE
        function updatePreviewTitle(input) {
            const previewSpan = input.closest('.timeline-item').querySelector('.preview-title');
            previewSpan.textContent = input.value ? input.value : 'Đang cập nhật...';
        }

        // 8. ĐÁNH SỐ THỨ TỰ LẠI
        function reindexDays() {
            const items = document.querySelectorAll('.timeline-item');
            items.forEach((item, index) => {
                item.querySelector('.day-number').textContent = index + 1;
            });
        }
    </script>
@stop