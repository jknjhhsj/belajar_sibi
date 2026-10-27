<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalKuis extends Model
{
    protected $fillable = [
        'level', 'kategori', 'gif_soal', 'pertanyaan',
        'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar',
    ];

    public function scopeLevel($query, int $level)
    {
        return $query->where('level', $level);
    }
}
