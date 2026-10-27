<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('modul_progress')) {
            Schema::create('modul_progress', function (Blueprint $t) {
                $t->id();
                $t->foreignId('user_id')->constrained()->cascadeOnDelete();
                $t->string('kategori');
                $t->integer('kartu_dilihat')->default(0);
                $t->integer('total_kartu')->default(0);
                $t->timestamps();
                $t->unique(['user_id','kategori']);
            });
        }
    }
    public function down(): void { Schema::dropIfExists('modul_progress'); }
};
