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
        // 使用者
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // 使用者編號
            $table->string('email')->unique(); // 電子郵件
            $table->string('user_name'); // 使用者名稱
            $table->string('phone'); // 手機
            $table->string('password'); // 密碼
            $table->string('salt'); // 鹽巴
            $table->timestamps(); // 創建時間和更新時間
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
