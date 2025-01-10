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
        Schema::create('order_items', function (Blueprint $table) {
            // 訂單項目
            $table->foreignId('order_id'); // 訂單編號
            $table->foreignId('product_id'); // 產品編號
            $table->unsignedInteger('quantity'); // 數量
        
            // 設置複合主鍵
            $table->primary(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
