<x-layout-user>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Filter Dinamis -->
        <form method="GET" action="{{ route('user.waitinglist.index') }}" class="flex flex-col sm:flex-row gap-4 items-start sm:items-end" id="filter-form">
            <!-- Dropdown Filter -->
            <div>
                <label for="filter_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Filter Berdasarkan</label>
                <select name="filter_type" id="filter_type" class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-white">
                    <option value="date" {{ request('filter_type') === 'date' ? 'selected' : '' }}>Tanggal</option>
                    <option value="user" {{ request('filter_type') === 'user' ? 'selected' : '' }}>Nama User</option>
                    <option value="ruangan" {{ request('filter_type') === 'ruangan' ? 'selected' : '' }}>Nama Ruangan</option>
                </select>
            </div>

            <!-- Input Dinamis -->
            <div id="dynamic-input">
                @switch(request('filter_type'))
                    @case('user')
                        <div>
                            <label for="user" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama User</label>
                            <input 
                                type="text" 
                                id="user" 
                                name="user" 
                                value="{{ request('user') }}" 
                                placeholder="Masukkan nama user"
                                class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-white"
                            >
                        </div>
                        @break

                    @case('ruangan')
                        <div>
                            <label for="ruangan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Ruangan</label>
                            <input 
                                type="text" 
                                id="ruangan" 
                                name="ruangan" 
                                value="{{ request('ruangan') }}" 
                                placeholder="Masukkan nama ruangan"
                                class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-white"
                            >
                        </div>
                        @break

                    @default
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal</label>
                            <input 
                                type="date" 
                                id="date" 
                                name="date" 
                                value="{{ request('date') }}" 
                                class="mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-white"
                            >
                        </div>
                @endswitch
            </div>

            <!-- Tombol -->
            <div class="flex gap-2 mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    Filter
                </button>
                <a href="{{ route('user.waitinglist.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow transition">
                    Reset
                </a>
            </div>
        </form>

        <!-- Tabel Booking -->
        <div class="overflow-x-auto mt-8 bg-white dark:bg-gray-900 rounded-2xl shadow-lg">
            <table class="w-full table-auto text-sm md:text-base text-left border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3 font-semibold">👤 User</th>
                        <th class="px-6 py-3 font-semibold">🏢 Ruangan</th>
                        <th class="px-6 py-3 font-semibold">📅 Tanggal</th>
                        <th class="px-6 py-3 font-semibold">⏰ Waktu</th>
                        <th class="px-6 py-3 font-semibold">📝 Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 dark:text-gray-100 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-blue-50 dark:hover:bg-gray-800 transition cursor-pointer">
                            <td class="px-6 py-4 font-medium">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->ruangan->title }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="px-6 py-4 truncate max-w-xs" title="{{ $booking->description }}">{{ $booking->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500 dark:text-gray-400 italic">
                                🚫 Tidak ada booking yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        

    <!-- Script -->
    <script>
        // Otomatis submit jika filter_type diganti
        document.getElementById('filter_type').addEventListener('change', function () {
            const form = document.getElementById('filter-form');
            const fields = ['user', 'ruangan', 'date'];
            fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.name = ''; // kosongkan name agar tidak ikut dikirim
            });
            form.submit();
        });

        // Dark mode toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Saat halaman dimuat, cek preferensi mode
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</x-layout-user>
