<x-layout>
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Detail Ruangan</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <img src="{{ asset('storage/ruangans/' . $ruangan->image) }}"
                     alt="Gambar Ruangan"
                     class="w-full h-64 object-cover rounded-lg border" />
            </div>

            <div class="space-y-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Nama Ruangan</h2>
                    <p class="text-gray-800 text-lg">{{ $ruangan->title }}</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Kapasitas</h2>
                    <p class="text-gray-800 text-lg">{{ $ruangan->capacity }} orang</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Deskripsi</h2>
                    <p class="text-gray-800 text-lg">{{ $ruangan->description }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('admin.ruangans.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">← Kembali ke Daftar</a>
        </div>
    </div>
</x-layout>
