<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{HasilKuisSibi, KontenSibi, SoalKuis, User, ActivityLog, ModulProgress};
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_siswa'       => User::where('role','siswa')->count(),
            'siswa_aktif'       => User::where('role','siswa')->where('status','aktif')->count(),
            'total_konten'      => KontenSibi::count(),
            'total_soal'        => SoalKuis::count(),
            'total_kuis'        => HasilKuisSibi::count(),
            'belajar_hari_ini'  => ActivityLog::whereDate('created_at',today())->distinct('user_id')->count(),
        ];

        $recentHasil = HasilKuisSibi::with('user')->latest()->take(8)->get();
        $recentSiswa = User::where('role','siswa')->latest()->take(5)->get();
        $topSiswa    = User::where('role','siswa')
            ->withSum('hasilKuis as total_skor','skor')
            ->orderByDesc('total_skor')->take(5)->get();

        // Aktivitas harian 7 hari terakhir (bar chart)
        $aktivitasHarian = ActivityLog::selectRaw('DATE(created_at) as tgl, COUNT(*) as jml')
            ->where('created_at','>=',now()->subDays(7))
            ->groupBy('tgl')->orderBy('tgl')->get();

        // Skor rata-rata kuis per level (line chart)
        $skorPerLevel = HasilKuisSibi::selectRaw('level, ROUND(AVG(skor),1) as avg_skor, COUNT(*) as jml')
            ->groupBy('level')->orderBy('level')->get();

        // Distribusi kelas siswa (donut chart)
        $kelasDist = User::where('role','siswa')
            ->select('kelas', DB::raw('count(*) as jml'))
            ->groupBy('kelas')->orderBy('kelas')->get();

        // Kosakata per kategori (bar chart kecil)
        $kosakata = [
            'Angka'    => KontenSibi::where('kategori','angka')->count(),
            'Keluarga' => KontenSibi::where('kategori','keluarga')->count(),
            'Benda'    => KontenSibi::where('kategori','benda')->count(),
            'Sapaan'   => KontenSibi::where('kategori','sapaan')->count(),
        ];

        return view('admin.dashboard', compact(
            'stats','recentHasil','recentSiswa','topSiswa',
            'aktivitasHarian','skorPerLevel','kelasDist','kosakata'
        ));
    }
}
