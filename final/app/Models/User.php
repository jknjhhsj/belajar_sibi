<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $fillable = ['name','kelas','email','password','role','status'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at'=>'datetime','password'=>'hashed'];
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isGuru(): bool { return $this->role === 'guru'; }
    public function isSiswa(): bool { return $this->role === 'siswa'; }
    public function hasilKuis() { return $this->hasMany(HasilKuisSibi::class); }
    public function modulProgress() { return $this->hasMany(ModulProgress::class); }
    public function activityLogs() { return $this->hasMany(ActivityLog::class); }
    public function totalSkor(): int {
        return $this->hasilKuis()->sum('skor') ?? 0;
    }
    public function progressPersen(): int {
        $total = $this->modulProgress()->sum('total_kartu');
        $seen  = $this->modulProgress()->sum('kartu_dilihat');
        return $total > 0 ? (int) round($seen / $total * 100) : 0;
    }
}
