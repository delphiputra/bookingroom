<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="icon" type="image/png" href="{{ asset('ruangans/kemenag.png') }}">
  <script src="https://unpkg.com/lucide@latest"></script>


</head>
<body class="bg-gray-100">

  <div class="relative min-h-screen flex">

    {{-- Sidebar --}}
    <x-sider></x-sider>

    {{-- Main Content --}}
    <main id="mainContent" class="flex-1 p-6 transition-all duration-300 ease-in-out">
      {{ $slot }}
    </main>

  </div>

  <script>
    lucide.createIcons();
  </script>

</body>
</html>
