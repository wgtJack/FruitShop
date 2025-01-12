<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // 繼承自 Authenticatable
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // 繼承自 Authenticatable 來支援 Auth
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'user_name',
        'phone',
        'password',
        'salt',
    ];

    protected $hidden = [
        'password',
        'salt',
    ];
}
