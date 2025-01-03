
<div x-data="{ 
    isExpanded: true,
    isMobile: window.innerWidth < 768,
    activeRoute: window.location.pathname,
    hoveredItem: null
}" 
    @resize.window="
        isMobile = window.innerWidth < 768;
        if (!isMobile) isExpanded = true;
    "
    class="relative"
    @click.away="isMobile ? isExpanded = false : null">

    <div class="fixed top-20 h-[calc(100vh-5rem)] transition-all duration-500 ease-in-out bg-white border-r border-gray-100 shadow-sm pt-12 z-40"
        :class="{
            'w-64': !isMobile || isExpanded,
            'w-16': isMobile && !isExpanded,
            '-translate-x-full': isMobile && !isExpanded,
            'translate-x-0': !isMobile || isExpanded
        }">
        
        <button 
            x-show="isMobile"
            @click="isExpanded = !isExpanded"
            class="absolute top-3 bg-white border border-gray-200 rounded-full p-2 shadow-md hover:shadow-lg transition-all duration-300"
            :class="{ 
                '-right-3': isExpanded,
                '-right-10': !isExpanded,
                'rotate-180': !isExpanded
            }">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <nav class="p-2 space-y-1">
            <div class="relative group" 
                @mouseover="isMobile && !isExpanded ? hoveredItem = 'dashboard' : null" 
                @mouseleave="hoveredItem = null">
                <a href="{{ route('front.index') }}"
                    class="flex items-center group px-3 py-2.5 rounded-xl transition-all duration-300"
                    :class="{ 
                        'justify-center': isMobile && !isExpanded,
                        'bg-blue-50 text-blue-600': activeRoute === '/',
                        'hover:bg-gray-50 text-gray-600 hover:text-blue-600': activeRoute !== '/'
                    }">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 transform group-hover:scale-110"
                        :class="{ 
                            'bg-blue-50 text-blue-600': activeRoute === '/',
                            'text-gray-500 group-hover:text-blue-600': activeRoute !== '/'
                        }">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium truncate" 
                        x-show="!isMobile || isExpanded" 
                        x-transition>Beranda</span>
                </a>
                <div x-show="hoveredItem === 'dashboard' && !isExpanded && isMobile"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-2"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-2"
                    class="absolute left-full ml-3 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg whitespace-nowrap z-50"
                    style="top: 50%; transform: translateY(-50%)">
                    Beranda
                </div>
            </div>

            <div class="relative group" 
                @mouseover="isMobile && !isExpanded ? hoveredItem = 'profile' : null" 
                @mouseleave="hoveredItem = null">
                <a href="{{ route('auth.profile') }}"
                    class="flex items-center group px-3 py-2.5 rounded-xl transition-all duration-300"
                    :class="{ 
                        'justify-center': isMobile && !isExpanded,
                        'bg-blue-50 text-blue-600': activeRoute.includes('/profile'),
                        'hover:bg-gray-50 text-gray-600 hover:text-blue-600': !activeRoute.includes('/profile')
                    }">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg transition-all duration-300 transform group-hover:scale-110"
                        :class="{ 
                            'bg-blue-50 text-blue-600': activeRoute.includes('/profile'),
                            'text-gray-500 group-hover:text-blue-600': !activeRoute.includes('/profile')
                        }">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium truncate" 
                        x-show="!isMobile || isExpanded" 
                        x-transition>Edit Profile</span>
                </a>
                <div x-show="hoveredItem === 'profile' && !isExpanded && isMobile"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-2"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-2"
                    class="absolute left-full ml-3 px-3 py-2 bg-gray-800 text-white text-sm rounded-lg whitespace-nowrap z-50"
                    style="top: 50%; transform: translateY(-50%)">
                    Edit Profile
                </div>
            </div>
        </nav>
    </div>

    <div 
        x-show="isMobile && isExpanded"
        @click="isExpanded = false"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm z-30"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>
</div>