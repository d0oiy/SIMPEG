<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="text-xl font-bold mb-4">Gaji Bulan {{ now()->translatedFormat('F Y') }}</h2>

        <p><strong>Nama:</strong> {{ $getData()['user']->name }}</p>
        <p><strong>Jabatan:</strong> {{ $getData()['user']->jabatan }}</p>
        <p><strong>Total Gaji Bersih:</strong> Rp {{ number_format($getData()['gaji'], 0, ',', '.') }}</p>
    </x-filament::section>
</x-filament-widgets::widget>
