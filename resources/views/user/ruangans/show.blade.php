<x-layout-user>


<div class="max-w-5xl mx-auto bg-gradient-to-br from-white to-gray-50 p-10 rounded-3xl shadow-2xl mt-12 border border-gray-200">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-2 border-gray-200 pb-4">
         Detail Ruangan
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <div class="overflow-hidden rounded-2xl shadow-md transform hover:scale-105 transition-transform duration-500">
            <img src="{{ asset('storage/ruangans/' . $ruangan->image) }}"
                 alt="Gambar Ruangan"
                 class="w-full h-72 object-cover" />
        </div>

        <div class="space-y-6 text-gray-800">
            <div>
                <h2 class="text-2xl font-semibold text-gray-700">🧾 Nama Ruangan</h2>
                <p class="text-lg">{{ $ruangan->title }}</p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700">👥 Kapasitas</h2>
                <p class="text-lg">{{ $ruangan->capacity }} orang</p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700">📝 Deskripsi</h2>
                <p class="text-lg leading-relaxed">{{ $ruangan->description }}</p>
            </div>
        </div>
    </div>

    <div class="mt-10 text-right">
        <a href="{{ route('user.home') }}"
           class="inline-block bg-blue-600 text-white text-lg px-6 py-3 rounded-full shadow hover:bg-blue-700 transition-colors duration-300">
            ← Kembali ke Daftar
        </a>
    </div>
</div>
</x-layout-user>