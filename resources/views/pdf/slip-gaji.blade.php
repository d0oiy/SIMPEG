<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 8px; border: 1px solid #000; }
    </style>
</head>
<body>
    <h2>Slip Gaji</h2>
    <p>Bulan: {{ \Carbon\Carbon::create(null, $bulan)->translatedFormat('F') }} {{ $tahun }}</p>

    <table>
        <tr><th>Nama</th><td>{{ $nama }}</td></tr>
        <tr><th>Role</th><td>{{ $role }}</td></tr>
        <tr><th>Jabatan</th><td>{{ $jabatan }}</td></tr>
        <tr><th>Gaji Pokok</th><td>Rp {{ number_format($gaji_pokok, 0, ',', '.') }}</td></tr>
        <tr><th>Izin</th><td>{{ $izin }}</td></tr>
        <tr><th>Potongan</th><td>Rp {{ number_format($potongan, 0, ',', '.') }}</td></tr>
        <tr><th>Gaji Akhir</th><td><strong>Rp {{ number_format($gaji_akhir, 0, ',', '.') }}</strong></td></tr>
    </table>
</body>
</html>
