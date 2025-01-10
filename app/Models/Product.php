<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // 資料表名稱
    protected $primaryKey = 'product_id'; // 指定主鍵

    // 可批量賦值的欄位
    protected $fillable = [
        'product_name',
        'image_path',
        'price',
        'description',
    ];
}
