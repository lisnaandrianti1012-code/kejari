@extends('admin.layout')

@section('header_title', 'Kelola Kenaikan Pangkat')

@section('content')
<div x-data="{ 
    showModal: false, 
    isEdit: false, 
    formData: {},
    pegawais: {{ \Illuminate\Support\Js::from($pegawais ?? []) }},
    openTambah() {
        this.isEdit = false;
        this.formData = {
            nip: '',
            nama_pegawai: '',
            pangkat_lama: '',
            pangkat_baru: '',
            bulan_pengajuan: '',
            bulan_sk_baru: '',
            progres: 'Selesai'
        };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.formData = { ...item };
        this.showModal = true;
    },
    onNipChange(val) {
        if (!val) return;
        const cleanVal = ('' + val).replace(/[\s\.\-]/g, '').toLowerCase();
        const found = this.pegawais.find(p => {
            const cleanNip = (p.nip || '').replace(/[\s\.\-]/g, '').toLowerCase();
            const cleanNama = (p.nama || '').toLowerCase();
            return (cleanNip && cleanNip === cleanVal) || cleanNama === val.toLowerCase() || (p.nip && p.nip.trim() === val.trim());
        });
        if (found) {
            this.formData.nip = found.nip;
            this.formData.nama_pegawai = found.nama;
            this.formData.pangkat_lama = found.pangkat;
        }
    },
    onNamaChange(val) {
        if (!val) return;
        const found = this.pegawais.find(p => p.nama.toLowerCase() === val.toLowerCase());
        if (found) {
            this.formData.nip = found.nip;
            this.formData.pangkat_lama = found.pangkat;
        }
    }
}">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden mb-8">
        <!-- Header Tabel Kejari -->
        <div class="p-5 md:p-6 border-b border-slate-100 flex flex-wrap justify-between items-center gap-4 bg-gradient-to-r from-slate-50/80 via-white to-amber-50/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200/80 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-[#063b1e] tracking-tight">Daftar Kenaikan Pangkat Pegawai</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola progres dan riwayat usulan kenaikan pangkat pegawai</p>
                </div>
            </div>
            <button @click="openTambah()"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-[#0b5d30] to-[#063b1e] hover:from-[#094d28] hover:to-[#042814] text-white px-4 py-2.5 rounded-xl shadow-md shadow-[#0b5d30]/20 font-bold text-xs uppercase tracking-wider transition-all duration-200 hover:scale-105 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Data</span>
            </button>
        </div>
        
        <!-- Tabel Responsif -->
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-600 text-[11px] uppercase tracking-wider font-extrabold border-b border-slate-200">
                        <th class="py-3.5 px-4 text-center w-14">No</th>
                        <th class="py-3.5 px-4">Nama Pegawai</th>
                        <th class="py-3.5 px-4">Pangkat Lama</th>
                        <th class="py-3.5 px-4">Pangkat Baru</th>
                        <th class="py-3.5 px-4 text-center">Bulan Pengajuan</th>
                        <th class="py-3.5 px-4 text-center">Bulan SK Baru</th>
                        <th class="py-3.5 px-4 text-center">Progres</th>
                        <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($data as $index => $item)
                    <tr class="hover:bg-amber-50/20 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-400 text-xs">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-slate-800">{{ $item->nama_pegawai }}</div>
                            @if(!empty($item->nip))
                                <div class="text-[11px] font-mono text-slate-400 font-medium">NIP. {{ $item->nip }}</div>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-slate-600 font-medium text-xs">{{ $item->pangkat_lama }}</td>
                        <td class="py-3.5 px-4 font-bold text-[#063b1e] text-xs">{{ $item->pangkat_baru }}</td>
                        <td class="py-3.5 px-4 text-center text-slate-600 font-medium text-xs">{{ $item->bulan_pengajuan ?: '—' }}</td>
                        <td class="py-3.5 px-4 text-center text-slate-600 font-medium text-xs">{{ $item->bulan_sk_baru ?: '—' }}</td>
                        <td class="py-3.5 px-4 text-center">
                            @if($item->progres == 'Selesai')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200/80 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>SELESAI</span>
                                </span>
                            @elseif($item->progres == 'PAK')
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 text-xs font-bold px-3 py-1 rounded-full border border-amber-200/80 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>PAK</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1 rounded-full border border-slate-200 shadow-2xs">
                                    <span>{{ $item->progres ?: '—' }}</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="openEdit({{ json_encode($item) }})" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 hover:text-blue-800 border border-blue-200/80 shadow-2xs transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Edit</span>
                                </button>
                                
                                <form action="{{ route('admin.pangkat.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirmDelete(event, this, '{{ addslashes($item->nama_pegawai) }}');" class="inline">
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
                        <td colspan="8" class="py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-sm font-semibold">Belum ada data kenaikan pangkat tercatat.</p>
                                <p class="text-xs text-slate-400 mt-0.5">Klik tombol Tambah Data di atas untuk menambahkan usulan kenaikan pangkat.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form (Tambah / Edit) Pop Up Keren & Modern -->
    <div x-show="showModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Backdrop Blur Frosted Glass Effect -->
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity" 
                 @click="showModal = false"></div>

            <!-- Panel Dialog Modal -->
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block w-full max-w-lg overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl border border-slate-100 z-10">
                
                <!-- Header Modal Gradient Kejari -->
                <div class="bg-gradient-to-r from-[#0b5d30] via-[#094d28] to-[#063b1e] px-6 py-4 flex items-center justify-between text-white border-b border-emerald-800/40">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-xs border border-white/20 flex items-center justify-center text-amber-300 shrink-0">
                            <template x-if="isEdit">
                                <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </template>
                            <template x-if="!isEdit">
                                <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </template>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold tracking-wide uppercase" x-text="isEdit ? 'Edit Kenaikan Pangkat' : 'Tambah Kenaikan Pangkat'"></h3>
                            <p class="text-xs text-emerald-100/80 font-medium">Kejaksaan Negeri Kota Tasikmalaya</p>
                        </div>
                    </div>
                    <button type="button" @click="showModal = false" class="text-white/70 hover:text-white bg-white/5 hover:bg-white/20 rounded-full p-1.5 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Form Isi Modal -->
                <form :action="isEdit ? '{{ url('admin/kenaikan-pangkat') }}/' + formData.id : '{{ route('admin.pangkat.store') }}'" 
                      method="POST">
                    @csrf
                    <template x-if="isEdit"><input type="hidden" name="_method" value="PUT"></template>
                    
                    <div class="p-6 space-y-4">
                        <!-- Input NIP dengan Fitur Auto-Fill Nama & Pangkat Lama -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">NIP Pegawai</label>
                                <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">⚡ Auto-Fill Otomatis</span>
                            </div>
                            <div class="relative">
                                <input type="text" name="nip" x-model="formData.nip" 
                                       list="nip_list_pangkat"
                                       @input="onNipChange($event.target.value)"
                                       @change="onNipChange($event.target.value)"
                                       placeholder="Ketik NIP pegawai (contoh: 19840414 200812 1 002)..."
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition font-mono">
                                <datalist id="nip_list_pangkat">
                                    <template x-for="p in pegawais" :key="p.id">
                                        <option :value="p.nip" x-text="p.nama + ' — ' + p.pangkat"></option>
                                    </template>
                                </datalist>
                            </div>
                            <template x-if="formData.nama_pegawai">
                                <div class="mt-2 p-2.5 bg-emerald-50/90 border border-emerald-200/90 rounded-xl flex items-center gap-2 text-xs text-emerald-800">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <div class="truncate">
                                        Data Ditemukan: <strong x-text="formData.nama_pegawai"></strong> &bull; Pangkat: <strong x-text="formData.pangkat_lama"></strong>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Pegawai <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_pegawai" x-model="formData.nama_pegawai" 
                                   @input="onNamaChange($event.target.value)"
                                   required 
                                   placeholder="Masukkan nama lengkap & gelar..."
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pangkat Lama</label>
                                <input type="text" name="pangkat_lama" x-model="formData.pangkat_lama" 
                                       placeholder="Misal: Penata Muda (III/a)"
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Pangkat Baru</label>
                                <input type="text" name="pangkat_baru" x-model="formData.pangkat_baru" 
                                       placeholder="Misal: Penata (III/c)"
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Bulan Pengajuan</label>
                                <input type="text" name="bulan_pengajuan" x-model="formData.bulan_pengajuan" 
                                       placeholder="Misal: September 2026" 
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Bulan SK Baru</label>
                                <input type="text" name="bulan_sk_baru" x-model="formData.bulan_sk_baru" 
                                       placeholder="Misal: 01 April 2026" 
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Status Progres</label>
                            <input type="text" name="progres" x-model="formData.progres" 
                                   placeholder="Misal: Selesai / PAK / -" 
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>
                    </div>
                    
                    <!-- Footer Action Buttons Modal -->
                    <div class="bg-slate-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-slate-100 rounded-b-2xl">
                        <button type="button" @click="showModal = false" 
                                class="px-4 py-2.5 text-xs uppercase tracking-wider font-bold text-slate-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl transition shadow-2xs cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-xs uppercase tracking-wider font-bold text-white bg-gradient-to-r from-[#0b5d30] to-[#063b1e] hover:from-[#094d28] hover:to-[#042814] rounded-xl shadow-md shadow-[#0b5d30]/20 hover:scale-105 active:scale-95 transition cursor-pointer">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span x-text="isEdit ? 'Simpan Perubahan' : 'Simpan Data'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
