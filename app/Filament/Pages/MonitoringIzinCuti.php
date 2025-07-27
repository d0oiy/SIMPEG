<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Attendance;
use Filament\Pages\Page;

class MonitoringIzinCuti extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationGroup = 'Laporan';
    protected static string $view = 'filament.pages.monitoring-izin-cuti';

    public $data = [];

    public function mount(): void
    {
        $bulan = now()->month;
        $tahun = now()->year;

        // Batas maksimal izin dan cuti
        $maxIzin = 3;
        $maxCuti = 3;

        $this->data = User::with('roles')->get()->map(function ($user) use ($bulan, $tahun) {
            $izin = Attendance::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'izin')
                ->count();

            $cuti = Attendance::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'cuti')
                ->count();

            return [
                'nama' => $user->name,
                'jabatan' => $user->jabatan,
                'role' => $user->roles->first()?->name ?? '-',
                'izin' => $izin,
                'cuti' => $cuti,
            ];
        })->filter(function ($item) use ($maxIzin, $maxCuti) {
            return $item['izin'] > $maxIzin || $item['cuti'] > $maxCuti;
        })->values(); // Reset index array
    }

    protected function getViewData(): array
    {
        return [
            'data' => $this->data,
        ];
    }
}
