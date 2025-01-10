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
        // 設置 'orders' 表中的外鍵
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('order_status_id')->references('order_status_id')->on('order_statuses')->onDelete('cascade');
        });

        // 設置 'order_items' 表中的外鍵
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 刪除 'orders' 表中的外鍵
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['order_status_id']);
        });

        // 刪除 'order_items' 表中的外鍵
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
