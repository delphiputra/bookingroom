<x-layout-user>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">✏️ Edit Booking</h2>

        {{-- Tampilkan pesan error konflik booking --}}
        @if($errors->has('conflict'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">⚠️ Konflik:</strong>
                <span class="block sm:inline">{{ $errors->first('conflict') }}</span>
            </div>
        @endif

        <form action="{{ route('user.booking.update', $booking->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

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
                        <option value="{{ $ruangan->id }}" {{ old('ruangan_id', $booking->ruangan_id) == $ruangan->id ? 'selected' : '' }}>
                            {{ $ruangan->title }}
                        </option>
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
                       value="{{ old('booking_date', $booking->booking_date) }}"
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
                           value="{{ old('start_time', $booking->start_time) }}"
                           class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('start_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Jam Selesai</label>
                    <input type="time" name="end_time" required
                           value="{{ old('end_time', $booking->end_time) }}"
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
                          class="w-full border border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $booking->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-500 text-white font-semibold rounded-md hover:bg-indigo-600 transition duration-200 shadow-sm">
                    Update Booking
                </button>
            </div>
        </form>
    </div>
</x-layout-user>
