<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Data Diri</h2>
    <ul class="space-y-2">
        <li><strong>Nama:</strong> {{ $this->getUser()->name }}</li>
        <li><strong>Email:</strong> {{ $this->getUser()->email }}</li>
        <li><strong>Jabatan:</strong> {{ $this->getUser()->jabatan }}</li>
        <li><strong>Role:</strong> {{ $this->getUser()->getRoleNames()->first() }}</li>
    </ul>
</x-filament::page>
