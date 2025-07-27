<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlipGajiController;

Route::middleware('web')->group(function () {

    // 🔁 Root diarahkan ke login Filament bawaan via PATH
    Route::get('/', function () {
        return redirect('/admin/login'); // 👈 sesuaikan dengan panel default kamu
    })->name('login');

    // 🔐 Redirect sesuai role
    Route::get('/redirect-role', function () {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasRole(['admin', 'owner', 'direktur', 'wakil direktur', 'kabid', 'kasie', 'kadiv'])) {
            return redirect('/admin');
        }

        if ($user->hasRole('karyawan')) {
            return redirect('/karyawan');
        }

        abort(403, 'Akses tidak diizinkan.');
    })->middleware('auth');

    // 🧾 Cetak slip gaji
    Route::get('/slip-gaji/{user}/{bulan}/{tahun}', [SlipGajiController::class, 'cetak'])
        ->middleware('auth')
        ->name('slip-gaji.cetak');
});
