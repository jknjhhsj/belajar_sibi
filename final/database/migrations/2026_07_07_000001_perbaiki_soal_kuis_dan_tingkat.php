<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Perbaikan besar bank soal kuis:
     * - Level 1-5 disederhanakan jadi 3 tingkat: 1=Mudah, 2=Sedang, 3=Susah
     * - Semua path video soal diganti ke video ASLI yang sudah diupload
     *   (sebelumnya banyak yang menunjuk file dummy assets/gifs/kuis/qN.gif
     *   yang tidak pernah ada, makanya video tidak muncul di kuis siswa)
     * - Jawaban benar disesuaikan dengan kosakata asli di modul (konten_sibis)
     */
    public function up(): void
    {
        DB::table('soal_kuis')->truncate();

        $now = now();

        $soal = [
            // ===================== ANGKA =====================
            // Mudah
            ['angka', 1, 'assets/gifs/angka/satu-1781585830.mp4', 'Angka berapa ini?', '1','2','3','4','a'],
            ['angka', 1, 'assets/gifs/angka/dua-1781586969.mp4', 'Angka berapa ini?', '1','2','3','5','b'],
            ['angka', 1, 'assets/gifs/angka/tiga-1781587062.mp4', 'Angka berapa ini?', '2','3','4','5','b'],
            // Sedang
            ['angka', 2, 'assets/gifs/angka/enam-1781587137.mp4', 'Angka berapa ini?', '5','6','7','8','b'],
            ['angka', 2, 'assets/gifs/angka/sembilan-1781587364.mp4', 'Angka berapa ini?', '7','8','9','10','c'],
            ['angka', 2, 'assets/gifs/angka/dua-puluh-1783359848.mp4', 'Angka berapa ini?', '12','20','22','30','b'],
            // Susah
            ['angka', 3, 'assets/gifs/angka/lima-puluh-1783360000.mp4', 'Angka berapa ini?', '15','40','50','500','c'],
            ['angka', 3, 'assets/gifs/angka/seratus-1783360046.mp4', 'Angka berapa ini?', '10','100','1000','1000000','b'],
            ['angka', 3, 'assets/gifs/angka/satu-juta-1783360132.mp4', 'Angka berapa ini?', '100','1000','100000','1000000','d'],

            // ===================== KELUARGA =====================
            // Mudah
            ['keluarga', 1, 'assets/gifs/keluarga/ayah-1781457886.mp4', 'Siapa ini?', 'Ayah','Ibu','Kakak','Adik','a'],
            ['keluarga', 1, 'assets/gifs/keluarga/ibu-1781457922.mp4', 'Siapa ini?', 'Ayah','Ibu','Nenek','Bibik','b'],
            ['keluarga', 1, 'assets/gifs/keluarga/adik-1781458042.mp4', 'Siapa ini?', 'Kakak','Adik','Paman','Kakek','b'],
            // Sedang
            ['keluarga', 2, 'assets/gifs/keluarga/kakak-1781458006.mp4', 'Siapa ini?', 'Adik','Kakak','Kakek','Paman','b'],
            ['keluarga', 2, 'assets/gifs/keluarga/kakek-1781458121.mp4', 'Siapa ini?', 'Nenek','Kakek','Paman','Ayah','b'],
            ['keluarga', 2, 'assets/gifs/keluarga/nenek-1781458164.mp4', 'Siapa ini?', 'Nenek','Kakek','Bibik','Ibu','a'],
            // Susah
            ['keluarga', 3, 'assets/gifs/keluarga/paman-1781458318.mp4', 'Siapa ini?', 'Kakek','Paman','Bibik','Ayah','b'],
            ['keluarga', 3, 'assets/gifs/keluarga/bibik-1781458369.mp4', 'Siapa ini?', 'Nenek','Paman','Bibik','Kakak','c'],
            ['keluarga', 3, 'assets/gifs/keluarga/paman-1781458318.mp4', 'Paman adalah saudara laki-laki dari?', 'Ayah/Ibu','Anak','Kakak','Adik','a'],

            // ===================== BENDA =====================
            // Mudah
            ['benda', 1, 'assets/gifs/benda/buku-1783355585.mp4', 'Apa nama benda ini?', 'Buku','Tas','Pensil','Bolpoin','a'],
            ['benda', 1, 'assets/gifs/benda/pulpen-1783355673.mp4', 'Apa nama benda ini?', 'Pensil','Bolpoin','Penggaris','Pengapus','b'],
            ['benda', 1, 'assets/gifs/benda/tas-1783355882.mp4', 'Apa nama benda ini?', 'Tas','Buku','Meja','Kursi','a'],
            // Sedang
            ['benda', 2, 'assets/gifs/benda/meja-1783356372.mp4', 'Apa nama benda ini?', 'Kursi','Meja','Lemari','Papan Tulis','b'],
            ['benda', 2, 'assets/gifs/benda/penggaris-1783356571.mp4', 'Apa nama benda ini?', 'Pensil','Penggaris','Peruncing','Pengapus','b'],
            ['benda', 2, 'assets/gifs/benda/papan-tulis-1783356057.mp4', 'Apa nama benda ini?', 'Papan Tulis','Lemari','Meja','Kursi','a'],
            // Susah
            ['benda', 3, 'assets/gifs/benda/jam-dinding-1783356697.mp4', 'Apa nama benda ini?', 'Jam Dinding','Bendera','Sepeda','Kompor','a'],
            ['benda', 3, 'assets/gifs/benda/sepeda-1783358941.mp4', 'Apa nama benda ini?', 'Sepeda','Sendok','Piring','Gelas','a'],
            ['benda', 3, 'assets/gifs/benda/kompor-1783359087.mp4', 'Apa nama benda ini?', 'Wajan','Kompor','Teko','Piring','b'],

            // ===================== SAPAAN =====================
            // Mudah
            ['sapaan', 1, 'assets/gifs/sapaan/apa-1781582085.mp4', 'Kata sapaan apa ini?', 'Apa','Siapa','Kapan','Dimana','a'],
            ['sapaan', 1, 'assets/gifs/sapaan/siapa-1781582208.mp4', 'Kata sapaan apa ini?', 'Apa','Siapa','Kita','Mereka','b'],
            ['sapaan', 1, 'assets/gifs/sapaan/aku-1781582809.mp4', 'Kata sapaan apa ini?', 'Aku','Kamu','Kita','Mereka','a'],
            // Sedang
            ['sapaan', 2, 'assets/gifs/sapaan/dimana-1781582585.mp4', 'Kata sapaan apa ini?', 'Kapan','Dimana','Bagaimana','Mengapa','b'],
            ['sapaan', 2, 'assets/gifs/sapaan/kapan-1781582516.mp4', 'Kata sapaan apa ini?', 'Dimana','Kapan','Kita','Mereka','b'],
            ['sapaan', 2, 'assets/gifs/sapaan/kita-1781583068.mp4', 'Kata sapaan apa ini?', 'Aku','Kamu','Kita','Mereka','c'],
            // Susah
            ['sapaan', 3, 'assets/gifs/sapaan/bagaimana-1781582651.mp4', 'Kata sapaan apa ini?', 'Bagaimana','Mengapa','Kapan','Dimana','a'],
            ['sapaan', 3, 'assets/gifs/sapaan/mengapa-1781582723.mp4', 'Kata sapaan apa ini?', 'Bagaimana','Mengapa','Kita','Mereka','b'],
            ['sapaan', 3, 'assets/gifs/sapaan/selamat-sore-1783359511.mp4', 'Ucapan apa ini?', 'Selamat Pagi','Selamat Siang','Selamat Sore','Selamat Malam','c'],
        ];

        foreach ($soal as $s) {
            DB::table('soal_kuis')->insert([
                'kategori'      => $s[0],
                'level'         => $s[1],
                'gif_soal'      => $s[2],
                'pertanyaan'    => $s[3],
                'pilihan_a'     => $s[4],
                'pilihan_b'     => $s[5],
                'pilihan_c'     => $s[6],
                'pilihan_d'     => $s[7],
                'jawaban_benar' => $s[8],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);
        }
    }

    public function down(): void
    {
        // Data lama sudah tidak valid (path video rusak), tidak perlu dikembalikan.
    }
};