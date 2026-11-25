@extends('admin.layout')

@section('header_title', 'Kelola Musik Latar TV Display')

@section('content')
<div x-data="{ showModal: false }">

    <!-- Card Musik Aktif Saat Ini -->
    <div class="bg-gradient-to-r from-[#063b1e] via-[#0b5d30] to-[#042814] rounded-2xl shadow-lg border border-emerald-800/50 p-6 mb-8 text-white relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none select-none">
            <svg class="w-64 h-64 text-amber-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
        </div>

        <div class="relative z-10 flex flex-wrap items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-amber-400/20 border border-amber-300/40 flex items-center justify-center text-amber-300 shadow-inner shrink-0">
                    <svg class="w-7 h-7 text-amber-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest bg-amber-400 text-[#063b1e] px-2.5 py-0.5 rounded-full shadow-2xs">
                            ● Musik Aktif di TV
                        </span>
                        <span class="text-xs text-emerald-200/80 font-medium">Bawaan Sistem</span>
                    </div>
                    <h2 class="text-xl md:text-2xl font-extrabold text-white tracking-wide">
                        {{ $activeMusik->judul ?? 'Belum ada musik aktif' }}
                    </h2>
                    <p class="text-xs text-emerald-100/80 mt-0.5">
                        {{ $activeMusik->keterangan ?? 'Musik latar yang otomatis diputar saat halaman TV Display dibuka.' }}
                    </p>
                </div>
            </div>

            <!-- Mini Player Preview -->
            @if($activeMusik)
            <div class="bg-white/10 backdrop-blur-md px-4 py-3 rounded-2xl border border-white/20 flex flex-col gap-1.5 w-full sm:w-auto">
                <span class="text-[11px] font-bold text-amber-300 uppercase tracking-wider flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Pratinjau Suara
                </span>
                <audio controls class="h-9 w-full sm:w-64">
                    <source src="{{ $activeMusik->url }}" type="audio/mpeg">
                    Browser Anda tidak mendukung tag audio.
                </audio>
            </div>
            @endif
        </div>
    </div>

    <!-- Tabel Daftar Koleksi Musik -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden mb-8">
        <div class="p-5 md:p-6 border-b border-slate-100 flex flex-wrap justify-between items-center gap-4 bg-gradient-to-r from-slate-50/80 via-white to-amber-50/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200/80 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-[#063b1e] tracking-tight">Koleksi Musik Latar</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar file audio yang dapat dipilih dan diputar di layar TV Display</p>
                </div>
            </div>
            <button @click="showModal = true" 
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-[#0b5d30] to-[#063b1e] hover:from-[#094d28] hover:to-[#042814] text-white px-4 py-2.5 rounded-xl shadow-md shadow-[#0b5d30]/20 font-bold text-xs uppercase tracking-wider transition-all duration-200 hover:scale-105 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>+ Upload Musik Baru</span>
            </button>
        </div>

        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-600 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-200">
                        <th class="py-3.5 px-4 text-center w-14">No</th>
                        <th class="py-3.5 px-4">Judul Lagu / Musik</th>
                        <th class="py-3.5 px-4">Pemutar Audio</th>
                        <th class="py-3.5 px-4 text-center">Status Default</th>
                        <th class="py-3.5 px-4">Keterangan</th>
                        <th class="py-3.5 px-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($data as $index => $item)
                    <tr class="hover:bg-amber-50/20 transition-colors {{ $item->is_active ? 'bg-emerald-50/30' : '' }}">
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-400 text-xs">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="py-3.5 px-4 font-bold text-slate-800">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-lg bg-emerald-100/80 text-[#0b5d30] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                                </span>
                                <div>
                                    <span class="block text-sm font-extrabold text-slate-800">{{ $item->judul }}</span>
                                    <span class="block text-[11px] text-slate-400 font-mono">{{ basename($item->file_path) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <audio controls class="h-8 max-w-[220px]">
                                <source src="{{ $item->url }}" type="audio/mpeg">
                            </audio>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($item->is_active)
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200/80 shadow-2xs">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>AKTIF DI TV</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-slate-200">
                                    <span>Pilihan Tambahan</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-xs text-slate-600 font-medium">
                            {{ $item->keterangan ?: '—' }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if(!$item->is_active)
                                <form action="{{ route('admin.musik.setActive', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 hover:text-emerald-800 border border-emerald-200/80 shadow-2xs transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Pilih Aktif</span>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('admin.musik.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirmDelete(event, this, '{{ addslashes($item->judul) }}');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-red-700 bg-red-50 hover:bg-red-100 hover:text-red-800 border border-red-200/80 shadow-2xs transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            <p class="text-sm font-semibold">Belum ada file musik diunggah.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Upload Musik Baru -->
    <div x-show="showModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 @click="showModal = false"></div>

            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block w-full max-w-lg overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl border border-slate-100 z-10">
                
                <div class="bg-gradient-to-r from-[#0b5d30] via-[#094d28] to-[#063b1e] px-6 py-4 flex items-center justify-between text-white border-b border-emerald-800/40">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-xs border border-white/20 flex items-center justify-center text-amber-300 shrink-0">
                            <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold tracking-wide uppercase">Upload Musik Baru</h3>
                            <p class="text-xs text-emerald-100/80 font-medium">Format didukung: MP3, WAV, M4A, OGG (Maks. 30MB)</p>
                        </div>
                    </div>
                    <button type="button" @click="showModal = false" class="text-white/70 hover:text-white bg-white/5 hover:bg-white/20 rounded-full p-1.5 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form action="{{ route('admin.musik.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Judul Musik / Lagu <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" required 
                                   placeholder="Misal: Mars Kejaksaan RI, Instrumental Tradisional Sunda..."
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">File Audio (.mp3, .wav, .m4a) <span class="text-red-500">*</span></label>
                            <input type="file" name="audio_file" accept="audio/*,.mp3,.wav,.ogg,.m4a" required
                                   class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-extrabold file:bg-[#0b5d30] file:text-white hover:file:bg-[#094d28] cursor-pointer">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Keterangan / Catatan <span class="text-slate-400 font-normal normal-case">(opsional)</span></label>
                            <input type="text" name="keterangan" 
                                   placeholder="Misal: Instrumen tenang untuk jam pelayanan pagi..."
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>

                        <div class="p-3 bg-emerald-50/60 rounded-xl border border-emerald-100 flex items-center gap-3">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-[#0b5d30] rounded focus:ring-[#0b5d30] cursor-pointer">
                            <label for="is_active" class="text-xs font-bold text-[#063b1e] cursor-pointer">
                                Jadikan sebagai musik aktif (langsung diputar di TV Display)
                            </label>
                        </div>
                    </div>

                    <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100 rounded-b-2xl">
                        <button type="button" @click="showModal = false" 
                                class="px-4 py-2.5 text-xs uppercase tracking-wider font-bold text-slate-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl transition shadow-2xs cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-xs uppercase tracking-wider font-bold text-white bg-gradient-to-r from-[#0b5d30] to-[#063b1e] hover:from-[#094d28] hover:to-[#042814] rounded-xl shadow-md shadow-[#0b5d30]/20 hover:scale-105 active:scale-95 transition cursor-pointer">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span>Upload & Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
