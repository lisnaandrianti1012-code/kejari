<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Papan Kontrol Kejaksaan Negeri Kota Tasikmalaya</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(156, 163, 175, 0.3); border-radius: 9999px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(107, 114, 128, 0.5); }
        .sidebar-gold-scrollbar::-webkit-scrollbar { width: 5px; height: 5px; }
        .sidebar-gold-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .sidebar-gold-scrollbar::-webkit-scrollbar-thumb { background: rgba(6, 59, 30, 0.2); border-radius: 9999px; }
        .sidebar-gold-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(6, 59, 30, 0.35); }

        /* Custom SweetAlert2 Kejari Theme */
        .swal2-popup.kejari-swal {
            border-radius: 1.25rem !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
            padding: 1.75rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .swal2-title.kejari-swal-title {
            font-size: 1.25rem !important;
            font-weight: 800 !important;
            color: #1e293b !important;
        }
        .swal2-html-container.kejari-swal-html {
            font-size: 0.875rem !important;
            color: #64748b !important;
            line-height: 1.5 !important;
        }
    </style>
</head>
<body class="bg-[#FAF7F2] text-slate-800 antialiased" x-data="{ sidebarOpen: false }">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-cloak x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar Kuning Emas -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] text-[#063b1e] flex flex-col transition-all duration-300 ease-in-out transform lg:relative lg:translate-x-0 shadow-2xl border-r border-[#c48405]/30">
            
            <!-- Identitas & Logo (Sidebar Kuning Emas dengan Teks Hijau Tua) -->
            <div class="p-5 flex items-center gap-3.5 bg-black/5 border-b border-black/10 shadow-xs">
                <div class="p-2 bg-white/80 backdrop-blur-sm rounded-xl border border-white/80 shadow-xs flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Kejari" class="w-10 h-10 object-contain drop-shadow-xs">
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-1.5">
                        <span class="text-base font-extrabold tracking-wider text-[#063b1e] uppercase">KEJARI</span>
                        <span class="text-[10px] uppercase font-bold px-1.5 py-0.5 rounded bg-[#063b1e] text-amber-300 border border-[#063b1e]/40 shadow-xs">Admin</span>
                    </div>
                    <div class="text-xs font-bold text-[#063b1e] truncate tracking-wide">Kota Tasikmalaya</div>
                    <div class="text-[11px] text-[#063b1e]/80 font-medium truncate">Papan Kontrol Informasi</div>
                </div>
            </div>

            <!-- Navigasi Menu -->
            <nav class="flex-grow p-4 space-y-6 overflow-y-auto sidebar-gold-scrollbar">
                
                <!-- Grup Menu Utama -->
                <div>
                    <p class="px-3 mb-2 text-[11px] font-bold tracking-wider text-[#063b1e]/75 uppercase">Menu Utama</p>
                    <ul class="space-y-1.5 text-sm font-medium">
                        
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.dashboard') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Kenaikan Pangkat -->
                        <li>
                            <a href="{{ route('admin.pangkat') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.pangkat') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.pangkat') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                <span>Kenaikan Pangkat</span>
                            </a>
                        </li>

                        <!-- Kenaikan Gaji -->
                        <li>
                            <a href="{{ route('admin.gaji') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.gaji') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.gaji') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>Kenaikan Gaji Berkala</span>
                            </a>
                        </li>

                        <!-- Data Magang -->
                        <li>
                            <a href="{{ route('admin.magang') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.magang') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.magang') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                                </svg>
                                <span>Data Magang</span>
                            </a>
                        </li>

                        <!-- Kehadiran Pegawai -->
                        <li>
                            <a href="{{ route('admin.kehadiran') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.kehadiran') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.kehadiran') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Kehadiran Pegawai</span>
                            </a>
                        </li>

                        <!-- Musik Latar TV -->
                        <li>
                            <a href="{{ route('admin.musik') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.musik*') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.musik*') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                </svg>
                                <span>Musik Latar TV</span>
                            </a>
                        </li>

                        <!-- Rekapitulasi -->
                        <li>
                            <a href="{{ route('admin.rekapitulasi') }}" 
                               class="group flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 border-l-4 {{ request()->routeIs('admin.rekapitulasi') ? 'border-amber-300 bg-[#063b1e] text-white font-bold shadow-md shadow-[#063b1e]/25' : 'border-transparent text-[#063b1e] font-semibold hover:text-[#042814] hover:bg-[#063b1e]/10 hover:border-[#063b1e]/40 hover:translate-x-1' }}">
                                <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 {{ request()->routeIs('admin.rekapitulasi') ? 'text-white' : 'text-[#063b1e] group-hover:text-[#042814]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Rekapitulasi Laporan</span>
                            </a>
                        </li>

                    </ul>
                </div>

            </nav>

            <!-- Bottom Action: Buka Layar TV -->
            <div class="p-4 bg-black/10 border-t border-black/10 space-y-2">
                <a href="{{ route('display.index') }}" target="_blank" 
                   class="flex items-center justify-center gap-2.5 w-full bg-[#063b1e] hover:bg-[#042814] text-white font-bold px-4 py-2.5 rounded-xl text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 border border-[#042814]/40 group">
                    <svg class="w-5 h-5 text-amber-300 group-hover:text-amber-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Buka TV Display</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">
            
            <!-- Topbar / Header Fungsional -->
            <header class="bg-[#FFFDF9]/95 backdrop-blur-sm border-b border-[#EAE3D5] px-4 md:px-6 py-3 flex items-center justify-between z-20 shadow-xs">
                
                <!-- Sisi Kiri: Hamburger + Judul Halaman -->
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="text-slate-600 hover:text-[#063b1e] p-1.5 rounded-lg hover:bg-[#F2ECE0] focus:outline-none lg:hidden transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800 leading-tight">
                            @yield('header_title', 'Halaman Admin')
                        </h2>
                        <p class="text-xs text-slate-400 hidden sm:block">Panel Kontrol Kejaksaan Negeri Kota Tasikmalaya</p>
                    </div>
                </div>
                
                <!-- Sisi Kanan: Real-Time Widget + Notifikasi + Profil Admin -->
                <div class="flex items-center gap-2 sm:gap-4">
                    
                    <!-- Widget Tanggal & Jam Real-Time -->
                    <div class="hidden lg:flex items-center gap-3 px-3 py-1.5 bg-[#F5F1E8] border border-[#E5DFD0] rounded-xl text-xs text-slate-700">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#063b1e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span id="header-date" class="font-medium text-slate-700">Memuat tanggal...</span>
                        </div>
                        <span class="text-slate-300">|</span>
                        <div class="flex items-center gap-1.5 font-mono font-semibold text-[#063b1e]">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#063b1e]"></span>
                            </span>
                            <span id="header-clock">--:--:--</span>
                        </div>
                    </div>

                    <!-- Notifikasi Dropdown -->
                    <div class="relative" x-data="{ notifOpen: false }">
                        <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false" 
                                class="relative p-2 rounded-xl text-slate-500 hover:text-[#063b1e] hover:bg-[#F2ECE0] transition focus:outline-none"
                                title="Notifikasi Sistem">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <!-- Badge dot -->
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#063b1e] rounded-full ring-2 ring-white"></span>
                        </button>

                        <!-- Panel Notifikasi -->
                        <div x-show="notifOpen" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 mt-2 w-72 sm:w-80 bg-white rounded-2xl shadow-xl py-2 border border-slate-100 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Status Sistem & Notifikasi</span>
                                <span class="text-[10px] bg-emerald-100 text-emerald-800 font-semibold px-2 py-0.5 rounded-full">Aktif</span>
                            </div>
                            <div class="divide-y divide-slate-100 text-xs">
                                <div class="px-4 py-3 hover:bg-slate-50 transition">
                                    <div class="font-semibold text-slate-800 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        TV Display Terhubung
                                    </div>
                                    <p class="text-slate-500 text-[11px] mt-0.5">Layar publik siap menampilkan data kenaikan pangkat, gaji, & magang.</p>
                                </div>
                                <div class="px-4 py-3 hover:bg-slate-50 transition">
                                    <div class="font-semibold text-slate-800 flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Sinkronisasi Real-Time
                                    </div>
                                    <p class="text-slate-500 text-[11px] mt-0.5">Perubahan data yang disimpan di admin langsung terupdate otomatis.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- Profil Admin Dropdown -->
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center gap-2.5 p-1.5 pr-2.5 rounded-xl hover:bg-[#F2ECE0] focus:outline-none transition group">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#063b1e] to-[#042814] text-amber-300 flex items-center justify-center font-bold text-sm shadow-sm ring-2 ring-[#063b1e]/20 group-hover:ring-[#063b1e]/40 transition">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="text-left hidden sm:block">
                                <div class="text-xs font-bold text-slate-800 leading-tight">
                                    {{ Auth::user()->name ?? 'Admin Kejari' }}
                                </div>
                                <div class="text-[11px] font-medium text-[#0b5d30]">Administrator</div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl py-1.5 border border-slate-100 z-50">
                            <div class="px-4 py-3 border-b border-slate-100 bg-[#FAF7F2] rounded-t-2xl">
                                <p class="text-[11px] font-medium text-slate-400">Akun Login</p>
                                <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                                <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email ?? 'adminkejaritasik@gmail.com' }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('display.index') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-xs text-slate-700 hover:bg-[#FAF7F2] hover:text-[#063b1e] transition">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <span>Tinjau TV Display</span>
                                </a>
                            </div>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-xs font-medium text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Logout Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <!-- Content Area (Putih Krem) -->
            <main class="flex-1 p-4 md:p-6 overflow-y-auto bg-[#FAF7F2] custom-scrollbar">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- Script Jam & Tanggal Indonesia -->
    <script>
        function updateClockAndDate() {
            const now = new Date();
            
            // Format Jam (HH:mm:ss)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const clockEl = document.getElementById('header-clock');
            if (clockEl) {
                clockEl.textContent = `${hours}:${minutes}:${seconds} WIB`;
            }

            // Format Tanggal Indonesia
            const hariNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const hari = hariNames[now.getDay()];
            const tanggal = now.getDate();
            const bulan = bulanNames[now.getMonth()];
            const tahun = now.getFullYear();

            const dateEl = document.getElementById('header-date');
            if (dateEl) {
                dateEl.textContent = `${hari}, ${tanggal} ${bulan} ${tahun}`;
            }

            // Banner date jika ada
            const bannerDateEl = document.getElementById('banner-date');
            if (bannerDateEl) {
                bannerDateEl.textContent = `${hari}, ${tanggal} ${bulan} ${tahun}`;
            }
        }

        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();
    </script>

    <!-- Global SweetAlert2 & Helper Scripts -->
    <script>
        function confirmDelete(event, formOrButton, itemName = 'data ini') {
            event.preventDefault();
            const form = formOrButton.tagName === 'FORM' ? formOrButton : formOrButton.closest('form');
            
            Swal.fire({
                title: 'Hapus Data?',
                html: `Apakah Anda yakin ingin menghapus <b>${itemName}</b>?<br><span class="text-xs text-slate-400 mt-1 block">Tindakan ini permanen dan tidak dapat dibatalkan.</span>`,
                icon: 'warning',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: '<span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg><span>Ya, Hapus!</span></span>',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'kejari-swal',
                    title: 'kejari-swal-title',
                    htmlContainer: 'kejari-swal-html',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-sm shadow-md transition-all hover:scale-105 active:scale-95 cursor-pointer',
                    cancelButton: 'px-5 py-2.5 rounded-xl font-semibold text-sm transition-all hover:bg-slate-300 cursor-pointer'
                },
                backdrop: 'rgba(15, 23, 42, 0.55)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus Data...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
            return false;
        }
    </script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                iconColor: '#10b981',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-xl shadow-lg border border-emerald-100 font-sans'
                }
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                iconColor: '#ef4444',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-xl shadow-lg border border-red-100 font-sans'
                }
            });
        });
    </script>
    @endif
</body>
</html>
