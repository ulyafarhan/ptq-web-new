<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengatur batas panjang string database (opsional, tapi bagus untuk MySQL lama)
        Schema::defaultStringLength(191);

        // 2. Atur Locale Carbon ke Indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
