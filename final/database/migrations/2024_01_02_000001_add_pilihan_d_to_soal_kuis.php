<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {
            $table->string('pilihan_d')->nullable()->after('pilihan_c');
        });
    }

    public function down(): void
    {
        Schema::table('soal_kuis', function (Blueprint $table) {
            $table->dropColumn('pilihan_d');
        });
    }
};
