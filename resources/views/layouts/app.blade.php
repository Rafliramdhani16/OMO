<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('output.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
        .nav-link {
            @apply relative text-gray-600 hover:text-blue-600 transition-colors;
        }
        .nav-link::after {
            content: '';
            @apply absolute left-0 bottom-0 w-0 h-0.5 bg-blue-600 transition-all duration-300;
        }
        .nav-link:hover::after {
            @apply w-full;
        }
        .card-hover {
            @apply relative overflow-hidden;
        }
        .card-hover::after {
            content: '';
            @apply absolute inset-0 opacity-0 bg-gradient-to-t from-black/20 to-transparent transition-opacity duration-300;
        }
        .card-hover:hover::after {
            @apply opacity-100;
        }
    </style>
</head>

<body class="bg-gray-50" x-data="{ 
    mobileMenuOpen: false,
    searchOpen: false,
    userMenuOpen: false,
    scrolled: false
}" x-cloak @scroll.window="scrolled = window.pageYOffset > 20">

    <!-- Top Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 backdrop-blur-lg pb-4"
         :class="{ 'bg-white/80 shadow-sm': scrolled || mobileMenuOpen, 'bg-transparent': !scrolled && !mobileMenuOpen }">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between px-4 h-16 py-6">
                <!-- Logo -->
                <a href="{{ route('front.index') }}" class="font-bold text-3xl">
                    O M O !
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('front.index') }}" 
                       class="nav-link text-sm font-medium {{ request()->routeIs('front.index') ? 'text-blue-600 after:w-full' : '' }}">
                       Beranda
                    </a>
                    <a href="#" 
                       class="nav-link text-sm font-medium {{ request()->routeIs('front.category') ? 'text-blue-600 after:w-full' : '' }}">
                       Kategori
                    </a>
                    <a href="#" 
                       class="nav-link text-sm font-medium {{ request()->routeIs('front.support') ? 'text-blue-600 after:w-full' : '' }}">
                       Bantuan
                    </a>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center gap-3">
                    <!-- Search -->
                    <button @click="searchOpen = !searchOpen" 
                            class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    <!-- Cart -->
                    <a href="{{ route('front.check_booking') }}" 
                       class="p-2 hover:bg-gray-100 rounded-full transition-colors relative {{ request()->routeIs('front.check_booking') ? 'text-blue-600' : 'text-gray-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">0</span>
                    </a>

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center gap-2 p-1 hover:bg-gray-100 rounded-full transition-colors">
                            <div class="w-7 h-7 bg-gray-200 rounded-full overflow-hidden">
                                <img src="/api/placeholder/32/32" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <hr class="my-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="md:hidden p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden border-t bg-white">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('front.index') }}" 
                       class="block py-2 text-sm {{ request()->routeIs('front.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                       Beranda
                    </a>
                    <a href="#" 
                       class="block py-2 text-sm {{ request()->routeIs('front.category') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                       Kategori
                    </a>
                    <a href="#" 
                       class="block py-2 text-sm {{ request()->routeIs('front.support') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }} rounded-lg">
                       Bantuan
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Overlay -->
    <div x-show="searchOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-cloak
         @keydown.escape.window="searchOpen = false"
         class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm">
        <div class="container mx-auto px-4 pt-24">
            <div class="bg-white rounded-xl p-4 shadow-xl max-w-2xl mx-auto">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" 
                           class="w-full text-sm outline-none" 
                           placeholder="Cari produk..."
                           @keydown.escape="searchOpen = false"
                           autofocus>
                    <button @click="searchOpen = false" 
                            class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-50 to-indigo-50 mt-auto">
        <div class="border-t py-6 text-center text-sm text-gray-600">
            <p>&copy; 2024 OhMyOutfit!. Hak cipta dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>