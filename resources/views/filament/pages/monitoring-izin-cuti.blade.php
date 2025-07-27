<x-filament::page>
    <h2 class="text-xl font-bold mb-4">
        Monitoring Pegawai Over Izin/Cuti – {{ now()->translatedFormat('F Y') }}
    </h2>

    @if (collect($data)->isEmpty())
        <p class="text-gray-500">Tidak ada pegawai yang over izin atau cuti bulan ini.</p>
    @else
        <table class="min-w-full text-sm border border-gray-300">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Jabatan</th>
                    <th class="px-4 py-2 border text-center">Jumlah Izin</th>
                    <th class="px-4 py-2 border text-center">Jumlah Cuti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="px-4 py-2 border">{{ $item['nama'] }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($item['role']) }}</td>
                        <td class="px-4 py-2 border">{{ $item['jabatan'] }}</td>
                        <td class="px-4 py-2 border text-center text-orange-600 font-medium">
                            {{ $item['izin'] }}
                        </td>
                        <td class="px-4 py-2 border text-center text-red-600 font-medium">
                            {{ $item['cuti'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-filament::page>
