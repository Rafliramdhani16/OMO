<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'OMO!' }} - OhMyOutfit!</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        
        .initial-animate {
            opacity: 0;
            animation: smoothFadeUp 0.8s cubic-bezier(0.65, 0, 0.35, 1) forwards;
        }

        .card-enter {
            opacity: 0;
            animation: smoothCardEnter 0.8s cubic-bezier(0.65, 0, 0.35, 1) forwards;
        }

        @keyframes smoothFadeUp {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes smoothCardEnter {
            0% {
                transform: translateY(40px) scale(0.96);
                opacity: 0;
            }
            30% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .input-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .button-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .button-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(75, 85, 99, 0.25);
        }

        .button-hover:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(75, 85, 99, 0.25);
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }

        .forgot-password-link {
            transform-origin: left;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .forgot-password-link:active {
            transform: scale(0.98);
        }

        .button-back-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .button-back-hover:hover {
            transform: translateX(-4px);
        }

        @keyframes fadeInLeft {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in-left {
            animation: fadeInLeft 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-[Inter] min-h-screen">
    
    <x-notification />
    
    <div class="min-h-screen flex items-center justify-center p-4">
        <a href="{{ route('front.index') }}" 
           class="group flex items-center space-x-2 text-slate-700 hover:text-slate-800 transition-all duration-300 absolute top-6 left-6 initial-animate button-hover fade-in-left px-4 py-2 rounded-lg hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform duration-300" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Kembali</span>
        </a>

        <div class="flex flex-col lg:flex-row w-full max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden card-enter">
            
            <div class="hidden lg:block lg:w-1/2 relative">
                <img class="w-full h-full object-cover" 
                     src="{{ asset('image/LOOK1.jpg') }}" 
                     alt="Fashion Background">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
            </div>

            <div class="w-full lg:w-1/2 p-8 relative flex flex-col justify-center">
                <div class="space-y-6 initial-animate stagger-1 max-w-md mx-auto w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('success'))
                window.dispatchEvent(new CustomEvent('notification', { 
                    detail: { 
                        message: "{{ session('success') }}", 
                        type: 'success'
                    }
                }));
            @endif

            @if (session()->has('error'))
                window.dispatchEvent(new CustomEvent('notification', { 
                    detail: { 
                        message: "{{ session('error') }}", 
                        type: 'error'
                    }
                }));
            @endif
        });
    </script>
</body>
</html>

