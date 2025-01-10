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
        // 管理者
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id'); // 管理者編號
            $table->string('account'); // 管理者帳號
            $table->string('name'); // 理者帳名稱
            $table->string('password'); // 密碼
            $table->string('salt'); // 鹽巴
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
