<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // 繼承自 Authenticatable
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // 繼承自 Authenticatable 來支援 Auth
{
    use Notifiable; // 使其具備通知功能

    protected $table = 'users'; // 對應資料表名稱
    protected $primaryKey = 'user_id'; // 指定主鍵

    // 可批量賦值的欄位
    protected $fillable = [
        'email',
        'user_name',
        'phone',
        'password',
        'salt',
    ];

    // 隱藏的屬性 (例如密碼和鹽值，不會出現在 JSON 輸出中)
    protected $hidden = [
        'password',
        'salt',
    ];
}
