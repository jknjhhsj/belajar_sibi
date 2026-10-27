<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenSibi extends Model
{
    protected $fillable = [
        'kategori', 'judul', 'teks_sibi', 'teks_belinyu', 'gif_url', 'urutan',
    ];

    public function scopeKategori($query, string $kat)
    {
        return $query->where('kategori', $kat)->orderBy('urutan');
    }
}
