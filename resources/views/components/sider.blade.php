<!-- Sidebar Container -->
<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl p-6 flex flex-col gap-6 z-50
  -translate-x-full md:translate-x-0 md:relative transition-transform duration-300 ease-in-out
  md:transform-none md:shadow-none border-r border-gray-200"
>
  <!-- Mobile Header -->
  <div class="flex justify-between items-center mb-6 md:hidden">
    <h1 class="text-3xl font-extrabold text-blue-600 tracking-wide drop-shadow-sm select-none">Admin Panel</h1>
    <button id="closeSidebar" aria-label="Close sidebar" 
      class="text-gray-700 hover:text-blue-600 transition-colors duration-300 focus:outline-none text-4xl font-extrabold leading-none transform hover:rotate-90 hover:scale-125">
      &times;
    </button>
  </div>

  <!-- Desktop Header -->
  <h1 class="text-3xl font-extrabold text-blue-600 mb-6 hidden md:block tracking-wide drop-shadow-sm select-none">
    Admin Panel
  </h1>

  <!-- Menu Links -->
  <a href="{{ route('admin.home') }}"
     class="menu-item {{ request()->routeIs('admin.home') ? 'active' : '' }}
     flex items-center gap-4 px-5 py-3 rounded-lg select-none cursor-pointer
     transition-all duration-300 ease-in-out hover:bg-blue-600 hover:text-white shadow-lg
     hover:scale-105 hover:shadow-blue-400"
  >
    <i data-lucide="home" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-12"></i>
    <span class="text-lg font-semibold">Home</span>
  </a>

  <a href="{{ route('admin.ruangans.index') }}"
     class="menu-item {{ request()->is('admin/ruangans*') ? 'active' : '' }}
     flex items-center gap-4 px-5 py-3 rounded-lg select-none cursor-pointer
     transition-all duration-300 ease-in-out hover:bg-blue-600 hover:text-white shadow-lg
     hover:scale-105 hover:shadow-blue-400"
  >
    <i data-lucide="door-open" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-12"></i>
    <span class="text-lg font-semibold">Ruangan</span>
  </a>

  <a href="{{ route('admin.users.index') }}"
     class="menu-item {{ request()->is('admin/users*') ? 'active' : '' }}
     flex items-center gap-4 px-5 py-3 rounded-lg select-none cursor-pointer
     transition-all duration-300 ease-in-out hover:bg-blue-600 hover:text-white shadow-lg
     hover:scale-105 hover:shadow-blue-400"
  >
    <i data-lucide="users" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-12"></i>
    <span class="text-lg font-semibold">User</span>
  </a>

  <!-- Spacer -->
  <div class="flex-grow"></div>

  <!-- Logout -->
  <form action="{{ route('logout') }}" method="POST" class="group">
    @csrf
    <button type="submit"
            class="w-full text-left text-gray-700 hover:bg-red-600 hover:text-white
            flex items-center gap-4 px-5 py-3 rounded-lg cursor-pointer
            transition-all duration-300 ease-in-out shadow-sm hover:shadow-red-400
            hover:scale-105 select-none"
    >
      <i data-lucide="log-out" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-12"></i>
      <span class="text-lg font-semibold">Logout</span>
    </button>
  </form>
</div>

<!-- Mobile Toggle Button -->
<button id="toggleSidebar" aria-label="Open sidebar"
  class="fixed top-6 right-6 z-60 md:hidden bg-blue-600 text-white p-3 rounded-full shadow-lg
  hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
  </svg>
</button>

<!-- Styles -->
<style>
  .menu-item.active {
    background-color: #2563eb;
    color: white !important;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.6);
    transform: scale(1.07);
  }

  .menu-item i {
    display: inline-block;
    transition: transform 0.3s ease;
  }

  .menu-item:hover i {
    transform: rotate(12deg);
  }
</style>

<!-- Script -->
<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('toggleSidebar');
  const closeBtn = document.getElementById('closeSidebar');

  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
    sidebar.classList.add('translate-x-0');
  });

  closeBtn?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    sidebar.classList.remove('translate-x-0');
  });

  window.addEventListener('click', e => {
    if (window.innerWidth < 768) {
      if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
      }
    }
  });
</script>
