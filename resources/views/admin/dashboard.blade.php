@extends('admin.layout')

@section('header_title', 'Dashboard')

@section('content')

<!-- 1. Banner Selamat Datang Kuning Emas Elegan -->
<div class="relative overflow-hidden bg-gradient-to-r from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] rounded-2xl shadow-lg border border-amber-500/40 p-5 md:p-6 mb-6 text-[#063b1e]">
    <!-- Ornamen Lingkaran Cahaya Lembut & Shimmer -->
    <div class="absolute -top-12 -right-12 w-80 h-80 bg-gradient-to-bl from-white/35 via-white/10 to-transparent rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-10 left-1/4 w-72 h-72 bg-amber-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Watermark Logo Ornamen Rapi -->
    <div class="absolute -right-6 -bottom-10 pointer-events-none select-none opacity-20 hidden sm:block">
        <img src="{{ asset('images/logo.png') }}" alt="Watermark" class="w-56 h-56 object-contain filter drop-shadow">
    </div>

    <div class="relative z-10 max-w-2xl">
        <!-- Tanggal & Hari Dinamis -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#063b1e] text-white rounded-full text-xs font-semibold shadow-xs border border-[#042814] mb-3">
            <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span id="banner-date" class="text-amber-100">Memuat tanggal...</span>
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
            <span class="text-white font-bold">Kejaksaan Negeri Kota Tasikmalaya</span>
        </div>

        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-[#063b1e] mb-1.5">
            Selamat Datang Kembali, {{ Auth::user()->name ?? 'Admin' }}! 👋
        </h2>
        <p class="text-[#063b1e] font-bold text-sm md:text-base">
            Pusat Kendali Papan Informasi Kepegawaian & Siswa Magang
        </p>
        <p class="text-xs md:text-sm text-[#063b1e]/85 mt-2 leading-relaxed font-medium">
            Semua penambahan atau pembaruan data yang Anda simpan di sini akan secara langsung disinkronkan ke layar TV Display di ruang pelayanan publik.
        </p>
    </div>
</div>

<!-- 2. Kartu Statistik Lebih Informatif -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
    
    <!-- Kartu 1: Data Kenaikan Pangkat -->
    <div class="bg-white rounded-2xl p-5 shadow-xs hover:shadow-md border border-slate-200/80 transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-600"></div>
        <div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kenaikan Pangkat</span>
                <span class="inline-flex items-center text-[11px] font-semibold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/70">
                    Aktif
                </span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">{{ $countPangkat }}</span>
                <span class="text-xs text-slate-400 font-medium">Pegawai</span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Total usulan kenaikan pangkat tercatat</p>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100 group-hover:bg-emerald-600 group-hover:text-white transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <a href="{{ route('admin.pangkat') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800 flex items-center gap-1 group-hover:translate-x-0.5 transition">
                <span>Kelola Data</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>

    <!-- Kartu 2: Data Kenaikan Gaji Berkala -->
    <div class="bg-white rounded-2xl p-5 shadow-xs hover:shadow-md border border-slate-200/80 transition-all duration-200 flex flex-col justify-between group relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
        <div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kenaikan Gaji (KGB)</span>
                <span class="inline-flex items-center text-[11px] font-semibold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200/70">
                    Berkala
                </span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">{{ $countGaji }}</span>
                <span class="text-xs text-slate-400 font-medium">Pegawai</span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Total usulan KGB dalam pemantauan</p>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100 group-hover:bg-amber-500 group-hover:text-white transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <a href="{{ route('admin.gaji') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-800 flex items-center gap-1 group-hover:translate-x-0.5 transition">
                <span>Kelola Data</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>

    <!-- Kartu 3: Total Anak Magang -->
    <div class="bg-white rounded-2xl p-5 shadow-xs hover:shadow-md border border-slate-200/80 transition-all duration-200 flex flex-col justify-between group relative overflow-hidden sm:col-span-2 lg:col-span-1">
        <div class="absolute top-0 left-0 right-0 h-1 bg-blue-600"></div>
        <div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Data Magang</span>
                <span class="inline-flex items-center text-[11px] font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/70">
                    Terdata
                </span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">{{ $countMagang }}</span>
                <span class="text-xs text-slate-400 font-medium">Siswa/Mahasiswa</span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Siswa & Mahasiswa magang aktif</p>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
            <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                </svg>
            </div>
            <a href="{{ route('admin.magang') }}" class="text-xs font-semibold text-blue-700 hover:text-blue-800 flex items-center gap-1 group-hover:translate-x-0.5 transition">
                <span>Kelola Data</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>

</div>

<!-- 3. Bagian Data Real-Time & Akses Cepat Pengelolaan -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Kolom Kiri (2 Kolom): Data Real-Time Berdasarkan Kategori -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xs border border-slate-200/80 p-5 md:p-6 flex flex-col justify-between" x-data="{ activeTab: 'pangkat' }">
        
        <div>
            <!-- Header Tab & Navigasi Kategori -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pemantauan Data Real-time</h3>
                    <p class="text-xs text-slate-500">Data terbaru yang sedang aktif dan tayang di Display TV</p>
                </div>
                
                <!-- Tab Tombol Kategori -->
                <div class="inline-flex p-1 bg-slate-100 rounded-xl text-xs font-medium">
                    <button @click="activeTab = 'pangkat'" 
                            :class="activeTab === 'pangkat' ? 'bg-white text-emerald-800 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-lg transition duration-150">
                        Pangkat ({{ $countPangkat }})
                    </button>
                    <button @click="activeTab = 'gaji'" 
                            :class="activeTab === 'gaji' ? 'bg-white text-amber-800 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-lg transition duration-150">
                        KGB ({{ $countGaji }})
                    </button>
                    <button @click="activeTab = 'magang'" 
                            :class="activeTab === 'magang' ? 'bg-white text-blue-800 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3 py-1.5 rounded-lg transition duration-150">
                        Magang ({{ $countMagang }})
                    </button>
                </div>
            </div>

            <!-- Konten Tab 1: Kenaikan Pangkat -->
            <div x-show="activeTab === 'pangkat'" class="mt-4">
                <div class="max-h-80 overflow-y-auto custom-scrollbar divide-y divide-slate-100 pr-1">
                    @forelse($recentPangkat as $rp)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 hover:bg-slate-50/70 px-2 rounded-xl transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($rp->nama_pegawai, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 leading-tight">{{ $rp->nama_pegawai }}</h4>
                                <div class="text-xs text-slate-500 mt-0.5 flex items-center gap-1.5">
                                    <span>{{ $rp->pangkat_lama ?? '-' }}</span>
                                    <span class="text-slate-300">&rarr;</span>
                                    <span class="font-medium text-slate-700">{{ $rp->pangkat_baru ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 self-start sm:self-center ml-11 sm:ml-0">
                            @if($rp->bulan_sk_baru)
                                <span class="text-[11px] text-slate-500 hidden sm:inline">SK: {{ $rp->bulan_sk_baru }}</span>
                            @endif
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full border {{ $rp->progres == 'Selesai' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/70' : ($rp->progres == 'PAK' ? 'bg-amber-50 text-amber-700 border-amber-200/70' : 'bg-slate-100 text-slate-600 border-slate-200/70') }}">
                                {{ $rp->progres ?? 'Proses' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center text-xs text-slate-400">
                        Belum ada data kenaikan pangkat yang tercatat.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Konten Tab 2: Kenaikan Gaji Berkala (KGB) -->
            <div x-show="activeTab === 'gaji'" style="display: none;" class="mt-4">
                <div class="max-h-80 overflow-y-auto custom-scrollbar divide-y divide-slate-100 pr-1">
                    @forelse($recentGaji as $rg)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 hover:bg-slate-50/70 px-2 rounded-xl transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($rg->nama_pegawai, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 leading-tight">{{ $rg->nama_pegawai }}</h4>
                                <div class="text-xs text-slate-500 mt-0.5 flex items-center gap-2">
                                    <span>Pengajuan: {{ $rg->bulan_pengajuan ?? '-' }}</span>
                                    <span class="text-slate-300">&bull;</span>
                                    <span>SK: {{ $rg->bulan_sk_baru ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="self-start sm:self-center ml-11 sm:ml-0">
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full border {{ $rg->progres == 'Selesai' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/70' : 'bg-amber-50 text-amber-700 border-amber-200/70' }}">
                                {{ $rg->progres ?? 'Proses' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center text-xs text-slate-400">
                        Belum ada data kenaikan gaji berkala yang tercatat.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Konten Tab 3: Data Anak Magang -->
            <div x-show="activeTab === 'magang'" style="display: none;" class="mt-4">
                <div class="max-h-80 overflow-y-auto custom-scrollbar divide-y divide-slate-100 pr-1">
                    @forelse($recentMagang as $rm)
                    <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2 hover:bg-slate-50/70 px-2 rounded-xl transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($rm->nama, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 leading-tight">{{ $rm->nama }}</h4>
                                <div class="text-xs text-slate-500 mt-0.5">
                                    {{ $rm->mulai_magang ? \Carbon\Carbon::parse($rm->mulai_magang)->format('d M Y') : '-' }} s/d {{ $rm->selesai_magang ? \Carbon\Carbon::parse($rm->selesai_magang)->format('d M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="self-start sm:self-center ml-11 sm:ml-0">
                            <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/70">
                                {{ $rm->asal_sekolah ?? 'Institusi' }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center text-xs text-slate-400">
                        Belum ada data siswa magang yang tercatat.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Tombol "Lihat Semua" Sesuai Kategori Aktif -->
        <div class="pt-4 mt-2 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs text-slate-400">Menampilkan hingga 5 data terbaru</span>
            <div x-show="activeTab === 'pangkat'">
                <a href="{{ route('admin.pangkat') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1.5 transition">
                    <span>Lihat Semua Data Pangkat</span>
                    <span>&rarr;</span>
                </a>
            </div>
            <div x-show="activeTab === 'gaji'" style="display: none;">
                <a href="{{ route('admin.gaji') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1.5 transition">
                    <span>Lihat Semua Data KGB</span>
                    <span>&rarr;</span>
                </a>
            </div>
            <div x-show="activeTab === 'magang'" style="display: none;">
                <a href="{{ route('admin.magang') }}" class="text-xs font-bold text-blue-700 hover:text-blue-800 flex items-center gap-1.5 transition">
                    <span>Lihat Semua Data Magang</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Kolom Kanan (1 Kolom): Akses Cepat Pengelolaan -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 p-5 md:p-6 flex flex-col justify-between">
        <div>
            <div class="pb-3 border-b border-slate-100 mb-4">
                <h3 class="text-base font-bold text-slate-800">Akses Cepat Menu</h3>
                <p class="text-xs text-slate-500">Pintasan navigasi langsung pengelolaan data</p>
            </div>
            
            <div class="space-y-2.5">
                <!-- Pangkat Link -->
                <a href="{{ route('admin.pangkat') }}" 
                   class="group flex items-center justify-between p-3 rounded-xl border border-slate-200/80 hover:border-emerald-600 hover:bg-emerald-50/50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-emerald-900 block">Kenaikan Pangkat</span>
                            <span class="text-[11px] text-slate-500">Input & perbarui pangkat</span>
                        </div>
                    </div>
                    <span class="text-slate-400 group-hover:text-emerald-700 group-hover:translate-x-0.5 transition">&rarr;</span>
                </a>

                <!-- Gaji Link -->
                <a href="{{ route('admin.gaji') }}" 
                   class="group flex items-center justify-between p-3 rounded-xl border border-slate-200/80 hover:border-amber-500 hover:bg-amber-50/50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-amber-900 block">Kenaikan Gaji Berkala</span>
                            <span class="text-[11px] text-slate-500">Jadwal & progres KGB</span>
                        </div>
                    </div>
                    <span class="text-slate-400 group-hover:text-amber-700 group-hover:translate-x-0.5 transition">&rarr;</span>
                </a>

                <!-- Magang Link -->
                <a href="{{ route('admin.magang') }}" 
                   class="group flex items-center justify-between p-3 rounded-xl border border-slate-200/80 hover:border-blue-500 hover:bg-blue-50/50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-blue-900 block">Data Anak Magang</span>
                            <span class="text-[11px] text-slate-500">Daftar siswa & periode</span>
                        </div>
                    </div>
                    <span class="text-slate-400 group-hover:text-blue-700 group-hover:translate-x-0.5 transition">&rarr;</span>
                </a>

                <!-- Rekap Link -->
                <a href="{{ route('admin.rekapitulasi') }}" 
                   class="group flex items-center justify-between p-3 rounded-xl border border-slate-200/80 hover:border-purple-500 hover:bg-purple-50/50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-700 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-800 group-hover:text-purple-900 block">Rekapitulasi & Cetak</span>
                            <span class="text-[11px] text-slate-500">Unduh & cetak laporan resmi</span>
                        </div>
                    </div>
                    <span class="text-slate-400 group-hover:text-purple-700 group-hover:translate-x-0.5 transition">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Card Monitor Layar TV -->
        <div class="mt-4 pt-4 border-t border-slate-100">
            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200/70 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-bold text-slate-800">Status TV Display</span>
                    </div>
                    <span class="text-[11px] text-slate-500 block mt-0.5">Siap tayang di ruang publik</span>
                </div>
                <a href="{{ route('display.index') }}" target="_blank" 
                   class="px-3 py-1.5 bg-[#0b5d30] hover:bg-[#084724] text-white text-xs font-bold rounded-lg transition shadow-xs flex items-center gap-1">
                    <span>Lihat</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

    </div>

</div>

@endsection

