<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Services\GajiService;
use Filament\Widgets\Widget;

class GajiKaryawan extends Widget
{
    protected static string $view = 'filament.widgets.gaji-karyawan';

    public function getData(): array
    {
        $user = auth()->user();
        $gajiService = new GajiService();

        $gaji = $gajiService->hitung($user, now()->month, now()->year);

        return [
            'user' => $user,
            'gaji' => $gaji,
        ];
    }
}
