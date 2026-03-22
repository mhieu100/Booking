<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        
        // Cột này sẽ đóng vai trò lưu tên Danh mục (xử lý luôn phần Category)
        $table->string('category_name')->default('Du lịch'); 
        
        // Các thông tin của bài Blog
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('image')->nullable(); 
        $table->text('description')->nullable(); 
        $table->longText('content')->nullable(); 
        $table->boolean('is_active')->default(1); 
        
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
