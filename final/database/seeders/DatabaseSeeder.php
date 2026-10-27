<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Data konten SIBI (angka/keluarga/benda/sapaan) dan bank soal kuis
     * TIDAK lagi diisi lewat seeder ini — keduanya sudah dibuat lewat migration:
     *   - 2026_07_21_000001_seed_konten_sibi_dari_assets.php  (konten_sibis)
     *   - 2026_07_07_000001_perbaiki_soal_kuis_dan_tingkat.php (soal_kuis)
     * Migration menjamin path video yang dipakai konten & soal sama-sama
     * cocok dengan file asli di public/assets/gifs/, dan kuis dibatasi
     * 3 tingkat (1=Mudah, 2=Sedang, 3=Susah) sesuai validasi di
     * app/Http/Controllers/Guru/KuisController.php.
     *
     * Seeder ini sekarang hanya membuat akun admin & guru.
     */
    public function run(): void
    {
        $this->call([AdminSeeder::class, GuruSeeder::class]);
    }
}
