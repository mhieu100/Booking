<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Clients\Blog; 
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    // ==========================================
    // 1. HIỂN THỊ DANH SÁCH & TÌM KIẾM
    // ==========================================
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('id', 'like', '%' . $keyword . '%')
                  ->orWhere('title', 'like', '%' . $keyword . '%')
                  ->orWhere('category_name', 'like', '%' . $keyword . '%');
            });
        }

        $blogs = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    // ==========================================
    // 2. AJAX: LẤY DANH MỤC TỪ BẢNG BLOGS (DISTINCT)
    // ==========================================
    public function getCategories()
    {
        // Lấy tất cả tên danh mục duy nhất đang tồn tại trong bảng blogs
        $categories = Blog::select('category_name')
            ->distinct()
            ->whereNotNull('category_name')
            ->pluck('category_name');
            
        return response()->json($categories);
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    // ==========================================
    // 3. XỬ LÝ LƯU BÀI VIẾT
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|max:255',
            'slug'          => 'required|unique:blogs,slug',
            'category_name' => 'required', // Nhận từ Select2 (có thể là tag mới)
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content'       => 'required'
        ]);

        $blog = new Blog();
        $blog->title         = $request->title;
        $blog->slug          = $request->slug;
        $blog->description   = $request->description;
        $blog->content       = $request->content;
        $blog->category_name = $request->category_name;
        $blog->is_active = $request->input('is_active', 0);
        $blog->views         = 0;

        // Xử lý Ảnh đại diện (Thumbnail)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_thumb_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('clients/assets/images/blog'), $filename);
            $blog->image = 'clients/assets/images/blog/' . $filename;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Đã xuất bản bài viết mới thành công!');
    }

    // ==========================================
    // 4. XỬ LÝ UPLOAD ẢNH TỪ CKEDITOR
    // ==========================================
    public function uploadImage(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_content_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('clients/assets/images/blog_content'), $filename);
            $url = asset('clients/assets/images/blog_content/' . $filename);

            return response()->json([
                'uploaded' => true,
                'url'      => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    // ==========================================
    // 5. CẬP NHẬT BÀI VIẾT
    // ==========================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|max:255',
            'slug'          => 'required|unique:blogs,slug,' . $id,
            'category_name' => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title         = $request->title;
        $blog->slug          = $request->slug;
        $blog->description   = $request->description;
        $blog->content       = $request->content;
        $blog->category_name = $request->category_name;
        $blog->is_active     = $request->input('is_active');

        // Cập nhật ảnh đại diện & xóa file cũ
        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $file = $request->file('image');
            $filename = time() . '_thumb_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('clients/assets/images/blog'), $filename);
            $blog->image = 'clients/assets/images/blog/' . $filename;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // ==========================================
    // 6. XÓA BÀI VIẾT & DỌN DẸP FILE
    // ==========================================
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Xóa ảnh đại diện vật lý
        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        // Lưu ý: Ảnh trong nội dung CKEditor (blog_content) thường được giữ lại 
        // để tránh "ảnh chết" nếu bạn dùng lại nội dung ở các trang khác.

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Đã xóa bài viết vĩnh viễn!');
    }
}