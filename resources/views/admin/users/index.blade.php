<x-layout>
  <h1 class="text-4xl font-extrabold mb-8 text-blue-700 drop-shadow-md select-none">Daftar Pengguna</h1>

  @if(session('success'))
    <div 
      x-data="{ show: true }" 
      x-show="show" 
      x-transition.duration.500ms
      class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded shadow-md select-none"
      @click.away="show = false"
      style="cursor: pointer;"
      title="Klik untuk menutup"
    >
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('admin.users.create') }}" 
     class="mb-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold
            shadow-md hover:bg-blue-700 transition-colors duration-300 select-none
            active:scale-95"
  >
    + Tambah Pengguna
  </a>

  {{-- Tabel Desktop/Tablet --}}
  <div class="overflow-x-auto hidden sm:block rounded-lg shadow-lg border border-gray-200">
    <table class="min-w-full bg-white text-sm">
      <thead class="bg-blue-50 text-blue-900 uppercase text-xs font-semibold select-none">
        <tr>
          <th class="px-5 py-3 border-b border-blue-200 text-center">No</th>
          <th class="px-5 py-3 border-b border-blue-200 text-left">Nama Pengguna</th>
          <th class="px-5 py-3 border-b border-blue-200 text-left">Email</th>
          <th class="px-5 py-3 border-b border-blue-200 text-center">Role</th>
          <th class="px-5 py-3 border-b border-blue-200 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200 cursor-pointer">
            <td class="px-5 py-3 text-center font-medium text-gray-700">{{ $loop->iteration }}</td>
            <td class="px-5 py-3 font-semibold text-gray-800">{{ $user->name }}</td>
            <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>
            <td class="px-5 py-3 text-center text-gray-700 font-medium">{{ ucfirst($user->role) }}</td>
            <td class="px-5 py-3 text-center space-x-3">
              <a href="{{ route('admin.users.edit', $user->id) }}" 
                 class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm font-semibold
                        shadow-md transition-colors duration-300 select-none"
              >Edit</a>
              <form class="inline-block" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-semibold
                               shadow-md transition-colors duration-300 select-none"
                >Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-8 text-gray-500 italic select-none">Belum ada data pengguna.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Card Mobile --}}
  <div class="grid grid-cols-1 gap-6 sm:hidden mt-4">
    @forelse ($users as $user)
      <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col p-5">
        <h2 class="text-2xl font-bold mb-2 text-blue-700 select-none">{{ $user->name }}</h2>
        <p class="text-sm text-gray-600 mb-1 select-none"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="text-sm text-gray-600 mb-4 select-none"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <div class="flex gap-4 justify-center">
          <a href="{{ route('admin.users.edit', $user->id) }}" 
             class="bg-yellow-400 text-white px-6 py-2 rounded-lg font-semibold text-center
                    shadow-md hover:bg-yellow-500 transition-colors duration-300 select-none flex-1"
          >Edit</a>
          <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="w-full bg-red-500 text-white px-6 py-2 rounded-lg font-semibold 
                           shadow-md hover:bg-red-600 transition-colors duration-300 select-none"
            >Hapus</button>
          </form>
        </div>
      </div>
    @empty
      <p class="text-center col-span-full p-6 text-gray-500 italic select-none">Belum ada data pengguna.</p>
    @endforelse
  </div>

  <!-- Alpine.js (bisa dihilangkan karena toggle sudah dihilangkan) -->
</x-layout>
