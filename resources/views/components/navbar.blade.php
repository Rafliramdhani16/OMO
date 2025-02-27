<!-- Main Navigation Bar -->
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
                    <img src="{{ asset('image/LOGOOMO.png') }}" alt="Logo" class="w-15 h-10">
                </a>

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
                        <a href="{{ route('auth.login') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
                            Masuk
                        </a>
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
                                    <img src="{{ Auth::user()->image }}" alt="{{ Auth::user()->fullname }}" 
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                </div>
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-semibold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ Auth::user()->fullname }}
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
                                @if(Auth::user()->hasRole('admin'))
                                <!-- Admin Dashboard Link -->
                                <a href="{{ url('/admin') }}"
                                    class="flex items-center gap-3 p-2.5 rounded-xl text-gray-700 hover:bg-indigo-50 transition-all duration-300 group">
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium group-hover:text-indigo-600 transition-colors duration-300">Dashboard Admin</p>
                                        <p class="text-xs text-gray-500">Kelola sistem</p>
                                    </div>
                                </a>
                                @endif

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
                                        <p class="text-sm font-medium group-hover:text-purple-600 transition-colors duration-300">Pesanan Saya</p>
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
                </div>
            </div>
        </div>
    </nav>

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

<!-- Search Overlay -->
<div x-show="searchOpen" 
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
@keydown.escape="searchOpen = false"
class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm"
x-data="{ 
searchQuery: '',
searchResults: [],
isLoading: false,

async performSearch() {
if (this.searchQuery.length < 2) {
    this.searchResults = [];
    return;
}

this.isLoading = true;
try {
    const response = await fetch(`/search?query=${encodeURIComponent(this.searchQuery)}`);
    const data = await response.json();
    this.searchResults = data;
} catch (error) {
    console.error('Search error:', error);
    this.searchResults = [];
}
this.isLoading = false;
}
}">

<div class="container mx-auto px-4 pt-24" @click.away="searchOpen = false">
<div class="bg-white rounded-2xl p-6 shadow-xl max-w-2xl mx-auto transform transition-all"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-4"
x-transition:enter-end="opacity-100 translate-y-0">

<!-- Search Input -->
<div class="relative">
    <div class="flex items-center gap-3 mb-4">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="text" 
            x-ref="searchInput"
            x-model="searchQuery"
            @input.debounce.300ms="performSearch()"
            class="w-full text-sm outline-none placeholder-gray-400" 
            placeholder="Cari produk fashion kesukaanmu...">
        <button type="button"
            @click="searchOpen = false" 
            class="p-2 hover:bg-gray-100 rounded-xl transition-all duration-300">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Loading Indicator -->
    <div x-show="isLoading" class="flex justify-center py-8">
        <div class="flex items-center justify-center space-x-2 text-blue-600">
            <div class="w-2 h-2 rounded-full bg-blue-600 animate-bounce [animation-delay:-0.3s]"></div>
            <div class="w-2 h-2 rounded-full bg-blue-600 animate-bounce [animation-delay:-0.15s]"></div>
            <div class="w-2 h-2 rounded-full bg-blue-600 animate-bounce"></div>
        </div>
    </div>

    <!-- Search Results -->
    <div x-show="!isLoading && searchResults.length > 0" 
        class="mt-4 divide-y divide-gray-100 max-h-[60vh] overflow-y-auto">
        <template x-for="product in searchResults" :key="product.id">
            <div class="group cursor-pointer" @click="window.location.href = product.url">
                <div class="flex items-center gap-4 p-4 hover:bg-blue-50 transition-all duration-300 rounded-xl">
                    <!-- Product Image -->
                    <div class="relative w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                        <img :src="'/storage/' + product.thumbnail" 
                            :alt="product.name"
                            class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-110">
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate group-hover:text-blue-600 transition-colors" 
                            x-text="product.name"></h4>
                        <div class="mt-1 flex items-center gap-2">
                            <span class="text-sm font-medium text-blue-600">
                                Rp <span x-text="new Intl.NumberFormat('id-ID').format(product.price)"></span>
                            </span>
                            <span class="text-xs text-gray-500">
                                Stock: <span x-text="product.stock"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- No Results -->
    <div x-show="!isLoading && searchQuery.length >= 2 && searchResults.length === 0" 
        class="py-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-gray-500 text-sm">Tidak ada hasil yang ditemukan untuk pencarian ini.</p>
    </div>
</div>
</div>
</div>
</div>
</div>

<!-- Animations Style -->
<style>
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

