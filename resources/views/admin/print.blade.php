<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; color: #000; padding: 20px; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .kop-surat img { width: 80px; position: absolute; left: 40px; }
        .kop-surat h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .kop-surat h2 { margin: 5px 0 0 0; font-size: 18px; font-weight: normal; }
        .kop-surat p { margin: 5px 0 0 0; font-size: 12px; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; text-decoration: underline; }
        table { w-full; width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; text-align: center; }
        .ttd { width: 300px; float: right; text-align: center; margin-top: 30px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .btn-print { background: #0b5d30; color: #fff; border: none; padding: 10px 20px; cursor: pointer; font-size: 16px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <button class="btn-print no-print" onclick="window.print()">🖨️ Cetak / Simpan sebagai PDF</button>

    <div class="kop-surat">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h1>KEJAKSAAN NEGERI KOTA TASIKMALAYA</h1>
        <h2>Sub Bagian Pembinaan</h2>
        <p>Jl. Ir. H. Juanda No.14, Panyingkiran, Kec. Indihiang, Kab. Tasikmalaya, Jawa Barat 46151</p>
    </div>

    <div class="title">
        Laporan {{ $title }}
    </div>

    <table>
        <thead>
            @if($jenis == 'pangkat')
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Pegawai</th>
                    <th>Pangkat Lama</th>
                    <th>Pangkat Baru</th>
                    <th>Bulan Pengajuan</th>
                    <th>Bulan SK Baru</th>
                    <th>Progres</th>
                </tr>
            @elseif($jenis == 'gaji')
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Pegawai</th>
                    <th>Bulan Pengajuan</th>
                    <th>Bulan SK Baru</th>
                    <th>Progres</th>
                </tr>
            @else
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Anak Magang</th>
                    <th>Asal Instansi/Sekolah</th>
                    <th>Mulai Magang</th>
                    <th>Selesai Magang</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                
                @if($jenis == 'pangkat')
                    <td>{{ $item->nama_pegawai }}</td>
                    <td>{{ $item->pangkat_lama }}</td>
                    <td>{{ $item->pangkat_baru }}</td>
                    <td style="text-align: center;">{{ $item->bulan_pengajuan }}</td>
                    <td style="text-align: center;">{{ $item->bulan_sk_baru }}</td>
                    <td style="text-align: center;">{{ $item->progres }}</td>
                @elseif($jenis == 'gaji')
                    <td>{{ $item->nama_pegawai }}</td>
                    <td style="text-align: center;">{{ $item->bulan_pengajuan }}</td>
                    <td style="text-align: center;">{{ $item->bulan_sk_baru }}</td>
                    <td style="text-align: center;">{{ $item->progres }}</td>
                @else
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                    <td style="text-align: center;">{{ $item->mulai_magang ? \Carbon\Carbon::parse($item->mulai_magang)->format('d F Y') : '-' }}</td>
                    <td style="text-align: center;">{{ $item->selesai_magang ? \Carbon\Carbon::parse($item->selesai_magang)->format('d F Y') : '-' }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Tasikmalaya, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom: 70px;">Mengetahui,<br>Kepala Sub Bagian Pembinaan</p>
        <p style="font-weight: bold; text-decoration: underline;">(..............................................)</p>
    </div>

</body>
</html>
