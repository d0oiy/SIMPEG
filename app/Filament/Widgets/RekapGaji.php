<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Services\GajiService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RekapGaji extends BaseWidget
{
    protected function getStats(): array
    {
        $gajiService = new GajiService();
        $stats = [];

        // Ambil semua user dengan role selain admin
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->get();

        foreach ($users as $user) {
            $totalGaji = $gajiService->hitung($user, now()->month, now()->year);

            $stats[] = Stat::make($user->name, 'Rp ' . number_format($totalGaji, 0, ',', '.'))
                ->description($user->jabatan)
                ->descriptionIcon('heroicon-o-user')
                ->color('success');
        }

        return $stats;
    }
}
