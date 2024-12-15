<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>OMO! Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .hoverable-link:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="flex flex-col md:flex-row w-full h-full">
        <div class="hidden lg:block lg:w-1/2 h-full">
            <img class="w-full h-full object-cover" height="800" src="C:\Kelompok1\OMO\public\image\LOOK1.jpg"
                width="600" />
        </div>
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <h1 class="text-4xl font-bold mb-4">OMO !</h1>
                <p class="mb-6">Masuk ke OMO !</p>
                @if (session()->has('error'))
                <p>{{ session('error') }}</p>
                @elseif(session()->has('success'))
                <p>{{ session('success') }}</p>
                @endif
                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <div class="mb-4">
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
                            placeholder="Email" type="email" name="email" required />
                        @error('email')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 relative">
                        <input id="password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
                            placeholder="Password" type="password" name="password" required />
                        <i id="togglePassword"
                            class="fas fa-eye absolute right-4 top-2.5 text-gray-500 cursor-pointer"></i>
                        @error('password')
                        <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Masuk
                    </button>
                </form>
                <div class="flex justify-between mt-4">
                    <a class="text-blue-600 hoverable-link" href="#">Daftar Sekarang</a>
                    <a class="text-blue-600 hoverable-link" href="#">Lupa Password</a>
                </div>
                <p class="mt-8 text-gray-500 text-center">
                    OhMyOutfit! | Copyright 2024
                </p>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
            const password = document.getElementById("password");

            togglePassword.addEventListener("click", function () {
                const type =
                    password.getAttribute("type") === "password"
                        ? "text"
                        : "password";
                password.setAttribute("type", type);
                this.classList.toggle("fa-eye-slash");
            });
    </script>
</body>

</html>