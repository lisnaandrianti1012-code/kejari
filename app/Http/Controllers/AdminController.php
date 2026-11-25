<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pangkat;
use App\Models\Gaji;
use App\Models\Magang;
use App\Models\Kehadiran;
use App\Models\Musik;
use App\Models\Pegawai;

class AdminController extends Controller
{
    public function dashboard()
    {
        $countPangkat = Pangkat::count();
        $countGaji = Gaji::count();
        $countMagang = Magang::count(); // Semua magang (tidak ada kolom status lagi)
        
        // Data terbaru agar dashboard terlihat real-time dan aktif
        $recentPangkat = Pangkat::latest()->take(5)->get();
        $recentGaji = Gaji::latest()->take(5)->get();
        $recentMagang = Magang::latest()->take(5)->get();

        return view('admin.dashboard', compact('countPangkat', 'countGaji', 'countMagang', 'recentPangkat', 'recentGaji', 'recentMagang'));
    }

    // PANGKAT
    public function pangkat() 
    { 
        return view('admin.pangkat', [
            'data' => Pangkat::oldest()->get(),
            'pegawais' => Pegawai::orderBy('nama')->get()
        ]); 
    }
    public function storePangkat(Request $request) { Pangkat::create($request->all()); return back()->with('success', 'Data Pangkat Ditambahkan!'); }
    public function updatePangkat(Request $request, $id) { Pangkat::findOrFail($id)->update($request->all()); return back()->with('success', 'Data Pangkat Diupdate!'); }
    public function destroyPangkat($id) { Pangkat::destroy($id); return back()->with('success', 'Data Pangkat Dihapus!'); }

    // GAJI
    public function gaji() 
    { 
        return view('admin.gaji', [
            'data' => Gaji::oldest()->get(),
            'pegawais' => Pegawai::orderBy('nama')->get()
        ]); 
    }
    public function storeGaji(Request $request) { Gaji::create($request->all()); return back()->with('success', 'Data Gaji Ditambahkan!'); }
    public function updateGaji(Request $request, $id) { Gaji::findOrFail($id)->update($request->all()); return back()->with('success', 'Data Gaji Diupdate!'); }
    public function destroyGaji($id) { Gaji::destroy($id); return back()->with('success', 'Data Gaji Dihapus!'); }

    // MAGANG
    public function magang() { return view('admin.magang', ['data' => Magang::oldest()->get()]); }
    public function storeMagang(Request $request) { Magang::create($request->all()); return back()->with('success', 'Data Magang Ditambahkan!'); }
    public function updateMagang(Request $request, $id) { Magang::findOrFail($id)->update($request->all()); return back()->with('success', 'Data Magang Diupdate!'); }
    public function destroyMagang($id) { Magang::destroy($id); return back()->with('success', 'Data Magang Dihapus!'); }

    // KEHADIRAN (Sakit / Cuti / Dinas Luar Kota)
    public function kehadiran() 
    { 
        return view('admin.kehadiran', [
            'data' => Kehadiran::latest()->get(),
            'pegawais' => Pegawai::orderBy('nama')->get()
        ]); 
    }
    public function storeKehadiran(Request $request) { Kehadiran::create($request->all()); return back()->with('success', 'Data Kehadiran Ditambahkan!'); }
    public function updateKehadiran(Request $request, $id) { Kehadiran::findOrFail($id)->update($request->all()); return back()->with('success', 'Data Kehadiran Diupdate!'); }
    public function destroyKehadiran($id) { Kehadiran::destroy($id); return back()->with('success', 'Data Kehadiran Dihapus!'); }

    // MUSIK BACKGROUND
    public function musik()
    {
        $data = Musik::latest()->get();
        $activeMusik = Musik::where('is_active', true)->first() ?: Musik::first();
        return view('admin.musik', compact('data', 'activeMusik'));
    }

    public function storeMusik(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg,m4a,mp4,audio/mpeg,audio/mp3|max:30720',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $file = $request->file('audio_file');
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $destinationPath = public_path('uploads/musik');
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $filename);
        $relativePath = 'uploads/musik/' . $filename;

        $setActive = $request->has('is_active') || Musik::count() === 0;
        if ($setActive) {
            Musik::query()->update(['is_active' => false]);
        }

        Musik::create([
            'judul' => $request->judul,
            'file_path' => $relativePath,
            'is_active' => $setActive,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Musik baru berhasil diupload dan ditambahkan!');
    }

    public function setActiveMusik($id)
    {
        Musik::query()->update(['is_active' => false]);
        $musik = Musik::findOrFail($id);
        $musik->update(['is_active' => true]);

        return back()->with('success', 'Musik "' . $musik->judul . '" dijadikan sebagai musik aktif!');
    }

    public function destroyMusik($id)
    {
        $musik = Musik::findOrFail($id);
        
        if ($musik->file_path && !in_array($musik->file_path, ['musik.mp3', '/musik.mp3'])) {
            $fullPath = public_path($musik->file_path);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }

        $wasActive = $musik->is_active;
        $musik->delete();

        if ($wasActive) {
            $next = Musik::first();
            if ($next) {
                $next->update(['is_active' => true]);
            }
        }

        return back()->with('success', 'Musik berhasil dihapus!');
    }

    // REKAPITULASI & PRINT
    public function rekapitulasi()
    {
        $countPangkat = Pangkat::count();
        $countGaji = Gaji::count();
        $countMagang = Magang::count();
        return view('admin.rekapitulasi', compact('countPangkat', 'countGaji', 'countMagang'));
    }

    public function printRekap($jenis)
    {
        if ($jenis == 'pangkat') {
            $data = Pangkat::oldest()->get();
            $title = 'Rekapitulasi Kenaikan Pangkat';
        } elseif ($jenis == 'gaji') {
            $data = Gaji::oldest()->get();
            $title = 'Rekapitulasi Kenaikan Gaji Berkala';
        } else {
            $data = Magang::oldest()->get();
            $title = 'Rekapitulasi Data Anak Magang';
        }
        return view('admin.print', compact('data', 'jenis', 'title'));
    }
}

