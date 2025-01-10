<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
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
