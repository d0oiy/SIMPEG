<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GajiService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function cetak(User $user, $bulan, $tahun)
    {
        $service = new GajiService();

        $role = $user->roles->first()?->name ?? 'karyawan';
        $gajiPokok = match (strtolower($role)) {
            'direktur' => 15000000,
            'wakil direktur' => 10000000,
            'kasie' => 8000000,
            'kabid' => 7500000,
            'kadiv' => 5000000,
            'admin' => 9000000,
            default => 3500000,
        };

        $izin = $user->attendances()
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'izin')
            ->count();

        $potongan = $izin * 10000;
        $gajiAkhir = $service->hitung($user, $bulan, $tahun);

        $data = [
            'nama' => $user->name,
            'jabatan' => $user->jabatan,
            'role' => ucfirst($role),
            'gaji_pokok' => $gajiPokok,
            'izin' => $izin,
            'potongan' => $potongan,
            'gaji_akhir' => $gajiAkhir,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        $pdf = Pdf::loadView('pdf.slip-gaji', $data);

        return $pdf->stream("slip-gaji-{$user->id}-{$bulan}-{$tahun}.pdf");
    }
}
