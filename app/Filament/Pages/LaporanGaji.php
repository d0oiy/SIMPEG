<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\GajiService;
use Filament\Pages\Page;

class LaporanGaji extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.laporan-gaji';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?int $navigationSort = 1;

    public $rekap = [];

    public function mount(): void
    {
        $service = new GajiService();
        $bulan = now()->month;
        $tahun = now()->year;

        $this->rekap = User::with('roles')->get()->map(function ($user) use ($service, $bulan, $tahun) {
            $role = $user->roles->first()?->name ?? 'karyawan';

            // Tentukan gaji pokok berdasarkan role
            $gajiPokok = match (strtolower($role)) {
                'direktur' => 15000000,
                'wakil direktur' => 10000000,
                'kasie' => 8000000,
                'kabid' => 7500000,
                'kadiv' => 5000000,
                'admin' => 9000000,
                default => 3500000,
            };

            // Hitung jumlah izin secara manual
            $izin = \App\Models\Attendance::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->where('status', 'izin')
                ->count();

            $potongan = $izin * 10000;
            $gajiAkhir = $gajiPokok - $potongan;

            return [
                'id' => $user->id,
                'nama' => $user->name,
                'jabatan' => $user->jabatan,
                'role' => ucfirst($role),
                'gaji_pokok' => $gajiPokok,
                'izin' => $izin,
                'potongan' => $potongan,
                'gaji_akhir' => $gajiAkhir,
            ];
        });
    }

    protected function getViewData(): array
    {
        return [
            'rekap' => $this->rekap,
        ];
    }
}
