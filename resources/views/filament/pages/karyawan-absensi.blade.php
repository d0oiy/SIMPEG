<x-filament::page>
    <h2 class="text-lg font-bold mb-4">Riwayat Absensi Saya</h2>

    @if ($absensi->isEmpty())
        <p>Belum ada data absensi.</p>
    @else
        <table class="min-w-full text-sm border border-gray-300">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $item)
                    <tr>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-filament::page>
