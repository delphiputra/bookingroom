<x-layout-user>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">📅 Buat Booking Baru</h2>

        {{-- Tampilkan pesan error konflik jika ada --}}
        @if($errors->has('conflict'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ $errors->first('conflict') }}
            </div>
        @endif

        <form action="{{ route('user.booking.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Tampilkan Nama User Login, readonly --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Pengguna</label>
                <input type="text"
                       value="{{ session('user_name') ?? '' }}"
                       readonly
                       class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Pilih Ruangan --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Pilih Ruangan</label>
                <select name="ruangan_id" required
                        class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->title }}</option>
                    @endforeach
                </select>
                @error('ruangan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Booking --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Tanggal Booking</label>
                <input type="date" name="booking_date" required
                       class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('booking_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jam Mulai dan Selesai --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Jam Mulai</label>
                    <input type="time" name="start_time" required
                           class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('start_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Jam Selesai</label>
                    <input type="time" name="end_time" required
                           class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('end_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Contoh: Rapat bulanan divisi IT"
                          class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-200 shadow-sm">
                    Simpan Booking
                </button>
            </div>
        </form>
    </div>
</x-layout-user>
