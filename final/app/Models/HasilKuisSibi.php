<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKuisSibi extends Model
{
    protected $fillable = [
        'user_id', 'level', 'skor', 'benar', 'total_soal',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
