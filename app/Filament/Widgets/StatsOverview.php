<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Structure;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengurus', Structure::where('is_active', true)->count())
                ->description('Pengurus aktif saat ini')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), 

            Stat::make('Total Berita', Post::count())
                ->description('Artikel terpublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Status Sistem', 'Optimal')
                ->description('Server berjalan normal')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}