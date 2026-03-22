<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clients\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Mảng các danh mục tự định nghĩa
        $categories = ['Khám phá mạo hiểm', 'Leo núi & Trekking', 'Tour gia đình', 'Du lịch biển'];

        // Tạo 10 bài viết mẫu
        for ($i = 1; $i <= 10; $i++) {
            $title = "Cẩm nang du lịch cho kỳ nghỉ mơ ước của bạn - Phần $i";
            
            Blog::create([
                'category_name' => $categories[array_rand($categories)], // Lấy ngẫu nhiên 1 tên danh mục
                'title' => $title,
                'slug' => Str::slug($title),
                'image' => 'clients/assets/images/blog/blog-list1.jpg',
                'description' => 'Đây là đoạn mô tả ngắn gọn cho bài viết số ' . $i . ', giúp khách hàng có cái nhìn tổng quan trước khi bấm vào xem chi tiết...',
                'content' => 'Nội dung chi tiết của bài viết sẽ nằm ở đây...',
                'is_active' => 1,
            ]);
        }
    }
}