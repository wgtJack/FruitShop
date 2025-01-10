<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 產品
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id'); // 產品編號
            $table->string('product_name'); // 產品名稱
            $table->string('image_path'); // 圖片路徑
            $table->unsignedInteger('price'); // 產品價格
            $table->text('description'); // 產品簡介
            $table->timestamps(); // 創建時間和更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
