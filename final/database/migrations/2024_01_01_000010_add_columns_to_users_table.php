<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $t) {
            if (!Schema::hasColumn('users', 'role')) {
                $t->string('role')->default('siswa')->after('password');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $t->string('status')->default('aktif')->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $t) {
            $t->dropColumn(['role', 'status']);
        });
    }
};
