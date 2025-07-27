<?php
namespace App\Filament\Pages;

use App\Models\Attendance;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class KaryawanAbsensi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static string $view = 'filament.pages.karyawan-absensi';
    protected static ?string $navigationGroup = 'Karyawan';

    public $absensi = [];

    public function mount(): void
    {
        $user = Auth::user();

        if (!$user->hasRole('karyawan')) {
            abort(403); // Hanya role 'karyawan' boleh akses halaman ini
        }

        $this->absensi = Attendance::where('user_id', $user->id)
            ->orderByDesc('tanggal')
            ->take(30)
            ->get();
    }

    protected function getViewData(): array
    {
        return [
            'absensi' => $this->absensi,
        ];
    }
}
