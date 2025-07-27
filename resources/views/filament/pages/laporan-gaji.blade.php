<x-filament::page>
    <h2 class="text-xl font-bold mb-4">
        Rekap Gaji Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
    </h2>

    <table class="min-w-full text-sm border border-gray-300">
        <thead class="bg-black text-white">
            <tr>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Role</th>
                <th class="px-4 py-2 border">Jabatan</th>
                <th class="px-4 py-2 border">Gaji Pokok</th>
                <th class="px-4 py-2 border">Izin</th>
                <th class="px-4 py-2 border">Potongan</th>
                <th class="px-4 py-2 border">Gaji Akhir</th>
                <th class="px-4 py-2 border text-center">Aksi</th> {{-- ✅ Tambahkan header kolom Aksi --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ $item['nama'] }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($item['role']) }}</td>
                    <td class="px-4 py-2 border">{{ $item['jabatan'] }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($item['gaji_pokok'], 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $item['izin'] }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($item['potongan'], 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border font-bold">Rp {{ number_format($item['gaji_akhir'], 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('slip-gaji.cetak', [$item['id'], now()->month, now()->year]) }}"
                           target="_blank"
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Cetak PDF
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
