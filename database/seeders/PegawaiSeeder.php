<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $pegawais = [
            ['nama' => 'ERNY VERONICA MARAMBA, S.H., M.Hum.', 'pangkat' => 'Jaksa Utama Pratama (IV/b)', 'nip' => '19690504 199603 2 001', 'jabatan' => 'Kepala Kejaksaan Negeri Kota Tasikmalaya'],
            ['nama' => 'FAISAL RACHMAN, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19840414 200812 1 002', 'jabatan' => 'Kepala Subbagian Pembinaan'],
            ['nama' => 'AGSYANA, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19830827 200712 1 001', 'jabatan' => 'Kepala Seksi Tindak Pidana Umum'],
            ['nama' => 'EKA PRASETYA SAPUTRA, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19800802 200501 1 006', 'jabatan' => 'Kepala Seksi Tindak Pidana Khusus'],
            ['nama' => 'NOPRIDIANSYA, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19841109 200812 1 001', 'jabatan' => 'Kepala Seksi Intelijen'],
            ['nama' => 'MOCHAMAD TAUFIK Y, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19820107 200212 1 002', 'jabatan' => 'Kepala Seksi Pemulihan Aset dan Pengelolaan Barang Bukti'],
            ['nama' => 'HERI JOKO SAPUTRO, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19840130 200604 1 004', 'jabatan' => 'Kepala Seksi Perdata dan Tata Usaha Negara'],
            ['nama' => 'AHMAD SIDIK, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19660220 198603 1 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'JAJANG SAEPUDIN, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19650311 198803 1 002', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'SRI MARYATI, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19671102 198803 2 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'DUDDY SUDIHARTO, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19710311 199703 1 005', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'IWAN SOMANTRI, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19691010 199803 1 006', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'IIS SUMARTINI, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19721120 199303 2 003', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'ACHMAD ARIES SYAIFUDIN, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19790323 200501 1 009', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'YURIS SETIA NINGSIH A., S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19820911 200712 2 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'IWAN RIDJWAN, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19800923 200312 1 002', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'IRMA RAHMAWATI, S.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19741027 200212 2 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'SITI HALIMATUN, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19841224 200712 2 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'YOSEP RUSDIAWAN, S.H., M.H.', 'pangkat' => 'Jaksa Madya (IV/a)', 'nip' => '19810819 200712 1 001', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'ADANG SUJANA, S.H.', 'pangkat' => 'Jaksa Muda (III/d)', 'nip' => '19660401 199303 1 004', 'jabatan' => 'Jaksa Fungsional'],
            ['nama' => 'INDAH PUJIATI, S.H.', 'pangkat' => 'Jaksa Pratama (III/c)', 'nip' => '19880127 201502 2 001', 'jabatan' => 'Kepala Subseksi Prapenuntutan'],
            ['nama' => 'ALIFFIAN FAHMY ANNASHRI, S.H.', 'pangkat' => 'Jaksa Pratama (III/c)', 'nip' => '19940607 201801 1 003', 'jabatan' => 'Kepala Subseksi Perdata dan Tata Usaha Negara'],
            ['nama' => 'VERONICA DWI LESTARI U, S.H.', 'pangkat' => 'Jaksa Pratama (III/c)', 'nip' => '19950730 201801 2 002', 'jabatan' => 'Kepala Subseksi Pertimbangan Hukum Perdata dan Tata Usaha Negara'],
            ['nama' => 'ADLAN FAKHRUSY HAKIM, S.H., M.H.', 'pangkat' => 'Jaksa Pratama (III/c)', 'nip' => '19921113 201902 1 009', 'jabatan' => 'Kepala Subseksi I Intelijen'],
            ['nama' => 'IRFAN FERDIANSYAH MUIS, S.H.', 'pangkat' => 'Ajun Jaksa (III/b)', 'nip' => '19930128 201902 1 003', 'jabatan' => 'Kepala Subseksi Penuntutan, Upaya Hukum Luar Biasa, dan Eksekusi Seksi Tindak Pidana Khusus'],
            ['nama' => 'KRISNA AGUNG SETIAWAN, S.H., M.Kn.', 'pangkat' => 'Ajun Jaksa (III/b)', 'nip' => '19970901 202203 1 002', 'jabatan' => 'Kepala Subseksi II Intelijen'],
            ['nama' => 'GANDA YOSAFAT MARULI TUA, S.H.', 'pangkat' => 'Ajun Jaksa (III/b)', 'nip' => '19970430 202203 1 001', 'jabatan' => 'Kepala Subseksi Penuntutan, Eksekusi dan Eksaminasi Seksi Tindak Pidana Umum'],
            ['nama' => 'JEFRI EWARDIMAN, S.H.', 'pangkat' => 'Ajun Jaksa (III/b)', 'nip' => '19980115 202203 1 003', 'jabatan' => 'Kepala Subseksi Penyidikan dan Pengendalian Operasi Seksi Tindak Pidana Khusus'],
            ['nama' => 'SUPRIATNA, S.H.', 'pangkat' => 'Sena Wira (III/d)', 'nip' => '19710306 199403 1 002', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'NURMAJATI, S.H.', 'pangkat' => 'Sena Wira (III/d)', 'nip' => '19691211 199203 2 003', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'ARIEF BUDIMAN, S.H.', 'pangkat' => 'Sena Wira (III/d)', 'nip' => '19730408 199903 1 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'ASEP DARYONO, S.H.', 'pangkat' => 'Sena Wira (III/d)', 'nip' => '19791105 200712 1 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'DEDY SUPRIYANTO, S.H.', 'pangkat' => 'Madya Wira (III/c)', 'nip' => '19840510 200501 1 002', 'jabatan' => 'Analis Pengelolaan Keuangan APBN Ahli Pertama'],
            ['nama' => 'NOVIYANTO AZIZ, S.H.', 'pangkat' => 'Madya Wira (III/c)', 'nip' => '19821103 200912 1 001', 'jabatan' => 'Kepala Urusan Perlengkapan'],
            ['nama' => 'AHMAD SODIK, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19930726 201403 1 001', 'jabatan' => 'Kepala Urusan Kepegawaian, Keuangan, dan PNBP'],
            ['nama' => 'MIKHAIEL KHARISMA, S.H.', 'pangkat' => 'Muda Wira (III/b)', 'nip' => '19880521 201012 1 004', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'NOVAN TOPANY', 'pangkat' => 'Muda Wira (III/b)', 'nip' => '19831110 200501 1 004', 'jabatan' => 'Kepala Urusan Tata Usaha, Perpustakaan dan Daskrimti'],
            ['nama' => 'DEDEN UMAR DANI, S.Kom.', 'pangkat' => 'Muda Wira (III/b)', 'nip' => '19950628 202012 1 022', 'jabatan' => 'Pranata Komputer Ahli Pertama'],
            ['nama' => 'MOCHAMAD DZIKRI DAELY, S.T.', 'pangkat' => 'Muda Wira (III/b)', 'nip' => '19961110 202012 1 008', 'jabatan' => 'Pranata Komputer Ahli Pertama'],
            ['nama' => 'PUTRA PERMANA WIBISONO, S.Kom.', 'pangkat' => 'Muda Wira (III/b)', 'nip' => '19920407 202203 1 001', 'jabatan' => 'Pemeriksa Forensik Digital'],
            ['nama' => 'IIS NURJANAH, S.E.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19900629 201403 2 003', 'jabatan' => 'Penelaah Teknis Kebijakan'],
            ['nama' => 'MANGIRING ADJIE NAINGGOLAN, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20000910 202404 1 001', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'RIKI MUHAMMAD FIRDAUS, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20000414 202505 1 004', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'KAYLA ZEVIRA ALFASHA D, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20001220 202505 2 009', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'THASYA GHERI SONYA, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20000304 202505 2 005', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'TATA ANGELIA, S.H.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20020207 202505 2 002', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'NINDITA KUSUMAWATI, SH.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '20001011 202505 2 012', 'jabatan' => 'Penelaah Penuntutan & Penegakan Hukum'],
            ['nama' => 'M. KHUSNAN HADI, S.IP.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19900427 202505 1 001', 'jabatan' => 'Arsiparis Ahli Pertama'],
            ['nama' => 'LOIS MIKAEL CAMDESUS, S.Kom.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19990308 202505 1 003', 'jabatan' => 'Pranata Komputer Ahli Pertama'],
            ['nama' => 'GILANG BAGASKARA ISKANDAR, S.M.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19940913 202505 1 001', 'jabatan' => 'Penilai Pemerintah Ahli Pertama'],
            ['nama' => 'NUGROHO ADRI PUTRANTO, S.Ak.', 'pangkat' => 'Yuana Wira (III/a)', 'nip' => '19980714 202505 1 006', 'jabatan' => 'Perencana Ahli Pertama'],
            ['nama' => 'AYI NURZAMAN', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19861118 201403 1 002', 'jabatan' => 'Penelaah Teknis Kebijakan'],
            ['nama' => 'ANGGA PRATAMA', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19891006 201403 1 004', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'IRMALA DEWI, A.Md.I.P.', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19961010 202012 2 038', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'MUTHIA DEWI PRAMITA, A.Md.', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19940516 202203 2 004', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'ALDHA CAHAYA SARI, A.Md.Kom.', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19990719 202203 2 002', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'SAVIRA PUTRI LEVIANDITA, A.Md.A.B.', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19980625 202203 2 004', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'FARAH ‘ARIFAH RAHMAH, A.Md.', 'pangkat' => 'Sena Darma (II/d)', 'nip' => '19991220 202203 2 003', 'jabatan' => 'Pengolah Data dan Informasi'],
            ['nama' => 'RIPTO FEBRIANTRIO', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19930225 201502 1 001', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'ANDI AL FAUZAN', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19970907 201801 1 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'DELIMA PERMATA UTAMI, A.Md.M.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19990415 202404 2 001', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'FELICIA SOLAVIDE MALAU, A.Md.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '20010312 202404 2 001', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'PRIMANDA SAYARIZKI, A.Md.Kom.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '20010720 202404 1 001', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'FAIQ ZAEN AUDILLAH, A.Md.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19971004 202505 1 004', 'jabatan' => 'Pranata Hubungan Masyarakat Terampil'],
            ['nama' => 'REYHAN REGINA RIZKYANI, A.Md.A.B.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '20020520 202505 2 004', 'jabatan' => 'Arsiparis Terampil'],
            ['nama' => 'DINO ARMANDO, A.Md.T.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19980611 202505 1 005', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'FIRDA MONITA DEWI, A.Md.Log.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19980307 202505 2 004', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'SUKARDIANTO PUTRA, A.Md.Kom.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19931009 202505 1 004', 'jabatan' => 'Petugas Aset dan Barang Bukti'],
            ['nama' => 'ANGGRAENI HERY RAHMAWATI, A.Md.', 'pangkat' => 'Madya Darma (II/c)', 'nip' => '19930914 202505 2 007', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'YUSDIANTI SAPUTRI', 'pangkat' => 'Muda Darma (II/b)', 'nip' => '19891219 202012 2 015', 'jabatan' => 'Operator Layanan Operasional'],
            ['nama' => 'S.M. WINDRA BUDI SETIAWAN', 'pangkat' => 'Muda Darma (II/b)', 'nip' => '19900925 202012 1 010', 'jabatan' => 'Operator Layanan Operasional'],
            ['nama' => 'NURUL SUBEKTI', 'pangkat' => 'Muda Darma (II/b)', 'nip' => '20000603 202012 2 004', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'DESY MAHARANI', 'pangkat' => 'Muda Darma (II/b)', 'nip' => '19980522 202012 2 009', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'LISTY ISMIATUN', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '19931002 202404 2 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'FEBBY NURHELIZA', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '19990228 202404 2 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'HANISAH TRI UTAMI', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '19990324 202404 2 002', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'SITI ALIYATUL AZIZAH', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20050816 202404 2 001', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'MUHAMMAD DAFFA RIFALDI', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20020720 202404 1 002', 'jabatan' => 'Pengelola Penanganan Perkara'],
            ['nama' => 'YOLANDA ASMARA DEGITA', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20010807 202404 1 001', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'NANDA ADI AFRIAN', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20020419 202404 1 001', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'YOLANDA SUCI RAHMADANI', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20001129 202404 2 002', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'DEA MEILINDA', 'pangkat' => 'Muda Darma (II/b)', 'nip' => '20030530 202203 2 001', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'AJENG SILVIANA PUTRI', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '19990430 202505 2 011', 'jabatan' => 'Pengawal Yustisial'],
            ['nama' => 'MELISA CAHAYA LESTARI', 'pangkat' => 'Yuana Darma (II/a)', 'nip' => '20040527 202505 2 001', 'jabatan' => 'Pengawal Yustisial'],
        ];

        foreach ($pegawais as $p) {
            Pegawai::updateOrCreate(
                ['nip' => $p['nip']],
                [
                    'nama' => $p['nama'],
                    'pangkat' => $p['pangkat'],
                    'jabatan' => $p['jabatan']
                ]
            );
        }
    }
}
