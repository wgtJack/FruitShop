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
        // 訂單
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // 訂單編號
            $table->foreignId('user_id'); // 使用者編號
            $table->unsignedInteger('total_amount'); // 總金額
            $table->foreignId('order_status_id'); //訂單狀態編號
            $table->text('address'); // 運送地址
            $table->timestamps(); // 創建時間和更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
