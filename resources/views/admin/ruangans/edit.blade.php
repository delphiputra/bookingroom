<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Ruangan</h1>

    <form action="{{ route('admin.ruangans.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-medium text-gray-700">Nama Ruangan</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $ruangan->title) }}" 
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
                value="{{ old('capacity', $ruangan->capacity) }}" 
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
            >{{ old('description', $ruangan->description) }}</textarea>
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
                class="mt-1 w-full text-gray-600"
            />
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($ruangan->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $ruangan->image) }}" alt="Gambar Ruangan" class="w-48 rounded shadow mt-1">
                </div>
            @endif
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.ruangans.index') }}" 
               class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" 
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</x-layout>
