<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable; // 提供通知功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 基礎用戶認證類

class Admin extends Authenticatable
{
    use Notifiable; // 引入通知功能的 Trait
    use HasFactory;

    protected $table = 'admins'; // 資料表名稱
    protected $primaryKey = 'admin_id'; // 指定主鍵
    public $timestamps = false; // 禁用時間戳記功能

    // 可批量賦值的欄位
    protected $fillable = [
        'account',
        'name',
        'password',
        'salt',
    ];

    // 隱藏的屬性 (例如密碼和鹽值，不會出現在 JSON 輸出中)
    protected $hidden = [
        'password',
        'salt',
    ];
}
