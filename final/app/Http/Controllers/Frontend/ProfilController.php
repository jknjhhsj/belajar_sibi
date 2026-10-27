<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\HasilKuisSibi;
use App\Models\ModulProgress;
use App\Models\KontenSibi;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller {
    public function index() {
        $user = Auth::user();

        // Hasil kuis per level, diurutkan
        $hasilKuis = HasilKuisSibi::where('user_id', $user->id)
            ->orderBy('created_at')->get();

        // Progress modul per kategori
        $modulProgress = ModulProgress::where('user_id', $user->id)
            ->get()->keyBy('kategori');

        $kategoriList = ['angka','keluarga','benda','sapaan'];
        $progress = [];
        foreach ($kategoriList as $kat) {
            $total = KontenSibi::where('kategori', $kat)->count();
            $seen  = $modulProgress->get($kat)?->kartu_dilihat ?? 0;
            $progress[$kat] = [
                'persen' => $total > 0 ? round($seen / $total * 100) : 0,
                'seen'   => $seen,
                'total'  => $total,
            ];
        }

        // Data chart: skor kuis dari waktu ke waktu
        $chartLabels = $hasilKuis->map(fn($h) =>
            \Carbon\Carbon::parse($h->created_at)->format('d M').' (Lv '.$h->level.')'
        );
        $chartData = $hasilKuis->pluck('skor');

        // Aktivitas terakhir
        $activityLogs = ActivityLog::where('user_id', $user->id)
            ->latest()->take(10)->get();

        // Stats ringkas
        $totalKuis     = $hasilKuis->count();
        $skorTertinggi = $hasilKuis->max('skor') ?? 0;
        $skorRata      = $totalKuis > 0 ? round($hasilKuis->avg('skor')) : 0;
        $totalProgress = collect($progress)->avg('persen');

        return view('frontend.profil', compact(
            'user','progress','chartLabels','chartData',
            'totalKuis','skorTertinggi','skorRata','totalProgress',
            'activityLogs'
        ));
    }
}
