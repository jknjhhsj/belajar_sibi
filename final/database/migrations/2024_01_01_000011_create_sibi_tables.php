<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel konten belajar SIBI (angka, keluarga, benda, sapaan)
        if (!Schema::hasTable('konten_sibis')) {
            Schema::create('konten_sibis', function (Blueprint $t) {
                $t->id();
                $t->string('kategori');           // angka | keluarga | benda | sapaan
                $t->string('judul');              // "0", "Ayah", "Pensil", dll
                $t->string('teks_sibi');          // "NOL", "AYAH", dll
                $t->string('teks_belinyu')->nullable(); // terjemahan Bahasa Belinyu
                $t->string('gif_url')->nullable(); // path ke file GIF
                $t->tinyInteger('urutan')->default(0);
                $t->timestamps();
            });
        }

        // Tabel soal kuis
        if (!Schema::hasTable('soal_kuis')) {
            Schema::create('soal_kuis', function (Blueprint $t) {
                $t->id();
                $t->tinyInteger('level')->unsigned()->default(1); // 1–5
                $t->string('kategori');           // angka | keluarga | benda | sapaan
                $t->string('gif_soal')->nullable(); // GIF pertanyaan
                $t->text('pertanyaan');
                $t->string('pilihan_a');
                $t->string('pilihan_b');
                $t->string('pilihan_c');
                $t->string('jawaban_benar');      // a | b | c
                $t->timestamps();
            });
        }

        // Tabel hasil kuis siswa
        if (!Schema::hasTable('hasil_kuis_sibis')) {
            Schema::create('hasil_kuis_sibis', function (Blueprint $t) {
                $t->id();
                $t->foreignId('user_id')->constrained()->cascadeOnDelete();
                $t->tinyInteger('level')->unsigned();
                $t->tinyInteger('skor')->unsigned()->default(0);
                $t->tinyInteger('benar')->unsigned()->default(0);
                $t->tinyInteger('total_soal')->unsigned()->default(0);
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis_sibis');
        Schema::dropIfExists('soal_kuis');
        Schema::dropIfExists('konten_sibis');
    }
};
