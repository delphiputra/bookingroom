<x-layout-user>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-3">
                <span class="text-4xl">📋</span> Daftar Booking Ruangan {{ session('user_name') }}
            </h2>
            <a href="{{ route('user.booking.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Booking Baru
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow-lg bg-white dark:bg-gray-900">
            <table class="w-full table-auto text-sm md:text-base text-left border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-3 font-semibold">User</th>
                        <th class="px-6 py-3 font-semibold">Ruangan</th>
                        <th class="px-6 py-3 font-semibold">Tanggal</th>
                        <th class="px-6 py-3 font-semibold">Waktu</th>
                        <th class="px-6 py-3 font-semibold">Deskripsi</th>
                        <th class="px-6 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 dark:text-gray-200 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                            <td class="px-6 py-4 font-medium">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->ruangan->title }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="px-6 py-4 truncate max-w-xs" title="{{ $booking->description }}">{{ $booking->description }}</td>
                            <td class="px-6 py-4 text-center space-x-4 whitespace-nowrap">
                                <a href="{{ route('user.booking.edit', $booking->id) }}"
                                   class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-semibold transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11 5h6m-6 6h6m-6 6h6M5 7h.01M5 13h.01M5 19h.01"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('user.booking.destroy', $booking->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah kamu yakin ingin menghapus booking ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 font-semibold transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-500 dark:text-gray-400 italic">
                                🚫 Tidak ada booking yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout-user>
