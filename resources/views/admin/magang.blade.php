@extends('admin.layout')

@section('header_title', 'Kelola Data Magang')

@section('content')
<div x-data="{ 
    showModal: false, 
    isEdit: false, 
    formData: {},
    openTambah() {
        this.isEdit = false;
        this.formData = {
            nama: '',
            asal_sekolah: '',
            mulai_magang: '',
            selesai_magang: ''
        };
        this.showModal = true;
    },
    openEdit(item) {
        this.isEdit = true;
        this.formData = {
            ...item,
            mulai_magang: item.mulai_magang ? ('' + item.mulai_magang).substring(0, 10) : '',
            selesai_magang: item.selesai_magang ? ('' + item.selesai_magang).substring(0, 10) : ''
        };
        this.showModal = true;
    }
}">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden mb-8">
        <!-- Header Tabel Kejari -->
        <div class="p-5 md:p-6 border-b border-slate-100 flex flex-wrap justify-between items-center gap-4 bg-gradient-to-r from-slate-50/80 via-white to-blue-50/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 border border-blue-200/80 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-[#063b1e] tracking-tight">Daftar Siswa & Mahasiswa Magang</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola data peserta praktik kerja dan magang di Kejaksaan Negeri</p>
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
                        <th class="py-3.5 px-4">Nama Pemagang</th>
                        <th class="py-3.5 px-4">Asal Instansi/Sekolah</th>
                        <th class="py-3.5 px-4 text-center">Tgl Mulai Magang</th>
                        <th class="py-3.5 px-4 text-center">Tgl Akhir Magang</th>
                        <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($data as $index => $item)
                    <tr class="hover:bg-amber-50/20 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-400 text-xs">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="py-3.5 px-4 font-bold text-slate-800">{{ $item->nama }}</td>
                        <td class="py-3.5 px-4 font-medium text-slate-600 text-xs">{{ $item->asal_sekolah }}</td>
                        <td class="py-3.5 px-4 text-center font-medium text-slate-600 text-xs">
                            {{ $item->mulai_magang ? \Carbon\Carbon::parse($item->mulai_magang)->translatedFormat('d F Y') : '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-center font-medium text-slate-600 text-xs">
                            {{ $item->selesai_magang ? \Carbon\Carbon::parse($item->selesai_magang)->translatedFormat('d F Y') : '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="openEdit({{ json_encode($item) }})" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 hover:text-blue-800 border border-blue-200/80 shadow-2xs transition-all hover:scale-105 active:scale-95 cursor-pointer">
                                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Edit</span>
                                </button>
                                
                                <form action="{{ route('admin.magang.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirmDelete(event, this, '{{ addslashes($item->nama) }}');" class="inline">
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
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <p class="text-sm font-semibold">Belum ada data anak magang tercatat.</p>
                                <p class="text-xs text-slate-400 mt-0.5">Klik tombol Tambah Data di atas untuk menambahkan peserta magang baru.</p>
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
                            <h3 class="text-base font-extrabold tracking-wide uppercase" x-text="isEdit ? 'Edit Data Magang' : 'Tambah Data Magang'"></h3>
                            <p class="text-xs text-emerald-100/80 font-medium">Kejaksaan Negeri Kota Tasikmalaya</p>
                        </div>
                    </div>
                    <button type="button" @click="showModal = false" class="text-white/70 hover:text-white bg-white/5 hover:bg-white/20 rounded-full p-1.5 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Form Isi Modal -->
                <form :action="isEdit ? '{{ url('admin/magang') }}/' + formData.id : '{{ route('admin.magang.store') }}'" 
                      method="POST">
                    @csrf
                    <template x-if="isEdit"><input type="hidden" name="_method" value="PUT"></template>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Pemagang <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" x-model="formData.nama" required 
                                   placeholder="Masukkan nama lengkap siswa/mahasiswa..."
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Asal Instansi / Universitas / Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="asal_sekolah" x-model="formData.asal_sekolah" required
                                   placeholder="Misal: Universitas Siliwangi, SMKN 1 Tasikmalaya..."
                                   class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Mulai Magang</label>
                                <input type="date" name="mulai_magang" x-model="formData.mulai_magang" 
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tanggal Selesai Magang</label>
                                <input type="date" name="selesai_magang" x-model="formData.selesai_magang" 
                                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0b5d30] focus:border-transparent transition">
                            </div>
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
