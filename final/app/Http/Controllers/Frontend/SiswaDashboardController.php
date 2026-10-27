<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\HasilKuisSibi;
use App\Models\ModulProgress;
use App\Models\KontenSibi;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller {
    public function index() {
        $user = Auth::user();
        $hasilKuis   = HasilKuisSibi::where('user_id', $user->id)->orderBy('level')->get();
        $recentKuis  = HasilKuisSibi::where('user_id', $user->id)->latest()->take(5)->get();
        $modulProgress = ModulProgress::where('user_id', $user->id)->get()->keyBy('kategori');

        // Stats untuk welcome banner
        $kuisSelesai  = $hasilKuis->count();
        $skorRata     = $kuisSelesai > 0 ? round($hasilKuis->avg('skor')) : 0;
        $modulSelesai = $modulProgress->filter(fn($m) => $m->kartu_dilihat >= $m->total_kartu && $m->total_kartu > 0)->count();

        // Progress per kategori (persen)
        $progress = [];
        foreach (['angka','keluarga','benda','sapaan'] as $kat) {
            $total = KontenSibi::where('kategori', $kat)->count();
            $seen  = $modulProgress->get($kat)?->kartu_dilihat ?? 0;
            $progress[$kat] = $total > 0 ? round($seen / $total * 100) : 0;
        }

        return view('frontend.siswa.dashboard', compact(
            'user','recentKuis','progress','kuisSelesai','skorRata','modulSelesai'
        ));
    }
}
