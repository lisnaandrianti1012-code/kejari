<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Musik;

class MusikSeeder extends Seeder
{
    public function run(): void
    {
        if (Musik::count() === 0) {
            Musik::create([
                'judul' => 'Musik Instrumental Kejari (Default)',
                'file_path' => 'musik.mp3',
                'is_active' => true,
                'keterangan' => 'Musik latar bawaan sistem'
            ]);
        }
    }
}
