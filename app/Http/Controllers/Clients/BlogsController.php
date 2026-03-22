<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clients\Blog;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    /**
     * ==============================
     * DANH SÁCH BLOG
     * ==============================
     */
    public function index(Request $request)
    {
        $query = Blog::where('is_active', 1);
        

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // 📂 FILTER CATEGORY
        if ($request->filled('category')) {
            $query->where('category_name', $request->category);
        }

        // 🔽 SORT
        if ($request->sort === 'oldest') {
            $query->oldest();
        } elseif ($request->sort === 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->latest();
        }

        // 📄 PAGINATION + giữ query
        $blogs = $query->paginate(6)->withQueryString();

        // 🆕 BÀI MỚI
        $recentNews = Blog::where('is_active', 1)
            ->latest()
            ->take(5)
            ->get();

        // 📊 DANH MỤC + ĐẾM
        $categories = Blog::where('is_active', 1)
            ->select('category_name', DB::raw('count(*) as total'))
            ->groupBy('category_name')
            ->orderBy('total', 'desc')
            ->get();

        // 🔥 HOT POSTS
        $hotBlogs = Blog::where('is_active', 1)
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();
$blogs = $query->paginate(6)->withQueryString();
        return view('Clients.blogs.index', compact(
            'blogs',
            'recentNews',
            'categories',
            'hotBlogs'
        ));
    }

    /**
     * ==============================
     * CHI TIẾT BLOG
     * ==============================
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        // 👁️ TĂNG VIEW
        $blog->increment('views');

        // 🔗 RELATED POSTS
        $relatedBlogs = Blog::where('category_name', $blog->category_name)
            ->where('id', '!=', $blog->id)
            ->where('is_active', 1)
            ->take(4)
            ->get();

        // 🆕 RECENT
        $recentNews = Blog::where('is_active', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('Clients.blogs.detail', compact(
            'blog',
            'relatedBlogs',
            'recentNews'
        ));
    }

    /**
     * ==============================
     * API SEARCH (AJAX)
     * ==============================
     */
    public function search(Request $request)
    {
        $blogs = Blog::where('is_active', 1)
            ->where('title', 'LIKE', '%' . $request->search . '%')
            ->latest()
            ->take(10)
            ->get();

        return response()->json($blogs);
    }
}