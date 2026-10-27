<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $t) {
                $t->id();
                $t->foreignId('user_id')->constrained()->cascadeOnDelete();
                $t->string('tipe')->default('umum');
                $t->text('deskripsi')->nullable();
                $t->timestamps();
            });
        }
    }
    public function down(): void { Schema::dropIfExists('activity_logs'); }
};
