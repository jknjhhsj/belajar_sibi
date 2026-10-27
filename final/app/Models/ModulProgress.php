<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModulProgress extends Model {
    protected $table = 'modul_progress';
    protected $fillable = ['user_id','kategori','kartu_dilihat','total_kartu'];
    public function user() { return $this->belongsTo(User::class); }
}
