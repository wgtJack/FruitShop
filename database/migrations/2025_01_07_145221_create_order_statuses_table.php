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
        // 訂單狀態
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id('order_status_id'); // 訂單狀態編號
            $table->string('status_name'); // 訂單狀態名稱
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
