<?php

namespace App\Filament\Karyawan\Pages;

use Filament\Pages\Page;

class Profil extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.karyawan.pages.profil';
    protected static ?string $title = 'Profil';

    public function getUser()
    {
        return auth()->user();
    }
}
