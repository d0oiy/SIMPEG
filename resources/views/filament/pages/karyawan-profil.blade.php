<x-filament::page>
    <h2 class="text-lg font-bold mb-4">Profil Saya</h2>

    <div class="space-y-2">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Jabatan:</strong> {{ $user->jabatan }}</p>
        <p><strong>Role:</strong> {{ $user->getRoleNames()->first() }}</p>
    </div>
</x-filament::page>
