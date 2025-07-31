<!DOCTYPE html>
<html lang="en" class="{{ session('dark_mode') === 'true' ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    keyframes: {
                        fadeUp: {
                            '0%': {
                                opacity: 0,
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: 1,
                                transform: 'translateY(0)'
                            },
                        }
                    },
                    animation: {
                        fadeUp: 'fadeUp 0.8s ease-out forwards',
                    }
                }
            }
        }
    </script>
    <style>
        html,
        body {
            height: 100%;
        }

        html {
            scroll-behavior: smooth;
        }

        .perspective {
            perspective: 1000px;
        }

        .transform-style-preserve-3d {
            transform-style: preserve-3d;
        }

        .backface-hidden {
            backface-visibility: hidden;
        }

        .rotate-y-180 {
            transform: rotateY(180deg);
        }
    </style>
<link rel="icon" type="image/png" href="{{ asset('ruangans/kemenag.png') }}">
    <script type="module">
        import {
            createIcons
        } from 'https://esm.sh/lucide';
        createIcons();
    </script>
</head>

<body
    class="min-h-screen flex flex-col transition duration-500 ease-in-out bg-gradient-to-br from-indigo-50 via-white to-with-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-x-hidden">




    <!-- 🔹 Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 h-16 bg-white dark:bg-gray-800 shadow">
        <x-navbar-user />
    </nav>

    <!-- 🔹 Main Content -->
    <main class="flex-grow pt-16 px-4">
        {{ $slot }}
    </main>

    <!-- 🔹 Footer -->
    <footer class="text-center py-6 text-sm text-gray-500 dark:text-gray-400 border-t mt-12">
        &copy; {{ date('Y') }} BookRoom
    </footer>

    <!-- 🔹 Dark Mode Toggle Script -->
    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('dark-mode', html.classList.contains('dark'));
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('dark-mode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>

</body>

</html>
