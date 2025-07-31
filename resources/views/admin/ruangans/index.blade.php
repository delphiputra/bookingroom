<x-layout>
  <h1 class="text-3xl font-extrabold mb-8 text-blue-700 tracking-wide drop-shadow-md select-none">
    Daftar Ruangan
  </h1>

  @if (session('success'))
    <div
      class="mb-6 p-4 bg-green-200 text-green-900 rounded-lg border border-green-400 shadow-md
             animate-fadeIn">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('admin.ruangans.create') }}"
     class="mb-6 inline-block bg-blue-600 text-white px-5 py-3 rounded-lg shadow-lg
            hover:bg-blue-700 transition duration-300 font-semibold select-none
            transform hover:scale-105 hover:shadow-blue-500"
  >
    + Tambah Ruangan
  </a>

  <!-- Tabel desktop -->
  <div class="overflow-x-auto hidden sm:block rounded-lg shadow-lg border border-gray-200">
    <table class="min-w-full bg-white rounded-lg text-sm text-gray-700">
      <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-semibold tracking-wider select-none">
        <tr>
          <th class="px-5 py-4 border-b border-blue-200 text-center">No</th>
          <th class="px-5 py-4 border-b border-blue-200 text-center">Nama Ruangan</th>
          <th class="px-5 py-4 border-b border-blue-200 text-center">Kapasitas</th>
          <th class="px-5 py-4 border-b border-blue-200 text-center">Deskripsi</th>
          <th class="px-5 py-4 border-b border-blue-200 text-center">Gambar</th>
          <th class="px-5 py-4 border-b border-blue-200 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($ruangans as $ruangan)
          <tr
            class="border-b border-blue-100 hover:bg-blue-50 transition duration-300
                   cursor-pointer select-none"
          >
            <td class="px-5 py-4 text-center font-semibold">{{ $loop->iteration }}</td>
            <td class="px-5 py-4 text-center font-medium">{{ $ruangan->title }}</td>
            <td class="px-5 py-4 text-center">{{ $ruangan->capacity }}</td>
            <td class="px-5 py-4 text-center text-gray-600">{{ $ruangan->description }}</td>
            <td class="px-5 py-4 text-center">
              @if ($ruangan->image)
                <img
                  src="{{ asset('storage/ruangans/' . $ruangan->image) }}"
                  alt="Gambar {{ $ruangan->title }}"
                  class="w-28 h-28 object-cover rounded-lg border border-gray-300 shadow-sm mx-auto
                         transition-transform duration-300 hover:scale-110 hover:shadow-lg"
                >
              @else
                <span class="text-gray-400 italic">Tidak ada</span>
              @endif
            </td>
            <td class="px-5 py-4 text-center">
              <div class="flex justify-center gap-3 flex-wrap">
                <a href="{{ route('admin.ruangans.show', $ruangan->id) }}"
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md shadow-md
                          transition transform hover:scale-105 select-none text-xs font-semibold"
                >
                  Show
                </a>
                <a href="{{ route('admin.ruangans.edit', $ruangan->id) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md
                          transition transform hover:scale-105 select-none text-xs font-semibold"
                >
                  Edit
                </a>
                <form
                  action="{{ route('admin.ruangans.destroy', $ruangan->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin hapus data?')"
                  class="inline-block"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow-md
                           transition transform hover:scale-105 select-none text-xs font-semibold"
                  >
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-8 text-gray-500 italic select-none">
              Belum ada data ruangan.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Tampilan mobile -->
  <div class="grid grid-cols-1 gap-6 sm:hidden">
    @forelse ($ruangans as $ruangan)
      <div
        class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col select-none"
        x-data="{ open: false }"
        x-cloak
        @keydown.escape="open = false"
      >
        @if ($ruangan->image)
          <img
            src="{{ asset('storage/ruangans/' . $ruangan->image) }}"
            alt="Gambar {{ $ruangan->title }}"
            class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105"
          >
        @endif
        <div class="p-5 flex-1 flex flex-col justify-between">
          <div>
            <h2 class="text-2xl font-semibold mb-2 text-blue-700">{{ $ruangan->title }}</h2>
            <p class="text-sm text-gray-700 mb-1 font-medium">Kapasitas: {{ $ruangan->capacity }}</p>
            <p class="text-sm text-gray-600 mb-4">{{ $ruangan->description }}</p>
          </div>

          <button
            @click="open = !open"
            class="bg-blue-600 text-white px-5 py-3 rounded-lg shadow-md
                   hover:bg-blue-700 focus:outline-none transition-all duration-300 font-semibold"
          >
            <span x-text="open ? 'Tutup Aksi' : 'Tampilkan Aksi'"></span>
          </button>

          <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            style="display: none;"
            class="mt-4 space-y-3"
          >
            <a href="{{ route('admin.ruangans.show', $ruangan->id) }}"
               class="block bg-green-500 text-white px-5 py-3 rounded-lg shadow-md
                      hover:bg-green-600 text-center font-semibold transition transform hover:scale-105"
            >
              Show
            </a>
            <a href="{{ route('admin.ruangans.edit', $ruangan->id) }}"
               class="block bg-yellow-400 text-white px-5 py-3 rounded-lg shadow-md
                      hover:bg-yellow-500 text-center font-semibold transition transform hover:scale-105"
            >
              Edit
            </a>
            <form action="{{ route('admin.ruangans.destroy', $ruangan->id) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus data?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="w-full bg-red-500 text-white px-5 py-3 rounded-lg shadow-md
                             hover:bg-red-600 font-semibold transition transform hover:scale-105"
              >
                Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center p-6 text-gray-500 italic select-none">Belum ada data ruangan.</p>
    @endforelse
  </div>

  <script src="//unpkg.com/alpinejs" defer></script>

  <style>
    /* Animasi fade in sederhana untuk alert */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .animate-fadeIn {
      animation: fadeIn 0.5s ease forwards;
    }
  </style>
</x-layout>
