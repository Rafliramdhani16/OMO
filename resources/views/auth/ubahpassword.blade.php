<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row w-full max-w-4xl">
        <div class="md:w-1/2">
            <img class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
                src="C:\OMO\img\LOOK3.jpg" alt="" />
        </div>
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-4">OMO !</h1>
            <h2 class="text-lg mb-6">Masukkan Password Baru</h2>
            @if (session()->has('error'))
            <p>{{ session('error') }}</p>
            @elseif(session()->has('success'))
            <p>{{ session('success') }}</p>
            @endif
            <form method="POST" action="{{ route('auth.reset') }}">
                @csrf
                <input type="hidden" value="{{ $token }}" name="token" required>
                <input type="hidden" value="{{ $email }}" name="email" required>

                <div class="mb-4">
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Password Baru" type="password" name="password" required />
                    @error('password')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Konfirmasi Password" type="password" name="password2" required />
                    @error('password2')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <button class="w-full py-2 px-4 bg-black text-white rounded-md shadow-md hover:bg-gray-800"
                    type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>