<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ServerStatsWidget extends BaseWidget
{
    // Refresh otomatis setiap 5 detik agar terasa real-time memantau server
    protected static ?string $pollingInterval = '5s';
    
    // Urutan widget 
    protected static ?int $sort = 2; 

    protected function getStats(): array
    {
        // 1. CEK LATENCY DATABASE (Kecepatan Respon)
        $start = microtime(true);
        try {
            DB::select('select 1'); 
            $end = microtime(true);
            $latency = round(($end - $start) * 1000); 
            
            // Tentukan status berdasarkan kecepatan
            if ($latency < 50) {
                $statusDb = 'Sangat Cepat';
                $colorDb = 'success'; 
            } elseif ($latency < 200) {
                $statusDb = 'Normal';
                $colorDb = 'primary'; 
            } else {
                $statusDb = 'Lemot / Berat';
                $colorDb = 'danger'; 
            }
        } catch (\Exception $e) {
            $latency = 0;
            $statusDb = 'Terputus / Tidak Terhubung';
            $colorDb = 'danger';
        }

        // 2. CEK DISK SPACE (Penyimpanan)
        $diskPath = '/'; 
        $diskTotal = @disk_total_space($diskPath) ?: 1; 
        $diskFree = @disk_free_space($diskPath) ?: 0;
        $diskUsedPercent = round((($diskTotal - $diskFree) / $diskTotal) * 100);
        
        $diskStatus = $diskUsedPercent > 90 ? 'Penuh! Bahaya' : ($diskUsedPercent . '% Terpakai');
        $diskColor = $diskUsedPercent > 90 ? 'danger' : 'success';

        // 3. CEK MEMORI (RAM Script PHP)
        $memory = round(memory_get_usage(true) / 1024 / 1024, 2); // Konversi ke MB

        return [
            Stat::make('Koneksi Database', $statusDb)
                ->description("Respon: {$latency} ms")
                ->descriptionIcon('heroicon-m-server')
                ->color($colorDb),

            Stat::make('Penyimpanan Server', $diskStatus)
                ->description(round($diskFree / 1024 / 1024 / 1024, 2) . ' GB Kosong')
                ->descriptionIcon('heroicon-m-circle-stack')
                ->color($diskColor),

            Stat::make('Beban Memori', $memory . ' MB')
                ->description('Penggunaan RAM Saat Ini')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('gray'),
        ];
    }
}