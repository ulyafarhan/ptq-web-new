<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
        // KEAMANAN: Force HTTPS di Production (Anti-Man-in-the-Middle)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // OPTIMASI & KEAMANAN: Strict Mode
        // 1. Mencegah Lazy Loading (N+1 Problem)
        // 2. Mencegah pengisian atribut yang tidak ada di fillable (Mass Assignment Protection)
        // 3. Mencegah akses atribut yang tidak ada (Typos)
        Model::shouldBeStrict(!$this->app->environment('production'));

        // OPTIMASI: Mencegah panjang string database
        // Mengatur batas panjang string database (opsional, tapi bagus untuk MySQL lama)
        Schema::defaultStringLength(191);

        // 2. Atur Locale Carbon ke Indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
