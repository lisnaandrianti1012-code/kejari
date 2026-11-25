<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kejari Tasikmalaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl p-12 text-center">
        
        <img src="{{ asset('images/logo.png') }}" alt="Logo Kejari" class="w-32 mx-auto mb-6">
        
        <h1 class="text-3xl font-extrabold text-[#0b5d30] mb-2">Kejaksaan Negeri Kota Tasikmalaya</h1>
        <p class="text-gray-500 mb-10">Sistem Papan Kontrol Pegawai & Magang</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <a href="{{ route('admin.dashboard') }}" class="group block border-2 border-green-100 hover:border-[#0b5d30] bg-green-50 hover:bg-[#0b5d30] transition rounded-2xl p-8">
                <div class="w-16 h-16 bg-[#0b5d30] text-white group-hover:bg-white group-hover:text-[#0b5d30] rounded-full flex items-center justify-center mx-auto mb-4 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-[#0b5d30] group-hover:text-white mb-2">Panel Admin</h2>
                <p class="text-sm text-gray-600 group-hover:text-green-100">Kelola data kenaikan pangkat, gaji, dan anak magang.</p>
            </a>

            <a href="{{ route('display.index') }}" class="group block border-2 border-yellow-100 hover:border-[#facc15] bg-yellow-50 hover:bg-[#facc15] transition rounded-2xl p-8">
                <div class="w-16 h-16 bg-[#facc15] text-[#0b5d30] group-hover:bg-white rounded-full flex items-center justify-center mx-auto mb-4 transition shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-[#0b5d30] mb-2">Layar TV</h2>
                <p class="text-sm text-gray-700">Buka tampilan papan informasi (fullscreen) untuk ruang tunggu.</p>
            </a>

        </div>

    </div>
</body>
</html>
