<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // 對應資料表名稱
    protected $primaryKey = 'order_id'; // 指定主鍵
    public $timestamps = true; // 啟用時間戳

    // 可批量賦值的欄位
    protected $fillable = [
        'user_id',
        'total_amount',
        'order_status_id',
        'address',
    ];

    // 一個訂單有多個訂單項目
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
