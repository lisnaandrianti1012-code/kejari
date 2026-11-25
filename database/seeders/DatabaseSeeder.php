<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Gaji;
use App\Models\Magang;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User Admin
        User::updateOrCreate(
            ['email' => 'adminkejaritasik@gmail.com'],
            [
                'name' => 'Admin Kejari',
                'password' => Hash::make('adminkejaritasik10'),
            ]
        );

        // 2. Master Data Pegawai (84 Pegawai Resmi Kejaksaan Negeri Kota Tasikmalaya)
        $this->call(PegawaiSeeder::class);

        // 3. Kenaikan Pangkat Pegawai
        $pangkats = [
            ['nip' => '19841109 200812 1 001', 'nama_pegawai' => 'NOPRIDIANSYA, S.H., M.H.', 'pangkat_lama' => 'Jaksa Muda (III/d)', 'pangkat_baru' => 'Jaksa Madya (IV/a)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 Juni 2026', 'progres' => 'Selesai'],
            ['nip' => '19920407 202203 1 001', 'nama_pegawai' => 'PUTRA PERMANA WIBISONO, S.Kom.', 'pangkat_lama' => 'Yuana Wira (III/a)', 'pangkat_baru' => 'Muda Wira (III/b)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19891006 201403 1 004', 'nama_pegawai' => 'ANGGA PRATAMA', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19861118 201403 1 002', 'nama_pegawai' => 'AYI NURZAMAN', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19940516 202203 2 004', 'nama_pegawai' => 'MUTHIA DEWI PRAMITA, A.Md.', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19980625 202203 2 004', 'nama_pegawai' => 'SAVIRA PUTRI LEVIANDITA, A.Md.A.B.', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19990719 202203 2 002', 'nama_pegawai' => 'ALDHA CAHAYA SARI, A.Md.Kom.', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19991220 202203 2 003', 'nama_pegawai' => 'FARAH ‘ARIFAH RAHMAH, A.Md.', 'pangkat_lama' => 'Madya Darma (II/c)', 'pangkat_baru' => 'Sena Darma (II/d)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19970907 201801 1 001', 'nama_pegawai' => 'ANDI AL FAUZAN', 'pangkat_lama' => 'Muda Darma (II/b)', 'pangkat_baru' => 'Madya Darma (II/c)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '20030530 202203 2 001', 'nama_pegawai' => 'DEA MEILINDA', 'pangkat_lama' => 'Yuana Darma (II/a)', 'pangkat_baru' => 'Muda Darma (II/b)', 'bulan_pengajuan' => null, 'bulan_sk_baru' => '01 April 2026', 'progres' => 'Selesai'],
            ['nip' => '19921113 201902 1 009', 'nama_pegawai' => 'ADLAN FAKHRUSY HAKIM, S.H., M.H.', 'pangkat_lama' => 'Ajun Jaksa (III/b)', 'pangkat_baru' => 'Jaksa Pratama (III/c)', 'bulan_pengajuan' => 'September', 'bulan_sk_baru' => '01 Februari 2027', 'progres' => 'PAK'],
            ['nip' => '19930128 201902 1 003', 'nama_pegawai' => 'IRFAN FERDIANSYAH MUIS, S.H.', 'pangkat_lama' => 'Ajun Jaksa (III/b)', 'pangkat_baru' => 'Jaksa Pratama (III/c)', 'bulan_pengajuan' => 'September', 'bulan_sk_baru' => '01 Februari 2027', 'progres' => 'PAK'],
            ['nip' => '19840130 200604 1 004', 'nama_pegawai' => 'HERI JOKO SAPUTRO, S.H., M.H.', 'pangkat_lama' => 'Jaksa Muda (III/d)', 'pangkat_baru' => 'Jaksa Madya (IV/a)', 'bulan_pengajuan' => 'September', 'bulan_sk_baru' => '01 April 2027', 'progres' => 'PAK'],
        ];

        Pangkat::truncate();
        foreach ($pangkats as $p) {
            Pangkat::create($p);
        }

        // 4. Kenaikan Gaji Berkala (KGB)
        $gajis = [
            ['nip' => '19840510 200501 1 002', 'nama_pegawai' => 'DEDY SUPRIYANTO, S.H.', 'bulan_pengajuan' => 'November 2025', 'bulan_sk_baru' => 'Januari 2026', 'progres' => 'Selesai'],
            ['nip' => '19831110 200501 1 004', 'nama_pegawai' => 'NOVAN TOPANY', 'bulan_pengajuan' => 'November 2025', 'bulan_sk_baru' => 'Januari 2026', 'progres' => 'Selesai'],
            ['nip' => '19930225 201502 1 001', 'nama_pegawai' => 'RIPTO FEBRIANTRIO', 'bulan_pengajuan' => 'Desember 2025', 'bulan_sk_baru' => 'Februari 2026', 'progres' => 'Selesai'],
            ['nip' => '19721120 199303 2 003', 'nama_pegawai' => 'IIS SUMARTINI, S.H.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19691010 199803 1 006', 'nama_pegawai' => 'IWAN SOMANTRI, S.H.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19660401 199303 1 004', 'nama_pegawai' => 'ADANG SUJANA, S.H.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19920407 202203 1 001', 'nama_pegawai' => 'PUTRA PERMANA WIBISONO, S.Kom.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19991220 202203 2 003', 'nama_pegawai' => 'FARAH ‘ARIFAH RAHMAH, A.Md.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19940516 202203 2 004', 'nama_pegawai' => 'MUTHIA DEWI PRAMITA, A.Md.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19980625 202203 2 004', 'nama_pegawai' => 'SAVIRA PUTRI LEVIANDITA, A.Md.A.B.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '19990719 202203 2 002', 'nama_pegawai' => 'ALDHA CAHAYA SARI, A.Md.Kom.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'Maret 2026', 'progres' => 'Selesai'],
            ['nip' => '20000910 202404 1 001', 'nama_pegawai' => 'MANGIRING ADJIE NAINGGOLAN, S.H.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'April 2026', 'progres' => 'Selesai'],
            ['nip' => '20010720 202404 1 001', 'nama_pegawai' => 'PRIMANDA SAYARIZKI, A.Md.Kom.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'April 2026', 'progres' => 'Selesai'],
            ['nip' => '20010312 202404 2 001', 'nama_pegawai' => 'FELICIA SOLAVIDE MALAU, A.Md.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'April 2026', 'progres' => 'Selesai'],
            ['nip' => '19990415 202404 2 001', 'nama_pegawai' => 'DELIMA PERMATA UTAMI, A.Md.M.', 'bulan_pengajuan' => 'Januari 2026', 'bulan_sk_baru' => 'April 2026', 'progres' => 'Selesai'],
            ['nip' => '19840414 200812 1 002', 'nama_pegawai' => 'FAISAL RACHMAN, S.H., M.H.', 'bulan_pengajuan' => 'Oktober 2026', 'bulan_sk_baru' => 'Desember 2026', 'progres' => '-'],
            ['nip' => '19841109 200812 1 001', 'nama_pegawai' => 'NOPRIDIANSYA, S.H., M.H.', 'bulan_pengajuan' => 'Oktober 2026', 'bulan_sk_baru' => 'Desember 2026', 'progres' => '-'],
            ['nip' => '19950628 202012 1 022', 'nama_pegawai' => 'DEDEN UMAR DANI, S.Kom.', 'bulan_pengajuan' => 'Oktober 2026', 'bulan_sk_baru' => 'Desember 2026', 'progres' => '-'],
            ['nip' => '19961110 202012 1 008', 'nama_pegawai' => 'MOCHAMAD DZIKRI DAELY, S.T.', 'bulan_pengajuan' => 'Oktober 2026', 'bulan_sk_baru' => 'Desember 2026', 'progres' => '-'],
            ['nip' => '19961010 202012 2 038', 'nama_pegawai' => 'IRMALA DEWI, A.Md.I.P.', 'bulan_pengajuan' => 'Oktober 2026', 'bulan_sk_baru' => 'Desember 2026', 'progres' => '-'],
        ];

        Gaji::truncate();
        foreach ($gajis as $g) {
            Gaji::create($g);
        }

        // 5. Data Magang (Sesuai permintaan: data magang TETAP / TIDAK DIUBAH)
        if (Magang::count() === 0) {
            $magangs = [
                ['nama' => 'Ade Ramdan', 'asal_sekolah' => 'Univ Cipasung', 'mulai_magang' => '2026-09-01', 'selesai_magang' => '2026-11-30'],
                ['nama' => 'Lisna Andriani', 'asal_sekolah' => 'Univ Cipasung', 'mulai_magang' => '2026-09-01', 'selesai_magang' => '2026-11-30'],
                ['nama' => 'Andini Sapitri', 'asal_sekolah' => 'Univ Cipasung', 'mulai_magang' => '2026-09-01', 'selesai_magang' => '2026-11-30'],
                ['nama' => 'Kristian Rizky L', 'asal_sekolah' => 'Unpas', 'mulai_magang' => '2026-09-15', 'selesai_magang' => '2027-01-01'],
                ['nama' => 'Alya Rafifah T', 'asal_sekolah' => 'SMK Rajapolah', 'mulai_magang' => '2026-12-01', 'selesai_magang' => '2027-04-17'],
                ['nama' => 'Laila Fitrya', 'asal_sekolah' => 'SMK Rajapolah', 'mulai_magang' => '2026-12-01', 'selesai_magang' => '2027-04-17'],
                ['nama' => 'Novi Indah N', 'asal_sekolah' => 'SMK Rajapolah', 'mulai_magang' => '2026-12-01', 'selesai_magang' => '2027-04-17'],
                ['nama' => 'Rama Raditia', 'asal_sekolah' => 'SMKN 4 TSM', 'mulai_magang' => '2027-01-18', 'selesai_magang' => '2027-04-23'],
                ['nama' => 'M. G’yar Zaeni', 'asal_sekolah' => 'SMKN 4 TSM', 'mulai_magang' => '2027-01-18', 'selesai_magang' => '2027-04-23'],
                ['nama' => 'Gilang Septian R', 'asal_sekolah' => 'SMKN 4 TSM', 'mulai_magang' => '2027-01-18', 'selesai_magang' => '2027-04-23'],
                ['nama' => 'Sendi', 'asal_sekolah' => 'SMKN 4 TSM', 'mulai_magang' => '2027-01-18', 'selesai_magang' => '2027-04-23'],
            ];
            foreach ($magangs as $m) {
                Magang::create($m);
            }
        }
    }
}
