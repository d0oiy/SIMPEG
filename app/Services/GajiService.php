<?php

namespace App\Services;

use App\Models\User;
use App\Models\Attendance;

class GajiService
{
    protected array $gajiTetap = [
        'direktur' => 15000000,
        'wakil direktur' => 10000000,
        'kasie' => 8000000,
        'kabid' => 7500000,
        'kadiv' => 5000000,
        'admin' => 9000000,
        'karyawan' => 3500000,
    ];

    public function hitung(User $user, int $bulan, int $tahun): int
    {
        // Ambil jabatan dari kolom 'jabatan', fallback ke 'karyawan'
        $jabatan = strtolower($user->jabatan ?? 'karyawan');

        // Ambil gaji pokok berdasarkan jabatan
        $gajiPokok = $this->gajiTetap[$jabatan] ?? $this->gajiTetap['karyawan'];

        // Hitung jumlah izin di bulan & tahun yang diminta
        $izinCount = Attendance::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'izin')
            ->count();

        $potongan = $izinCount * 10000;

        return max(0, $gajiPokok - $potongan);
    }
}
