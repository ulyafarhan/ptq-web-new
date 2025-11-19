<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Structure;
use App\Models\User;
use App\Models\Visit; // Import Model Visit
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    // Auto refresh data setiap 30 detik agar terasa live
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        // 1. DATA TRAFIK (Grafik 7 Hari Terakhir)
        $trafficData = Visit::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count')
            ->toArray();
        
        // Hitung total kunjungan hari ini
        $todayVisits = Visit::whereDate('created_at', Carbon::today())->count();
        
        // Hitung total Pengunjung Unik (Berdasarkan IP)
        $uniqueVisitors = Visit::distinct('ip_address')->count();

        return [
            Stat::make('Berita Terbit', Post::where('status', 'published')->count())
                ->description('Artikel aktif dibaca')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),

            Stat::make('Pengurus', Structure::count())
                ->description('Pengurus UKM PTQ')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Status Sistem', 'Optimal')
                ->description('Server berjalan normal')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Trafik Hari Ini', $todayVisits)
                ->description('Total hits halaman')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($trafficData) 
                ->color('success'),

            Stat::make('Total Pengunjung Unik', $uniqueVisitors)
                ->description('Berdasarkan IP Address')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
        ];
    }
}