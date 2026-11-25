<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Papan Kontrol Kejari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4 relative overflow-hidden z-0">
    
    <!-- Ornamen Latar Belakang Modern (Blurred Blobs) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[60%] rounded-full bg-gradient-to-br from-[#0b5d30] to-green-400 opacity-20 blur-[100px] animate-pulse"></div>
        <div class="absolute top-[40%] -right-[10%] w-[60%] h-[70%] rounded-full bg-gradient-to-br from-[#facc15] to-yellow-300 opacity-20 blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl flex flex-col md:flex-row w-full max-w-4xl overflow-hidden border border-white/50 relative z-10">
        
        <!-- Sisi Kiri / Atas (Branding) -->
        <div class="bg-[#0b5d30] md:w-1/2 p-8 flex flex-col justify-center items-center text-center text-white">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Kejaksaan" class="w-32 h-32 mb-4 drop-shadow-md">
            <h2 class="text-3xl font-extrabold uppercase tracking-wide mb-2">Kejaksaan Negeri</h2>
            <h3 class="text-2xl font-bold text-[#facc15] mb-4">Kota Tasikmalaya</h3>
            <p class="text-gray-200">Panel Admin Pengelolaan Papan Informasi Pegawai & Magang</p>
        </div>

        <!-- Sisi Kanan / Bawah (Form) -->
        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Login Admin</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0b5d30] focus:border-[#0b5d30] outline-none transition"
                        placeholder="adminkejaritasik@gmail.com" value="{{ old('email') }}">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <input :type="show ? 'text' : 'password'" name="password" id="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0b5d30] focus:border-[#0b5d30] outline-none transition"
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 hover:text-[#0b5d30] focus:outline-none transition">
                            <!-- Icon Mata Terbuka (Lihat) -->
                            <svg x-show="!show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <!-- Icon Mata Tertutup (Sembunyikan) -->
                            <svg x-show="show" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0b5d30] text-white font-bold py-3 rounded-lg hover:bg-[#094d28] transition shadow-lg">
                    MASUK
                </button>
            </form>
            
            <div class="mt-6 text-center text-sm text-gray-500">
                <a href="{{ route('display.index') }}" class="hover:text-[#0b5d30] hover:underline">&larr; Kembali ke Layar TV</a>
            </div>
        </div>

    </div>

</body>
</html>
