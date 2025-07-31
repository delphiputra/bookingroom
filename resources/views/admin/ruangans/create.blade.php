<x-layout>
    <h1 class="text-2xl font-bold mb-6">Tambah Ruangan Baru</h1>

    <form action="{{ route('admin.ruangans.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block font-medium text-gray-700">Nama Ruangan</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title') }}" 
                required 
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
            />
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="capacity" class="block font-medium text-gray-700">Kapasitas</label>
            <input 
                type="number" 
                id="capacity" 
                name="capacity" 
                value="{{ old('capacity') }}" 
                required 
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
            />
            @error('capacity')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Deskripsi</label>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                required 
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block font-medium text-gray-700">Gambar</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                accept="image/*" 
                required 
                class="mt-1 w-full text-gray-600"
            />
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- Preview Gambar --}}
            <img id="preview-image" class="mt-3 w-48 rounded shadow border hidden" />
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.ruangans.index') }}" 
               class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" 
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>

    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview-image');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</x-layout>
