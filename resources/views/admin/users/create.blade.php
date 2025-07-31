<x-layout>
    <h1 class="text-2xl font-bold mb-6">Tambah user Baru</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block font-medium text-gray-700">Nama user</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" />
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" />
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="block font-medium text-gray-700">Role</label>
            <select id="role" name="role" required
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            
                <!-- Tambah opsi lain sesuai kebutuhan -->
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
           <label for="password" class="block font-medium text-gray-700">Password </label>
            <input type="password" id="password" name="password"
                class="mt-1 w-full rounded border border-gray-300 shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('password') }}</textarea>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}"
                class="inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</x-layout>
