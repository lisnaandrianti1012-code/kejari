<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pangkat;
use App\Models\Gaji;
use App\Models\Magang;
use App\Models\Kehadiran;
use App\Models\Musik;

class DisplayController extends Controller
{
    public function index()
    {
        $pangkats = Pangkat::oldest()->get();
        $gajis = Gaji::oldest()->get();
        $magangs = Magang::oldest()->get();
        $kehadirans = Kehadiran::latest()->get();

        // REKAPITULASI MAGANG (Bulanan)
        $rekapMagang = [];
        if ($magangs->count() > 0) {
            $minDate = Magang::min('mulai_magang');
            $maxDate = Magang::max('selesai_magang');
            
            if ($minDate && $maxDate) {
                $start = new \DateTime(date('Y-m-01', strtotime($minDate)));
                $end = new \DateTime(date('Y-m-t', strtotime($maxDate)));
                $interval = \DateInterval::createFromDateString('1 month');
                $period = new \DatePeriod($start, $interval, $end->modify('+1 day'));
                
                $index = 1;
                $bulanIndo = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];

                foreach ($period as $dt) {
                    $startOfMonth = $dt->format('Y-m-01');
                    $endOfMonth = $dt->format('Y-m-t');
                    
                    $count = Magang::where('mulai_magang', '<=', $endOfMonth)
                                   ->where('selesai_magang', '>=', $startOfMonth)
                                   ->count();
                    
                    $engMonth = $dt->format('F');
                    $namaBulan = $bulanIndo[$engMonth] . ' ' . $dt->format('Y');
                    
                    $rekapMagang[] = (object)[
                        'no' => $index++,
                        'bulan' => $namaBulan,
                        'jumlah' => $count . ' orang'
                    ];
                }
            }
        }
        
        $musiks = Musik::all();
        $activeMusik = Musik::where('is_active', true)->first() ?: Musik::first();

        return view('display.index', compact('pangkats', 'gajis', 'magangs', 'rekapMagang', 'kehadirans', 'musiks', 'activeMusik'));
    }

    public function uploadMusik(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg,m4a,mp4,audio/mpeg,audio/mp3|max:30720',
        ]);

        $file = $request->file('audio_file');
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $destinationPath = public_path('uploads/musik');
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $filename);
        $relativePath = 'uploads/musik/' . $filename;

        // Jadikan musik baru langsung aktif
        Musik::query()->update(['is_active' => false]);
        $musik = Musik::create([
            'judul' => $request->judul,
            'file_path' => $relativePath,
            'is_active' => true,
            'keterangan' => 'Diunggah via TV Display',
        ]);

        return back()->with('new_music_url', $musik->url)->with('new_music_title', $musik->judul)->with('success', 'Musik baru berhasil ditambahkan dan dipilih!');
    }
}
