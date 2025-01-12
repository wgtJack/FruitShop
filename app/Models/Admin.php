<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable; // 提供通知功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 基礎用戶認證類

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    public $timestamps = false;

    protected $fillable = [
        'account',
        'name',
        'password',
        'salt',
    ];

    protected $hidden = [
        'password',
        'salt',
    ];
}
