<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class KaryawanProfil extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.karyawan-profil';
    protected static ?string $navigationGroup = 'Karyawan';

    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();

        if (!$this->user->hasRole('karyawan')) {
            abort(403); // Blokir akses jika bukan karyawan
        }
    }

    protected function getViewData(): array
    {
        return [
            'user' => $this->user,
        ];
    }
}
