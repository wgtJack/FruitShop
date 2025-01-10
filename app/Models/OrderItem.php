<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items'; // 對應資料表名稱
    public $timestamps = false; // 關閉時間戳，因為表中無時間欄位

    // 可批量賦值的欄位
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    // 一個訂單項目屬於一個訂單
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // 一個訂單項目對應一個產品
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
