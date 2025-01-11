<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 引入 DB 類

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 插入 order_statuses 資料
        DB::table('order_statuses')->insert([
            ['status_name' => '店家已收到訂單'],
            ['status_name' => '配送中'],
            ['status_name' => '完成交易'],
            ['status_name' => '訂單取消'],
        ]);

        // 插入 admins 資料
        DB::table('admins')->insert([
            [
                'account' => 'admin1234',
                'name' => 'Admin-User-2',
                'password' => '$2y$12$YDBuJ6H6JqxCwRveDjE/YuGaLgIPDVGRpHgZs7LzSWReXGoUPn4Di',
                'salt' => '677ff293e7747',
            ],
        ]);
    }
}
