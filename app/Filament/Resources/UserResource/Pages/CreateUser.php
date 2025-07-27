<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected string|null $role = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->role = $data['role'] ?? null;
        unset($data['role']); // jangan ikut insert

        return $data; // biarkan Filament create seperti biasa
    }

    protected function afterCreate(): void
    {
        if ($this->role) {
            $this->record->assignRole($this->role);
        }
    }
}
