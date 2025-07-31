<!-- Navbar -->
<nav
    class="fixed w-full z-50 px-8 py-4 bg-white/70 backdrop-blur-md shadow-lg flex justify-between items-center dark:bg-gray-900/70 transition-colors duration-300">
    <!-- Logo -->
    <!-- 🔹 Logo -->
    <h1 class="text-2xl font-bold text-blue-700 dark:text-white tracking-wide">📘 BookRoom</h1>

    <!-- Desktop Menu -->
    <div class="hidden lg:flex gap-10 text-sm font-semibold text-blue-900 dark:text-white">
        <a href="{{ route('user.home') }}"
            class="relative group px-2 py-1 transition-colors duration-300
        {{ request()->routeIs('user.home') ? 'text-blue-700 dark:text-white font-bold' : 'hover:text-blue-600 dark:hover:text-blue-400' }}">
            🏠 Home
            <span
                class="absolute left-0 -bottom-1 h-0.5 w-full bg-blue-700 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300 {{ request()->routeIs('user.home') ? 'scale-x-100' : '' }}">
            </span>
        </a>
        <a href="{{ route('user.booking.index') }}"
            class="relative group px-2 py-1 transition-colors duration-300
        {{ request()->routeIs('user.booking.index') ? 'text-blue-700 dark:text-white font-bold' : 'hover:text-blue-600 dark:hover:text-blue-400' }}">
            📅 Booking
            <span
                class="absolute left-0 -bottom-1 h-0.5 w-full bg-blue-700 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300 {{ request()->routeIs('user.booking.index') ? 'scale-x-100' : '' }}">
            </span>
        </a>
        <a href="{{ route('user.waitinglist.index') }}"
            class="relative group px-2 py-1 transition-colors duration-300
        {{ request()->routeIs('user.waitinglist.index') ? 'text-blue-700 dark:text-white font-bold' : 'hover:text-blue-600 dark:hover:text-blue-400' }}">
            ⏳ Waiting List
            <span
                class="absolute left-0 -bottom-1 h-0.5 w-full bg-blue-700 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300 {{ request()->routeIs('user.waitinglist.index') ? 'scale-x-100' : '' }}">
            </span>
        </a>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-5 lg:gap-8">
        <!-- Dark Mode Button -->
        <button onclick="toggleDarkMode()"
            class="hidden lg:inline-flex items-center gap-2 px-5 py-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white transition duration-300 shadow-sm select-none">
            🌓 Mode
        </button>

        <!-- User Dropdown -->
        <div class="relative hidden lg:block">
            <button onclick="toggleDropdown()"
                class="flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-white font-semibold shadow-md hover:shadow-lg transition-shadow duration-300 focus:outline-none">
                👤 {{ session('user_name') ?? 'Guest' }}
                <svg class="w-5 h-5 transform transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20"
                    id="dropdownArrow">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.1 1.02l-4.25 4.65a.75.75 0 01-1.1 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="userDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 translate-y-2 transition-all duration-300">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-800 dark:text-white dark:hover:bg-red-700 rounded-b-lg transition">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Hamburger (Mobile) -->
        <button onclick="toggleMobileMenu()"
            class="lg:hidden relative w-10 h-10 flex flex-col justify-center items-center gap-2 group focus:outline-none">
            <span
                class="block w-7 h-0.5 bg-blue-800 dark:bg-white rounded transition-transform duration-300 group-hover:bg-blue-600 dark:group-hover:bg-blue-400"
                id="bar1"></span>
            <span
                class="block w-7 h-0.5 bg-blue-800 dark:bg-white rounded transition-opacity duration-300 group-hover:bg-blue-600 dark:group-hover:bg-blue-400"
                id="bar2"></span>
            <span
                class="block w-7 h-0.5 bg-blue-800 dark:bg-white rounded transition-transform duration-300 group-hover:bg-blue-600 dark:group-hover:bg-blue-400"
                id="bar3"></span>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu"
    class="lg:hidden hidden px-6 py-4 bg-white dark:bg-gray-900 shadow-lg rounded-b-xl mt-[70px] space-y-4">
    <a href="{{ route('user.home') }}"
        class="flex items-center gap-3 px-4 py-2 rounded-md text-blue-800 dark:text-white hover:bg-blue-100 dark:hover:bg-gray-700 transition font-semibold
    {{ request()->routeIs('user.home') ? 'bg-blue-50 dark:bg-gray-700' : '' }}">
        🏠 Home
    </a>
    <a href="{{ route('user.booking.index') }}"
        class="flex items-center gap-3 px-4 py-2 rounded-md text-blue-800 dark:text-white hover:bg-blue-100 dark:hover:bg-gray-700 transition font-semibold
    {{ request()->routeIs('user.booking.index') ? 'bg-blue-50 dark:bg-gray-700' : '' }}">
        📅 Booking
    </a>
    <a href="{{ route('user.waitinglist.index') }}"
        class="flex items-center gap-3 px-4 py-2 rounded-md text-blue-800 dark:text-white hover:bg-blue-100 dark:hover:bg-gray-700 transition font-semibold
    {{ request()->routeIs('user.waitinglist.index') ? 'bg-blue-50 dark:bg-gray-700' : '' }}">
        ⏳ Waiting List
    </a>

    <button onclick="toggleDarkMode()"
        class="w-full flex items-center gap-3 px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition font-semibold">
        🌓 Mode
    </button>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="w-full flex items-center gap-3 px-4 py-2 rounded-md bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-800 dark:text-white dark:hover:bg-red-700 transition font-semibold">
            🚪 Logout
        </button>
    </form>
</div>

<!-- Script -->
<script>
    // Toggle User Dropdown with arrow rotate
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        const arrow = document.getElementById('dropdownArrow');
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) {
            dropdown.style.opacity = '1';
            dropdown.style.transform = 'translateY(0)';
            arrow.style.transform = 'rotate(180deg)';
        } else {
            dropdown.style.opacity = '0';
            dropdown.style.transform = 'translateY(8px)';
            arrow.style.transform = 'rotate(0deg)';
        }
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = event.target.closest('button[onclick="toggleDropdown()"]');
        if (dropdown && !dropdown.contains(event.target) && !button) {
            dropdown.classList.add('hidden');
            dropdown.style.opacity = '0';
            dropdown.style.transform = 'translateY(8px)';
            document.getElementById('dropdownArrow').style.transform = 'rotate(0deg)';
        }
    });

    // Toggle Mobile Menu with hamburger animation
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');

        menu.classList.toggle('hidden');

        if (!menu.classList.contains('hidden')) {
            bar1.style.transform = 'rotate(45deg) translate(5px, 5px)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'rotate(-45deg) translate(5px, -5px)';
        } else {
            bar1.style.transform = 'rotate(0) translate(0, 0)';
            bar2.style.opacity = '1';
            bar3.style.transform = 'rotate(0) translate(0, 0)';
        }
    }

    // Toggle Dark Mode
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
    }
</script>
