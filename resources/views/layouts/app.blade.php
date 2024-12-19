<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('output.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @if (!request()->is('order/booking'))
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

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

        /* Enhanced Navigation Animation */
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

        
        .dropdown-enter {
            @apply transition-all duration-500 ease-in-out;
            animation: dropdownEnter 0.5s ease-in-out forwards;
        }

        .dropdown-leave {
            @apply transition-all duration-300 ease-in-out;
            animation: dropdownLeave 0.3s ease-in-out forwards;
        }

        @keyframes dropdownEnter {
            0% {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            50% {
                transform: scale(1.02) translateY(0);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes dropdownLeave {
            0% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            100% {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
        }

        
        .menu-item {
            @apply relative flex items-center gap-3 px-4 py-3 text-sm transition-all duration-300;
        }

        .menu-item::before {
            content: '';
            @apply absolute left-0 top-0 h-full w-0 bg-gradient-to-r from-blue-50 to-transparent transition-all duration-500 ease-in-out;
        }

        .menu-item:hover::before {
            @apply w-full;
        }

        .menu-item-icon {
            @apply relative z-10 transition-transform duration-300;
        }

        .menu-item:hover .menu-item-icon {
            @apply transform scale-110;
        }

        
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        
        .search-overlay {
            @apply transition-all duration-500 ease-in-out;
        }

        .search-content {
            @apply transition-all duration-500 ease-in-out;
            transform: translateY(20px);
            opacity: 0;
        }

        .search-overlay.active .search-content {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 fade-in" x-data="{
    mobileMenuOpen: false,
    searchOpen: false,
    userMenuOpen: false,
    scrolled: false
}" x-cloak @scroll.window="scrolled = window.pageYOffset > 20">


        @include('components.navbar')


    
    <main class="flex-grow mt-20">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('fade-in');
            
            
            const searchOverlay = document.querySelector('.search-overlay');
            if (searchOverlay) {
                setTimeout(() => {
                    searchOverlay.classList.add('active');
                }, 100);
            }
        });

        
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 20) {
                nav?.classList.add('shadow-lg');
            } else {
                nav?.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>