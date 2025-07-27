<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-6 max-w-lg">
        {{ $this->form }}
        <x-filament::button type="submit" color="success">
            Simpan Absensi
        </x-filament::button>
    </form>
</x-filament::page>
