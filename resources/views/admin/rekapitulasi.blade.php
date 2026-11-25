@extends('admin.layout')

@section('header_title', 'Rekapitulasi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-8">
    
    <div class="text-center mb-8">
        <h3 class="text-2xl font-extrabold text-[#0b5d30] mb-2">Cetak & Unduh Laporan Rekapitulasi</h3>
        <p class="text-gray-600">
            Pilih jenis rekapitulasi data yang ingin Anda lihat laporannya atau cetak/unduh sebagai file PDF. 
            Tekan tombol <b>Print / Download PDF</b>, lalu pilih "Save as PDF" di jendela Print yang muncul.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Rekap Pangkat -->
        <div class="border-2 border-gray-100 hover:border-[#0b5d30] rounded-xl p-6 flex flex-col items-center text-center transition group bg-gray-50 hover:bg-white shadow-sm">
            <div class="w-16 h-16 bg-green-100 text-[#0b5d30] rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h4 class="font-bold text-gray-800 text-lg mb-1">Kenaikan Pangkat</h4>
            <p class="text-sm text-gray-500 mb-4">Total Data: {{ $countPangkat }} Pegawai</p>
            <a href="{{ route('admin.rekapitulasi.print', 'pangkat') }}" target="_blank" class="mt-auto w-full bg-[#0b5d30] text-white py-2 rounded-lg font-bold hover:bg-[#094d28] transition flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print / Download PDF
            </a>
        </div>

        <!-- Rekap Gaji -->
        <div class="border-2 border-gray-100 hover:border-[#facc15] rounded-xl p-6 flex flex-col items-center text-center transition group bg-gray-50 hover:bg-white shadow-sm">
            <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h4 class="font-bold text-gray-800 text-lg mb-1">Kenaikan Gaji Berkala</h4>
            <p class="text-sm text-gray-500 mb-4">Total Data: {{ $countGaji }} Pegawai</p>
            <a href="{{ route('admin.rekapitulasi.print', 'gaji') }}" target="_blank" class="mt-auto w-full bg-[#facc15] text-[#0b5d30] py-2 rounded-lg font-bold hover:bg-yellow-400 transition flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print / Download PDF
            </a>
        </div>

        <!-- Rekap Magang -->
        <div class="border-2 border-gray-100 hover:border-blue-500 rounded-xl p-6 flex flex-col items-center text-center transition group bg-gray-50 hover:bg-white shadow-sm">
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h4 class="font-bold text-gray-800 text-lg mb-1">Data Anak Magang</h4>
            <p class="text-sm text-gray-500 mb-4">Total Data: {{ $countMagang }} Peserta</p>
            <a href="{{ route('admin.rekapitulasi.print', 'magang') }}" target="_blank" class="mt-auto w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition flex justify-center items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print / Download PDF
            </a>
        </div>

    </div>
</div>
@endsection
