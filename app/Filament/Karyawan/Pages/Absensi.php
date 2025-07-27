<?php

namespace App\Filament\Karyawan\Pages;

use App\Models\Attendance;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class Absensi extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static string $view = 'filament.karyawan.pages.absensi';
    protected static ?string $title = 'Absensi';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                DatePicker::make('tanggal')
                    ->default(today())
                    ->required(),
                Select::make('status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'cuti' => 'Cuti',
                        'tugas luar' => 'Tugas Luar',
                        'absen' => 'Absen',
                    ])
                    ->required(),
            ]);
    }

    public function submit(): void
    {
        Attendance::create([
            'user_id' => auth()->id(),
            'tanggal' => $this->data['tanggal'],
            'status' => $this->data['status'],
        ]);

        Notification::make()
            ->title('Absensi berhasil dicatat.')
            ->success()
            ->send();
    }
}
