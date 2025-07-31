<x-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-10">
        <!-- Judul -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <span class="text-4xl">📊</span> Dashboard Admin
            </h2>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white border-l-8 border-blue-500 p-6 rounded-2xl shadow hover:scale-105 transition">
                <div class="flex items-center gap-4">
                    <div class="text-blue-500 text-4xl">👤</div>
                    <div>
                        <h3 class="text-gray-600 text-sm">Total Users</h3>
                        <p class="text-2xl font-semibold text-blue-800">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border-l-8 border-green-500 p-6 rounded-2xl shadow hover:scale-105 transition">
                <div class="flex items-center gap-4">
                    <div class="text-green-500 text-4xl">🏢</div>
                    <div>
                        <h3 class="text-gray-600 text-sm">Total Ruangan</h3>
                        <p class="text-2xl font-semibold text-green-800">{{ $totalRuangans }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white border-l-8 border-yellow-500 p-6 rounded-2xl shadow hover:scale-105 transition">
                <div class="flex items-center gap-4">
                    <div class="text-yellow-500 text-4xl">📅</div>
                    <div>
                        <h3 class="text-gray-600 text-sm">Total Booking</h3>
                        <p class="text-2xl font-semibold text-yellow-800">{{ $totalBookings }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Dinamis -->
        <form method="GET" action="{{ route('admin.home') }}" class="flex flex-col sm:flex-row gap-4 items-start sm:items-end" id="filter-form">
            <!-- Dropdown Pilihan Filter -->
            <div>
                <label for="filter_type" class="block text-sm font-medium text-gray-700">Filter Berdasarkan</label>
                <select name="filter_type" id="filter_type" class="mt-1 p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400">
                    <option value="date" {{ request('filter_type') === 'date' ? 'selected' : '' }}>Tanggal</option>
                    <option value="user" {{ request('filter_type') === 'user' ? 'selected' : '' }}>Nama User</option>
                    <option value="ruangan" {{ request('filter_type') === 'ruangan' ? 'selected' : '' }}>Nama Ruangan</option>
                </select>
            </div>

            <!-- Input Dinamis -->
            <div id="dynamic-input">
                @if(request('filter_type') === 'user')
                    <div>
                        <label for="user" class="block text-sm font-medium text-gray-700">Nama User</label>
                        <input 
                            type="text" 
                            id="user" 
                            name="user" 
                            value="{{ request('user') }}" 
                            placeholder="Masukkan nama user"
                            class="mt-1 p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400"
                        >
                    </div>
                @elseif(request('filter_type') === 'ruangan')
                    <div>
                        <label for="ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input 
                            type="text" 
                            id="ruangan" 
                            name="ruangan" 
                            value="{{ request('ruangan') }}" 
                            placeholder="Masukkan nama ruangan"
                            class="mt-1 p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400"
                        >
                    </div>
                @else
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input 
                            type="date" 
                            id="date" 
                            name="date" 
                            value="{{ request('date') }}" 
                            class="mt-1 p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400"
                        >
                    </div>
                @endif
            </div>

            <!-- Tombol -->
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    Filter
                </button>
                <a href="{{ route('admin.home') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow transition">
                    Reset
                </a>
            </div>
        </form>

        <!-- Table Booking -->
        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
            <table class="w-full table-auto text-sm md:text-base text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-semibold">👤 User</th>
                        <th class="px-6 py-3 font-semibold">🏢 Ruangan</th>
                        <th class="px-6 py-3 font-semibold">📅 Tanggal</th>
                        <th class="px-6 py-3 font-semibold">⏰ Waktu</th>
                        <th class="px-6 py-3 font-semibold">📝 Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-blue-50 transition cursor-pointer">
                            <td class="px-6 py-4 font-medium">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->ruangan->title }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="px-6 py-4 truncate max-w-xs" title="{{ $booking->description }}">{{ $booking->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500 italic">
                                🚫 Tidak ada booking yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Auto-submit script -->
    <script>
        document.getElementById('filter_type').addEventListener('change', function () {
            document.getElementById('filter-form').submit();
        });
    </script>
</x-layout>
