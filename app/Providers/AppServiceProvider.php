<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 確保載入 api 路由
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    public function register()
    {
        //
    }
}

