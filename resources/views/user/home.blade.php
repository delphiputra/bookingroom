<x-layout-user>
    <!-- 🔹 Hero Section -->
    <section
        class="pt-28 pb-16 text-center px-6 animate-fadeUpScale bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"
        style="animation-delay: 0.1s"
    >
        <h2 class="text-4xl md:text-5xl font-extrabold text-blue-800 dark:text-white leading-tight mb-4">
            Selamat Datang, {{ session('user_name') }} 👋
        </h2>
        <p class="text-gray-600 dark:text-gray-300 text-lg max-w-xl mx-auto mb-6">
            Silakan pilih ruangan yang tersedia untuk dibooking sesuai kebutuhanmu.
        </p>
        <a href="{{ route('user.booking.index') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold shadow-lg transition transform hover:scale-105">
            🚀 Booking Sekarang
        </a>
    </section>

    <!-- 🔹 Ruangan Section -->
    <section class="relative z-10 py-24 px-6 bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-slate-900 overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-5 dark:opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl mb-6 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-700 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Ruangan yang Tersedia
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Temukan ruangan yang sempurna untuk kebutuhan Anda dengan fasilitas terlengkap dan kualitas terbaik
            </p>
        </div>

        @php
            $countRuangans = $ruangans->count();
        @endphp

        <!-- Room Cards Container -->
        <div class="max-w-7xl mx-auto">
            @if($countRuangans > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
                    @foreach ($ruangans as $ruangan)
                        <div class="group w-full max-w-sm bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl border border-white/20 dark:border-gray-700/50 transition-all duration-500 hover:-translate-y-2 animate-fadeUpScale"
                             style="animation-delay: {{ $loop->index * 0.15 }}s">
                            
                            <!-- Image Container -->
                            <div class="relative overflow-hidden">
                                @if ($ruangan->image && file_exists(public_path('storage/ruangans/' . $ruangan->image)))
                                    <img src="{{ asset('storage/ruangans/' . $ruangan->image) }}"
                                         alt="{{ $ruangan->title }}"
                                         class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110" />
                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                @else
                                    <div class="w-full h-56 flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-gray-700 dark:to-gray-600">
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">No Image Available</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Status badge -->
                                
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                                    {{ $ruangan->title }}
                                </h3>

                                <!-- Description -->
                                @if($ruangan->description)
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6 line-clamp-3">
                                        {{ Str::limit($ruangan->description, 120) }}
                                    </p>
                                @endif

                                <!-- Action Button -->
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('user.ruangans.show', $ruangan->id) }}"
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 group/btn">
                                        <span class="mr-2">Detail Ruangan</span>
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                    
                                    <!-- Quick info -->
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load more section if needed -->
                @if($countRuangans > 6)
                    <div class="text-center mt-12">
                        <button class="inline-flex items-center px-8 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 font-semibold rounded-2xl shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300">
                            <span class="mr-2">Lihat Semua Ruangan</span>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-lg text-sm">
                                {{ $countRuangans }}
                            </span>
                        </button>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Belum Ada Ruangan</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                        Saat ini belum ada ruangan yang tersedia. Silakan cek kembali nanti atau hubungi administrator.
                    </p>
                    <div class="flex justify-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

   <style>
/* Custom animations */
@keyframes fadeUpScale {
    0% {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

@keyframes pulse-custom {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-fadeUpScale {
    animation-name: fadeUpScale;
    animation-duration: 0.9s;
    animation-fill-mode: forwards;
    animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
}

.animate-blob {
    animation: blob 7s infinite;
}

.animate-pulse-custom {
    animation: pulse-custom 1.5s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Enhanced hover effects */
.group:hover {
    box-shadow:
        0 4px 15px rgba(59, 130, 246, 0.5),
        0 0 15px rgba(59, 130, 246, 0.3);
    transform: scale(1.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

a:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(59, 130, 246, 0.6);
    transition: all 0.3s ease;
}

/* Line clamp utility */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Scrollbar hide */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
    scroll-behavior: smooth;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
</x-layout-user>
