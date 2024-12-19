<!-- resources/views/components/navbar.blade.php -->
<div class="relative z-50" x-data="{ 
    mobileMenuOpen: false,
    searchOpen: false,
    userMenuOpen: false,
    scrolled: false,
    searchQuery: '',
    showLogoutConfirm: false,
    
    toggleSearch() {
        this.searchOpen = !this.searchOpen;
        if (this.searchOpen) {
            this.$nextTick(() => {
                this.$refs.searchInput.focus();
            });
        }
    },
    
    handleSearch() {
        if (this.searchQuery.length > 0) {
            console.log('Searching for:', this.searchQuery);
        }
    }
}" @scroll.window="scrolled = window.pageYOffset > 20">

    <!-- Main Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
        :class="{ 'bg-white/90 shadow-sm backdrop-blur-lg': scrolled || mobileMenuOpen, 'bg-transparent': !scrolled && !mobileMenuOpen }">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between px-4 h-20">
                <!-- Logo -->
                <a href="{{ route('front.index') }}" class="group flex items-center space-x-2">
                    <span class="font-bold text-3xl text-gray-900 transform transition-transform group-hover:scale-105">
                        O M O !
                    </span>
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
                <div class="flex items-center gap-4">
                    <!-- Search Button -->
                    <button @click="toggleSearch"
                        class="p-2 hover:bg-blue-50 rounded-full transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Authentication Buttons for Guest -->
                    @guest
                    <div class="hidden md:flex items-center gap-3">
                        <!-- Login Button -->
                        <a href="{{ route('auth.login') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
                            Masuk
                        </a>
                        <!-- Register Button -->
                        <a href="{{ route('auth.register') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-blue-200">
                            Daftar
                        </a>
                    </div>
                    @endguest

                    <!-- User Menu for Authenticated Users -->
                    @auth
                    <div class="relative" x-data="{ 
                        open: false,
                        async toggleDropdown() {
                            if (!this.open) {
                                this.open = true;
                                await this.$nextTick();
                                this.$refs.dropdown.classList.add('dropdown-enter');
                            } else {
                                this.$refs.dropdown.classList.add('dropdown-leave');
                                setTimeout(() => {
                                    this.open = false;
                                    this.$refs.dropdown.classList.remove('dropdown-leave');
                                }, 300);
                            }
                        }
                    }">
                        <!-- Profile Button -->
                        <button @click="toggleDropdown()"
                            class="relative flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition-all duration-300 group">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full overflow-hidden ring-2 ring-white shadow-lg transition-all duration-300 group-hover:shadow-indigo-200">
                                    <img src="{{ Auth::user()->image }}" alt="{{ Auth::user()->name }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                </div>
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-semibold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 line-clamp-1">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 group-hover:text-blue-600"
                                    :class="{'rotate-180': open}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                            x-ref="dropdown"
                            @click.away="toggleDropdown()"
                            class="absolute right-0 mt-2 w-60 bg-white rounded-2xl shadow-xl py-2 ring-1 ring-black/5 transform origin-top"
                            style="display: none;">
                            
                            <div class="p-2 space-y-1">
                                <!-- Profile -->
                                <a href="{{ route('auth.profile') }}" 
                                    class="flex items-center gap-3 p-2.5 rounded-xl text-gray-700 hover:bg-blue-50 transition-all duration-300 group">
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium group-hover:text-blue-600 transition-colors duration-300">Profil Saya</p>
                                        <p class="text-xs text-gray-500">Kelola informasi personal</p>
                                    </div>
                                </a>

                                <!-- Orders -->
                                <a href="{{ route('front.check_booking') }}" 
                                    class="flex items-center gap-3 p-2.5 rounded-xl text-gray-700 hover:bg-purple-50 transition-all duration-300 group">
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-purple-50 text-purple-600 group-hover:bg-purple-100 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium group-hover:text-purple-600 transition-colors duration-300">Cek Pesanan</p>
                                        <p class="text-xs text-gray-500">Lihat status pesanan</p>
                                    </div>
                                </a>

                                <div class="h-px bg-gray-100 my-2"></div>

                                <!-- Logout Button -->
                                <button @click="showLogoutConfirm = true; open = false" 
                                    class="w-full flex items-center gap-3 p-2.5 rounded-xl text-gray-700 hover:bg-red-50 transition-all duration-300 group">
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 text-left">
                                        <p class="text-sm font-medium group-hover:text-red-600 transition-colors duration-300">Keluar</p>
                                        <p class="text-xs text-gray-500">Akhiri sesi anda</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 hover:bg-blue-50 rounded-full transition-all duration-300">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4" 
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-4"
                class="md:hidden border-t bg-white">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('front.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ request()->routeIs('front.index') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ request()->routeIs('front.category') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Kategori</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ request()->routeIs('front.support') ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Bantuan</span>
                    </a>

                    @guest
                    <div class="mt-4 grid grid-cols-2 gap-2 px-4">
                        <a href="{{ route('auth.login') }}"
                            class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-100 hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
                            Masuk
                        </a>
                        <a href="{{ route('auth.register') }}"
                            class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-blue-200">
                            Daftar
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Overlay -->
    <div x-show="searchOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape="searchOpen = false"
        class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm">
        <div class="container mx-auto px-4 pt-24" @click.away="searchOpen = false">
            <div class="bg-white rounded-2xl p-6 shadow-xl max-w-2xl mx-auto transform transition-all"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                <form @submit.prevent="handleSearch" class="relative">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" 
                            x-ref="searchInput"
                            x-model="searchQuery"
                            class="w-full text-sm outline-none placeholder-gray-400" 
                            placeholder="Cari produk fashion kesukaanmu..."
                            @keydown.enter="handleSearch">
                        <button type="button"
                            @click="searchOpen = false" 
                            class="p-2 hover:bg-gray-100 rounded-xl transition-all duration-300">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutConfirm" 
        x-cloak
        class="fixed inset-0 z-[60] overflow-y-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

        <!-- Dialog -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-md rounded-2xl shadow-xl p-6 text-center"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showLogoutConfirm = false">
                
                <!-- Logout Icon -->
                <div class="mx-auto flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>

                <!-- Content -->
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Konfirmasi Keluar
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    Apakah Anda yakin ingin keluar dari akun ini?
                </p>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button @click="showLogoutConfirm = false"
                        class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300">
                        Batal
                    </button>
                    <a href="{{ route('auth.logout') }}"
                        class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700 transition-all duration-300 hover:shadow-lg hover:shadow-red-200">
                        Ya, Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animations Style -->
<style>
    .nav-link {
        @apply relative text-gray-600 hover:text-blue-600 transition-all duration-500;
    }

    .nav-link::after {
        content: '';
        @apply absolute left-1/2 -translate-x-1/2 bottom-0 w-0 h-0.5 bg-blue-600 transition-all duration-500 ease-in-out;
    }

    .nav-link:hover::after {
        @apply w-full;
    }

    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-8px) scale(0.95);
        }
        70% {
            transform: translateY(2px) scale(1.01);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes slideUp {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-8px) scale(0.95);
        }
    }

    .dropdown-enter {
        animation: slideDown 0.4s ease-out forwards;
    }

    .dropdown-leave {
        animation: slideUp 0.3s ease-in forwards;
    }
</style>