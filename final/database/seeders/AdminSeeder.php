<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus admin lama jika ada
        DB::table('users')->whereIn('email', ['admin@sibi.id', 'admin@SLB.id'])->delete();

        DB::table('users')->insert([
            'name'       => 'Admin SLB',
            'email'      => 'admin@SLB.id',
            'password'   => Hash::make('SLB12345'),
            'role'       => 'admin',
            'status'     => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✅ Admin berhasil dibuat!');
        $this->command->info('   Email    : admin@SLB.id');
        $this->command->info('   Password : SLB12345');
    }
}
