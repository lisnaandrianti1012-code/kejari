<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Informasi Kejari - TV Display</title>
    <!-- Auto refresh setiap 120 detik -->
    <meta http-equiv="refresh" content="120">
    
    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        kejari: {
                            DEFAULT: '#0b5d30',
                            dark: '#064e28',
                            darker: '#04381d',
                            light: '#137941',
                            surface: '#f4f6f5',
                        },
                        gold: {
                            DEFAULT: '#c5a059',
                            bright: '#facc15',
                            dark: '#9a7b38',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Sembunyikan scrollbar untuk tampilan TV yang bersih */
        body::-webkit-scrollbar, .hide-scrollbar::-webkit-scrollbar { display: none; }
        body, .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Subtle grid background pattern */
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(219, 149, 8, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Gold gradient line */
        .gold-border-line {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #c5a059 20%, #facc15 50%, #c5a059 80%, transparent 100%);
        }

        /* Pulse slow */
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.2); }
        }
        .animate-pulse-slow {
            animation: pulse-slow 2s infinite ease-in-out;
        }

        /* ── Ticker Tape ── */
        .ticker-wrap {
            overflow: hidden;
            position: relative;
        }
        /* Fade edges */
        .ticker-wrap::before,
        .ticker-wrap::after {
            content: '';
            position: absolute;
            top: 0; bottom: 0;
            width: 60px;
            z-index: 2;
            pointer-events: none;
        }
        .ticker-wrap::before {
            left: 0;
            background: linear-gradient(to right, #EEAC1A, transparent);
        }
        .ticker-wrap::after {
            right: 0;
            background: linear-gradient(to left, #DB9508, transparent);
        }

        @keyframes ticker-scroll {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-track {
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            animation: ticker-scroll 28s linear infinite;
            will-change: transform;
        }
        .ticker-track:hover {
            animation-play-state: paused;
        }

        /* Shimmer / shine text */
        @keyframes text-shine {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .ticker-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 0.8rem;
            letter-spacing: 0.07em;
            background: linear-gradient(
                90deg,
                #063b1e 0%,
                #0b5d30 30%,
                #facc15 50%,
                #0b5d30 70%,
                #063b1e 100%
            );
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: text-shine 4s linear infinite;
            filter: drop-shadow(0 0 6px rgba(250,204,21,0.35));
        }
        .ticker-sep {
            display: inline-block;
            margin: 0 22px;
            color: #063b1e;
            opacity: 0.55;
            font-size: 1rem;
            -webkit-text-fill-color: #063b1e;
        }
    </style>

    <!-- Alpine.js untuk Auto-Slide Carousel -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#FAF7F2] text-slate-800 h-screen flex flex-col overflow-hidden font-sans select-none relative bg-grid-pattern" 
      x-data="{ 
          musicActive: false,
          musicModalOpen: false,
          uploadModalOpen: false,
          playlist: {{ json_encode($musiks->map(fn($m) => [
              'id' => $m->id, 
              'judul' => $m->judul, 
              'url' => $m->url, 
              'is_active' => (bool)$m->is_active,
              'keterangan' => $m->keterangan
          ])) }},
          currentTrack: null,

          initAudio() {
              const sessionNewMusicUrl = '{{ session('new_music_url') }}';
              const sessionNewMusicTitle = '{{ session('new_music_title') }}';

              if (sessionNewMusicUrl) {
                  this.currentTrack = this.playlist.find(p => p.url === sessionNewMusicUrl) || {
                      id: 'new',
                      judul: sessionNewMusicTitle,
                      url: sessionNewMusicUrl
                  };
                  localStorage.setItem('tv_bgm_url', this.currentTrack.url);
                  localStorage.setItem('tv_bgm_title', this.currentTrack.judul);
                  localStorage.setItem('tv_bgm_active', 'true');
              } else {
                  const savedUrl = localStorage.getItem('tv_bgm_url');
                  if (savedUrl && this.playlist.find(p => p.url === savedUrl)) {
                      this.currentTrack = this.playlist.find(p => p.url === savedUrl);
                  } else {
                      this.currentTrack = this.playlist.find(p => p.is_active) || this.playlist[0] || {
                          id: 1,
                          judul: 'Musik Instrumental Kejari (Default)',
                          url: '{{ asset('musik.mp3') }}'
                      };
                  }
              }

              const audio = document.getElementById('bgm');
              if (this.currentTrack && audio) {
                  audio.src = this.currentTrack.url;
              }

              const savedActive = localStorage.getItem('tv_bgm_active');
              if (savedActive === 'false') {
                  this.musicActive = false;
              } else {
                  this.playMusic();
              }
          },

          playMusic() {
              const audio = document.getElementById('bgm');
              if (!audio || !this.currentTrack) return;
              audio.play().then(() => {
                  this.musicActive = true;
                  localStorage.setItem('tv_bgm_active', 'true');
              }).catch(() => {
                  this.musicActive = false;
              });
          },

          pauseMusic() {
              const audio = document.getElementById('bgm');
              if (audio) audio.pause();
              this.musicActive = false;
              localStorage.setItem('tv_bgm_active', 'false');
          },

          stopMusic() {
              const audio = document.getElementById('bgm');
              if (audio) {
                  audio.pause();
                  audio.currentTime = 0;
              }
              this.musicActive = false;
              localStorage.setItem('tv_bgm_active', 'false');
          },

          togglePlay() {
              if (this.musicActive) {
                  this.pauseMusic();
              } else {
                  this.playMusic();
              }
          },

          selectTrack(track) {
              this.currentTrack = track;
              localStorage.setItem('tv_bgm_url', track.url);
              localStorage.setItem('tv_bgm_title', track.judul);
              const audio = document.getElementById('bgm');
              if (audio) {
                  audio.src = track.url;
                  audio.currentTime = 0;
                  this.playMusic();
              }
              this.musicModalOpen = false;
          }
      }"
      x-init="initAudio()">
    
    <!-- Audio Background TV Display -->
    <audio id="bgm" loop></audio>

    <!-- Header: Kejaksaan Negeri Kota Tasikmalaya (Kuning Emas Elegan) -->
    <header class="bg-gradient-to-r from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] text-[#063b1e] px-7 py-3.5 flex justify-between items-center shadow-md relative z-20 border-b border-[#c48405]/40">
        <div class="flex items-center gap-4">
            <!-- Logo Kejaksaan -->
            <div class="bg-white/80 p-2 rounded-xl backdrop-blur-sm border border-white/80 shadow-xs">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Kejaksaan" class="w-12 h-12 object-contain drop-shadow-xs">
            </div>
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-extrabold uppercase tracking-wide text-[#063b1e] leading-tight">Kejaksaan Negeri</h1>
                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-[#063b1e] text-amber-300 border border-[#063b1e]/40 uppercase tracking-widest shadow-xs">Kota Tasikmalaya</span>
                </div>
                <p class="text-xs font-bold text-[#063b1e]/85 tracking-wide mt-0.5">Papan Kontrol Informasi Kinerja Pegawai & Magang</p>
            </div>
        </div>

        <div class="flex items-center gap-5">
            <!-- Audio Controls Bar TV Style (Putar, Pilih Musik, Stop) -->
            <div class="flex items-center gap-1.5 bg-[#063b1e] p-1 rounded-full border border-[#042814] shadow-xs">
                
                <!-- Track Badge & Playlist Trigger -->
                <button @click="musicModalOpen = true" 
                        title="Klik untuk memilih lagu lain"
                        class="flex items-center gap-2 pl-3 pr-2 py-1 rounded-full hover:bg-white/10 transition cursor-pointer text-left max-w-[190px] group">
                    <template x-if="musicActive">
                        <span class="flex items-center gap-1 shrink-0">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="flex items-end gap-0.5 h-3">
                                <span class="w-0.5 bg-amber-400 animate-[bounce_0.8s_infinite] h-2"></span>
                                <span class="w-0.5 bg-amber-300 animate-[bounce_1.2s_infinite] h-3"></span>
                                <span class="w-0.5 bg-amber-400 animate-[bounce_0.9s_infinite] h-1.5"></span>
                            </span>
                        </span>
                    </template>
                    <template x-if="!musicActive">
                        <span class="flex items-center gap-1 shrink-0 text-slate-400">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                        </span>
                    </template>
                    <div class="min-w-0 flex-1">
                        <span class="block text-[11px] font-extrabold text-amber-200 uppercase tracking-wider truncate group-hover:text-white transition"
                              x-text="currentTrack ? currentTrack.judul : 'PILIH MUSIK'"></span>
                    </div>
                </button>

                <!-- Tombol Play / Pause -->
                <button @click="togglePlay()" 
                        :title="musicActive ? 'Jeda Musik (Pause)' : 'Putar Musik (Play)'"
                        class="w-7 h-7 rounded-full flex items-center justify-center bg-amber-400 hover:bg-amber-300 text-[#063b1e] transition cursor-pointer shadow-2xs">
                    <template x-if="musicActive">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                    </template>
                    <template x-if="!musicActive">
                        <svg class="w-3.5 h-3.5 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </template>
                </button>

                <!-- Tombol STOP -->
                <button @click="stopMusic()" 
                        title="Hentikan Musik (Stop)"
                        class="px-2 py-1 rounded-full flex items-center gap-1 hover:bg-red-500/25 text-slate-300 hover:text-red-300 text-[10px] font-extrabold uppercase tracking-wider transition cursor-pointer">
                    <svg class="w-3 h-3 fill-current text-red-400" viewBox="0 0 24 24"><path d="M6 6h12v12H6z"/></svg>
                    <span>STOP</span>
                </button>

                <!-- Tombol PILIH MUSIK -->
                <button @click="musicModalOpen = true" 
                        title="Buka Daftar Pilihan Musik"
                        class="px-2.5 py-1 rounded-full flex items-center gap-1 bg-white/10 hover:bg-white/20 text-white text-[10px] font-extrabold uppercase tracking-wider transition cursor-pointer border border-white/10">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    <span>PILIH</span>
                </button>
            </div>

            <!-- Digital Clock & Date -->
            <div class="text-right border-l border-[#063b1e]/25 pl-6">
                <div id="clock" class="text-2xl font-mono font-extrabold text-[#063b1e] tracking-widest leading-none drop-shadow-2xs">00 : 00 : 00</div>
                <div id="date" class="text-[11px] font-bold text-[#063b1e] uppercase tracking-wider mt-1">Senin, 1 Jan 2024</div>
            </div>
        </div>
    </header>

    <!-- Main Content Area - Auto Slide setiap 45 detik -->
    <main class="flex-grow p-3 relative flex flex-col overflow-hidden" 
          x-data="{ activeSlide: 1 }" 
          x-init="setInterval(() => { activeSlide = activeSlide >= 4 ? 1 : activeSlide + 1 }, 45000)">
        
        <!-- Watermark Logo di Tengah Background Keseluruhan -->
        <img src="{{ asset('images/logo.png') }}" alt="Watermark Logo" class="absolute inset-0 m-auto w-[380px] h-[380px] object-contain opacity-[0.035] pointer-events-none select-none z-0">

        @php
            $jmlSakit = $kehadirans->where('status','Sakit')->count();
            $jmlCuti  = $kehadirans->where('status','Cuti')->count();
            $jmlDinas = $kehadirans->where('status','Dinas Luar Kota')->count();
        @endphp

        <!-- SLIDE 1: KENAIKAN PANGKAT PEGAWAI -->
        <div x-show="activeSlide === 1"
             x-transition.opacity.duration.800ms
             class="absolute inset-y-2.5 left-2.5 right-[218px] flex flex-col bg-gradient-to-b from-white via-amber-50/25 to-amber-100/10 rounded-2xl shadow-xl overflow-hidden border border-amber-200/90 backdrop-blur-sm z-10">

            <!-- Watermark Samar Khusus Card (3-5% Opacity) -->
            <img src="{{ asset('images/logo.png') }}" alt="Watermark Card" class="absolute inset-0 m-auto w-72 h-72 object-contain opacity-[0.04] pointer-events-none select-none z-0">

            <!-- Header Judul Slide (Kuning Emas) -->
            <div class="bg-gradient-to-r from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] py-2.5 px-6 flex flex-wrap items-center justify-between border-b-2 border-amber-600/30 shadow-sm gap-2 relative z-10 text-[#063b1e]">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-amber-300 bg-[#063b1e] px-2.5 py-0.5 rounded-full border border-[#063b1e]/40 shadow-xs">
                        <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        Layanan Kepegawaian
                    </span>
                    <h2 class="text-lg font-extrabold text-[#063b1e] tracking-wider uppercase">
                        Kenaikan Pangkat Pegawai <span class="text-xs font-bold text-[#063b1e]/80 tracking-normal ml-1 border-l border-[#063b1e]/30 pl-2">TAHUN 2026</span>
                    </h2>
                </div>
                @php
                    $totalPangkat = $pangkats->count();
                    $selesaiPangkat = $pangkats->where('progres', 'Selesai')->count();
                    $pakPangkat = $pangkats->where('progres', 'PAK')->count();
                @endphp
                <div class="flex items-center gap-2">
                    <span class="bg-[#063b1e] text-white px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-[#063b1e]/40 shadow-xs">{{ $totalPangkat }} Pegawai Terdata</span>
                    <span class="bg-[#063b1e]/85 text-amber-200 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-[#063b1e]/30">● {{ $selesaiPangkat }} Selesai</span>
                    @if($pakPangkat > 0)
                    <span class="bg-amber-900/80 text-amber-100 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-amber-900/40">● {{ $pakPangkat }} PAK</span>
                    @endif
                </div>
            </div>

            <div class="px-4 pb-3 flex-grow overflow-y-auto hide-scrollbar relative z-10"
                 x-ref="scroll1"
                 x-init="setInterval(() => { if(activeSlide === 1) { $refs.scroll1.scrollTop += 1; if($refs.scroll1.scrollTop + $refs.scroll1.clientHeight >= $refs.scroll1.scrollHeight) $refs.scroll1.scrollTop = 0; } }, 35);">
                <table class="w-full text-left text-slate-800 border-collapse">
                    <thead class="sticky top-0 z-20 bg-[#FFFDF9] border-b-2 border-amber-500 text-[#063b1e] shadow-xs">
                        <tr>
                            <th class="py-2.5 px-3 font-extrabold w-14 text-center text-sm text-[#063b1e] bg-[#FFFDF9]">No</th>
                            <th class="py-2.5 px-3 font-extrabold text-sm text-[#063b1e] bg-[#FFFDF9]">Nama Pegawai</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">Pangkat Lama</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">Pangkat Baru</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">Pengajuan</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">SK Baru</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm w-32 text-[#063b1e] bg-[#FFFDF9]">Progres</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pangkats as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-2 px-3 font-mono font-bold text-slate-400 text-center text-sm">{{ sprintf('%02d', $index + 1) }}</td>
                            <td class="py-2 px-3 font-extrabold text-slate-900 text-sm">{{ $item->nama_pegawai }}</td>
                            <td class="py-2 px-3 text-center text-slate-600 font-semibold text-sm">{{ $item->pangkat_lama }}</td>
                            <td class="py-2 px-3 text-center font-extrabold text-[#063b1e] text-sm">{{ $item->pangkat_baru }}</td>
                            <td class="py-2 px-3 text-center font-semibold text-slate-600 text-sm">{{ $item->bulan_pengajuan ?? '—' }}</td>
                            <td class="py-2 px-3 text-center font-semibold text-slate-600 text-sm">{{ $item->bulan_sk_baru ?? '—' }}</td>
                            <td class="py-2 px-3 font-bold text-center">
                                @if($item->progres == 'Selesai')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span>SELESAI</span></span>
                                @elseif($item->progres == 'PAK')
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span><span>PAK</span></span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span><span>{{ $item->progres ?: '—' }}</span></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-10 text-slate-400 italic">Belum ada data kenaikan pangkat...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SLIDE 2: KENAIKAN GAJI BERKALA -->
        <div x-show="activeSlide === 2"
             x-transition.opacity.duration.800ms
             class="absolute inset-y-2.5 left-2.5 right-[218px] flex flex-col bg-gradient-to-b from-white via-amber-50/25 to-amber-100/10 rounded-2xl shadow-xl overflow-hidden border border-amber-200/90 backdrop-blur-sm z-10"
             style="display: none;">

            <img src="{{ asset('images/logo.png') }}" alt="Watermark Card" class="absolute inset-0 m-auto w-72 h-72 object-contain opacity-[0.04] pointer-events-none select-none z-0">

            <div class="bg-gradient-to-r from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] py-2.5 px-6 flex flex-wrap items-center justify-between border-b-2 border-amber-600/30 shadow-sm gap-2 relative z-10 text-[#063b1e]">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-amber-300 bg-[#063b1e] px-2.5 py-0.5 rounded-full border border-[#063b1e]/40 shadow-xs">
                        <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Layanan Kesejahteraan
                    </span>
                    <h2 class="text-lg font-extrabold text-[#063b1e] tracking-wider uppercase">
                        Kenaikan Gaji Berkala <span class="text-xs font-bold text-[#063b1e]/80 tracking-normal ml-1 border-l border-[#063b1e]/30 pl-2">TAHUN 2026</span>
                    </h2>
                </div>
                @php
                    $totalGaji = $gajis->count();
                    $selesaiGaji = $gajis->where('progres', 'Selesai')->count();
                    $prosesGaji = $gajis->filter(fn($i) => in_array($i->progres, ['-', '']))->count();
                @endphp
                <div class="flex items-center gap-2">
                    <span class="bg-[#063b1e] text-white px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-[#063b1e]/40 shadow-xs">{{ $totalGaji }} Pegawai Terdata</span>
                    <span class="bg-[#063b1e]/85 text-amber-200 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-[#063b1e]/30">● {{ $selesaiGaji }} Selesai</span>
                    @if($prosesGaji > 0)
                    <span class="bg-slate-700/80 text-slate-100 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-slate-600/40">● {{ $prosesGaji }} Progres "-"</span>
                    @endif
                </div>
            </div>

            <div class="px-4 pb-3 flex-grow overflow-y-auto hide-scrollbar relative z-10"
                 x-ref="scroll2"
                 x-init="setInterval(() => { if(activeSlide === 2) { $refs.scroll2.scrollTop += 1; if($refs.scroll2.scrollTop + $refs.scroll2.clientHeight >= $refs.scroll2.scrollHeight) $refs.scroll2.scrollTop = 0; } }, 35);">
                <table class="w-full text-left text-slate-800 border-collapse">
                    <thead class="sticky top-0 z-20 bg-[#FFFDF9] border-b-2 border-amber-500 text-[#063b1e] shadow-xs">
                        <tr>
                            <th class="py-2.5 px-3 font-extrabold w-14 text-center text-sm text-[#063b1e] bg-[#FFFDF9]">No</th>
                            <th class="py-2.5 px-3 font-extrabold text-sm text-[#063b1e] bg-[#FFFDF9]">Nama Pegawai</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">Bulan Pengajuan</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm text-[#063b1e] bg-[#FFFDF9]">Bulan/SK Baru</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm w-32 text-[#063b1e] bg-[#FFFDF9]">Progres</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($gajis as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-2 px-3 font-mono font-bold text-slate-400 text-center text-sm">{{ sprintf('%02d', $index + 1) }}</td>
                            <td class="py-2 px-3 font-extrabold text-slate-900 text-sm">{{ $item->nama_pegawai }}</td>
                            <td class="py-2 px-3 text-center font-extrabold text-[#063b1e] text-sm">{{ $item->bulan_pengajuan }}</td>
                            <td class="py-2 px-3 text-center font-semibold text-slate-600 text-sm">{{ $item->bulan_sk_baru }}</td>
                            <td class="py-2 px-3 font-bold text-center">
                                @if($item->progres == 'Selesai')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span>SELESAI</span></span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider"><span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span><span>-</span></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-10 text-slate-400 italic">Belum ada data kenaikan gaji berkala...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SLIDE 3: DATA MAGANG AKTIF -->
        <div x-show="activeSlide === 3"
             x-transition.opacity.duration.800ms
             class="absolute inset-y-2.5 left-2.5 right-[218px] flex flex-col bg-gradient-to-b from-white via-slate-50/90 to-blue-50/20 rounded-2xl shadow-xl overflow-hidden border border-slate-200/90 backdrop-blur-sm z-10"
             style="display: none;">

            <img src="{{ asset('images/logo.png') }}" alt="Watermark Card" class="absolute inset-0 m-auto w-72 h-72 object-contain opacity-[0.04] pointer-events-none select-none z-0">

            <div class="bg-[#1e3a8a] py-2.5 px-6 flex flex-wrap items-center justify-between border-b-2 border-blue-400 shadow-sm gap-2 relative z-10">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-blue-200 bg-black/20 px-2.5 py-0.5 rounded-full border border-blue-300/30">
                        <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        Praktik Kerja / Magang
                    </span>
                    <h2 class="text-lg font-extrabold text-white tracking-wider uppercase">Daftar Anak Magang Aktif</h2>
                </div>
                @php
                    $totalMagang = $magangs->count();
                    $totalInstansi = $magangs->pluck('asal_sekolah')->unique()->count();
                @endphp
                <div class="flex items-center gap-2">
                    <span class="bg-white/15 text-white px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-white/20">{{ $totalMagang }} Peserta Magang</span>
                    <span class="bg-blue-500/30 text-blue-200 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border border-blue-400/30">● {{ $totalInstansi }} Instansi / Sekolah</span>
                </div>
            </div>

            <div class="px-4 pb-3 flex-grow overflow-y-auto hide-scrollbar relative z-10"
                 x-ref="scroll3"
                 x-init="setInterval(() => { if(activeSlide === 3) { $refs.scroll3.scrollTop += 1; if($refs.scroll3.scrollTop + $refs.scroll3.clientHeight >= $refs.scroll3.scrollHeight) $refs.scroll3.scrollTop = 0; } }, 35);">
                <table class="w-full text-left text-slate-800 border-collapse">
                    <thead class="sticky top-0 z-20 bg-white border-b-2 border-[#1e3a8a] text-[#1e3a8a] shadow-sm">
                        <tr>
                            <th class="py-2.5 px-3 font-extrabold w-14 text-center text-sm bg-white">No</th>
                            <th class="py-2.5 px-3 font-extrabold text-sm bg-white">Nama Pemagang</th>
                            <th class="py-2.5 px-3 font-extrabold text-sm bg-white">Asal Instansi/Sekolah</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm bg-white">Tanggal Mulai</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm bg-white">Tanggal Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($magangs as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-2 px-3 font-mono font-bold text-slate-400 text-center text-sm">{{ sprintf('%02d', $index + 1) }}</td>
                            <td class="py-2 px-3 font-extrabold text-slate-900 text-sm">{{ $item->nama }}</td>
                            <td class="py-2 px-3 font-semibold text-slate-700 text-sm">{{ $item->asal_sekolah }}</td>
                            <td class="py-2 px-3 text-center font-semibold text-slate-600 bg-slate-50/60 rounded-lg text-sm">{{ $item->mulai_magang ? \Carbon\Carbon::parse($item->mulai_magang)->translatedFormat('d F Y') : '-' }}</td>
                            <td class="py-2 px-3 text-center font-semibold text-slate-600 bg-slate-50/60 rounded-lg text-sm">{{ $item->selesai_magang ? \Carbon\Carbon::parse($item->selesai_magang)->translatedFormat('d F Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-10 text-slate-400 italic">Belum ada peserta magang yang aktif...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SLIDE 4: REKAPITULASI MAGANG -->
        <div x-show="activeSlide === 4"
             x-transition.opacity.duration.800ms
             class="absolute inset-y-2.5 left-2.5 right-[218px] flex flex-col bg-gradient-to-b from-white via-slate-50/90 to-purple-50/20 rounded-2xl shadow-xl overflow-hidden border border-purple-200/90 backdrop-blur-sm z-10"
             style="display: none;">

            <img src="{{ asset('images/logo.png') }}" alt="Watermark Card" class="absolute inset-0 m-auto w-72 h-72 object-contain opacity-[0.04] pointer-events-none select-none z-0">

            <div class="bg-[#7e22ce] py-2.5 px-6 flex flex-wrap items-center justify-between border-b-2 border-purple-300 shadow-sm gap-2 relative z-10">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-purple-200 bg-black/20 px-2.5 py-0.5 rounded-full border border-purple-300/30">
                        <svg class="w-3.5 h-3.5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Laporan & Statistik
                    </span>
                    <h2 class="text-lg font-extrabold text-white tracking-wider uppercase">Papan Rekapitulasi Magang</h2>
                </div>
            </div>

            <div class="px-4 pb-3 flex-grow overflow-y-auto hide-scrollbar relative z-10"
                 x-ref="scroll4"
                 x-init="setInterval(() => { if(activeSlide === 4) { $refs.scroll4.scrollTop += 1; if($refs.scroll4.scrollTop + $refs.scroll4.clientHeight >= $refs.scroll4.scrollHeight) $refs.scroll4.scrollTop = 0; } }, 35);">
                <table class="w-full text-left text-slate-800 border-collapse">
                    <thead class="sticky top-0 z-20 bg-white border-b-2 border-[#7e22ce] text-[#7e22ce] shadow-sm">
                        <tr>
                            <th class="py-2.5 px-3 font-extrabold w-14 text-center text-sm bg-white">No</th>
                            <th class="py-2.5 px-3 font-extrabold text-sm bg-white">Bulan</th>
                            <th class="py-2.5 px-3 font-extrabold text-center text-sm bg-white">Jumlah Magang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($rekapMagang as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-2 px-3 font-mono font-bold text-slate-400 text-center text-sm">{{ sprintf('%02d', $item->no) }}</td>
                            <td class="py-2 px-3 font-extrabold text-slate-900 text-sm">{{ $item->bulan }}</td>
                            <td class="py-2 px-3 text-center font-extrabold text-[#7e22ce] text-lg">{{ $item->jumlah }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-10 text-slate-400 italic">Belum ada rekapitulasi magang...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ═══ PANEL KEHADIRAN — Disematkan permanen di kanan ═══ -->
        <div class="absolute top-2.5 right-2.5 bottom-2.5 w-[206px] flex flex-col rounded-2xl overflow-hidden shadow-xl border border-slate-200/80 z-20 bg-white">

            <!-- Header panel -->
            <div class="px-3 py-2 flex items-center gap-2 shrink-0" style="background:linear-gradient(135deg,#1a1a2e,#0f3460)">
                <svg class="w-4 h-4 text-rose-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-white leading-tight">Status Kehadiran</span>
            </div>

            <!-- Badge ringkasan -->
            <div class="flex gap-1 px-2 py-1.5 bg-slate-50 border-b border-slate-200 shrink-0">
                <span class="flex-1 flex flex-col items-center py-1 rounded-lg bg-red-50 border border-red-200">
                    <span class="text-sm font-extrabold text-red-600 leading-none">{{ $jmlSakit }}</span>
                    <span class="text-[9px] font-bold text-red-500 uppercase tracking-wider mt-0.5">Sakit</span>
                </span>
                <span class="flex-1 flex flex-col items-center py-1 rounded-lg bg-sky-50 border border-sky-200">
                    <span class="text-sm font-extrabold text-sky-600 leading-none">{{ $jmlCuti }}</span>
                    <span class="text-[9px] font-bold text-sky-500 uppercase tracking-wider mt-0.5">Cuti</span>
                </span>
                <span class="flex-1 flex flex-col items-center py-1 rounded-lg bg-amber-50 border border-amber-200">
                    <span class="text-sm font-extrabold text-amber-600 leading-none">{{ $jmlDinas }}</span>
                    <span class="text-[9px] font-bold text-amber-600 uppercase tracking-wider mt-0.5">Dinas</span>
                </span>
            </div>

            <!-- Daftar nama scrollable -->
            <div class="flex-grow overflow-y-auto hide-scrollbar px-2 py-1.5 space-y-0.5"
                 x-ref="scrollPanel"
                 x-init="setInterval(() => { $refs.scrollPanel.scrollTop += 1; if($refs.scrollPanel.scrollTop + $refs.scrollPanel.clientHeight >= $refs.scrollPanel.scrollHeight) $refs.scrollPanel.scrollTop = 0; }, 45);">

                @if($kehadirans->count() === 0)
                <p class="text-center text-xs text-slate-400 italic py-6">Semua hadir ✅</p>
                @endif

                @foreach($kehadirans->where('status','Sakit') as $item)
                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-red-50 border border-red-100">
                    <span class="w-6 h-6 rounded-full bg-red-500 text-white text-[10px] font-extrabold flex items-center justify-center shrink-0">{{ strtoupper(substr($item->nama_pegawai,0,1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[11px] font-extrabold text-slate-800 leading-tight truncate">{{ $item->nama_pegawai }}</p>
                        <p class="text-[9px] font-bold text-red-500 uppercase">🤒 Sakit{{ $item->keterangan ? ' — ' . $item->keterangan : '' }}</p>
                    </div>
                </div>
                @endforeach

                @foreach($kehadirans->where('status','Cuti') as $item)
                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-sky-50 border border-sky-100">
                    <span class="w-6 h-6 rounded-full bg-sky-500 text-white text-[10px] font-extrabold flex items-center justify-center shrink-0">{{ strtoupper(substr($item->nama_pegawai,0,1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[11px] font-extrabold text-slate-800 leading-tight truncate">{{ $item->nama_pegawai }}</p>
                        <p class="text-[9px] font-bold text-sky-500 uppercase">🏖️ Cuti{{ $item->keterangan ? ' — ' . $item->keterangan : '' }}</p>
                    </div>
                </div>
                @endforeach

                @foreach($kehadirans->where('status','Dinas Luar Kota') as $item)
                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-amber-50 border border-amber-100">
                    <span class="w-6 h-6 rounded-full bg-amber-500 text-white text-[10px] font-extrabold flex items-center justify-center shrink-0">{{ strtoupper(substr($item->nama_pegawai,0,1)) }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-[11px] font-extrabold text-slate-800 leading-tight truncate">{{ $item->nama_pegawai }}</p>
                        <p class="text-[9px] font-bold text-amber-600 uppercase">✈️ Dinas{{ $item->keterangan ? ' — ' . $item->keterangan : '' }}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div><!-- end panel kehadiran -->

    </main>

    <!-- Footer Ticker (Kuning Emas TV Display Style) -->
    <footer class="bg-gradient-to-r from-[#F5B82E] via-[#EEAC1A] to-[#DB9508] text-[#063b1e] py-2 px-0 whitespace-nowrap overflow-hidden flex items-center border-t-2 border-[#c48405]/50 shadow-xl z-20" style="min-height:38px">

        <!-- Badge INFO -->
        <div class="flex items-center gap-2 bg-[#063b1e] text-amber-300 px-3.5 py-1.5 shadow-md font-extrabold text-xs uppercase tracking-widest border-r-2 border-amber-600/40 shrink-0 self-stretch" style="min-width:80px;justify-content:center">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            <span>INFO</span>
        </div>

        <!-- Scrolling ticker -->
        <div class="ticker-wrap flex-grow self-stretch flex items-center" style="overflow:hidden;position:relative">
            <div class="ticker-track">
                {{-- Duplicate content so the scroll loops seamlessly --}}
                @foreach([1,2] as $_)
                <span class="ticker-text">Selamat Datang di Kepegawaian Kejaksaan Negeri Kota Tasikmalaya</span>
                <span class="ticker-sep">&nbsp;&nbsp;🤝&nbsp;&nbsp;</span>
                <span class="ticker-text">Universitas Cipasung Tasikmalaya</span>
                <span class="ticker-sep">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                @endforeach
            </div>
        </div>
    </footer>

    <!-- Script Jam Digital -->
    <script>
        function updateClock() {
            const now = new Date();
            
            // Jam
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours} : ${minutes} : ${seconds}`;
            
            // Tanggal
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const dayName = days[now.getDay()];
            const day = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            
            document.getElementById('date').textContent = `${dayName}, ${day} ${monthName} ${year}`;
        }
        
        setInterval(updateClock, 1000);
        updateClock(); // Inisialisasi awal
    </script>
</body>
</html>
