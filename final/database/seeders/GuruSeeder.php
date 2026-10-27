<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus guru default lama jika ada
        DB::table('users')->where('email', 'guru@SLB.id')->delete();

        DB::table('users')->insert([
            'name'       => 'Guru SLB',
            'email'      => 'guru@SLB.id',
            'password'   => Hash::make('SLB12345'),
            'role'       => 'guru',
            'status'     => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✅ Guru berhasil dibuat!');
        $this->command->info('   Email    : guru@SLB.id');
        $this->command->info('   Password : SLB12345');
    }
}
