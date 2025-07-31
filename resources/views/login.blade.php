<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>

  
  <link rel="icon" type="image/png" href="{{ asset('storage/ruangans/kemenag.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
      animation: fadeInDown 0.7s ease-out;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 bg-gray-100">

  <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 sm:p-10 fade-in">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Selamat Datang 👋</h1>
      <p class="text-gray-500 mt-1">Silakan login untuk melanjutkan</p>
    </div>

    <!-- Error Message -->
    @if ($errors->any())
      <div class="mb-4 text-sm text-red-600">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ url('/login') }}" method="POST" class="space-y-5">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="block mb-1 text-sm font-semibold text-gray-700">Email</label>
        <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-indigo-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0H6m2 0h8m4-6H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2z" />
          </svg>
          <input id="email" name="email" type="email" placeholder="you@gmail.com"
                 value="{{ old('email') }}"
                 required
                 class="w-full focus:outline-none text-sm text-gray-700">
        </div>
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block mb-1 text-sm font-semibold text-gray-700">Password</label>
        <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-indigo-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.621 0 1.21.118 1.757.33m4.243 2.67A7.965 7.965 0 0012 9c-2.21 0-4.21.896-5.657 2.343M15 19h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2.586a1 1 0 01-.707-.293l-1.414-1.414a1 1 0 00-.707-.293H10a1 1 0 00-1 1v1m0 0H7a2 2 0 00-2 2v2a2 2 0 002 2h2" />
          </svg>
          <input id="password" name="password" type="password" placeholder="••••••••"
                 required
                 class="w-full focus:outline-none text-sm text-gray-700">
        </div>
      </div>

      <!-- Tombol Login -->
      <button type="submit"
              class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-200 font-semibold">
        Login
      </button>

  
    </form>
  </div>

</body>
</html>
