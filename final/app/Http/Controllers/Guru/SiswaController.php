<?php
namespace App\Http\Controllers\Guru;
use App\Http\Controllers\Controller;
use App\Models\{User, HasilKuisSibi, ModulProgress, ActivityLog, KontenSibi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Guru memantau perkembangan siswa DAN mengelola akun siswa
// (mengaktifkan/menonaktifkan status, serta menghapus akun siswa).
class SiswaController extends Controller {
    protected string $viewPrefix = 'guru.siswa.';

    public function index() {
        $siswa = User::where('role','siswa')
            ->withSum('hasilKuis as total_skor','skor')
            ->withCount('hasilKuis as total_kuis')
            ->latest()->paginate(15);

        foreach ($siswa as $s) {
            if (is_null($s->total_skor)) {
                $s->total_skor = HasilKuisSibi::where('user_id', $s->id)->sum('skor');
            }
            if (is_null($s->total_kuis)) {
                $s->total_kuis = HasilKuisSibi::where('user_id', $s->id)->count();
            }
        }

        $kosakata = [
            'angka'    => KontenSibi::where('kategori','angka')->count(),
            'keluarga' => KontenSibi::where('kategori','keluarga')->count(),
            'benda'    => KontenSibi::where('kategori','benda')->count(),
            'sapaan'   => KontenSibi::where('kategori','sapaan')->count(),
        ];
        $totalKosakata = array_sum($kosakata);

        $kelasDist = User::where('role','siswa')
            ->select('kelas', DB::raw('count(*) as jml'))
            ->groupBy('kelas')
            ->orderBy('kelas')
            ->get();

        return view($this->viewPrefix.'index', compact('siswa','kosakata','totalKosakata','kelasDist'));
    }

    public function show(User $user) {
        if ($user->role !== 'siswa') abort(403);

        $hasilKuis     = HasilKuisSibi::where('user_id',$user->id)->orderBy('level')->get();
        $modulProgress = ModulProgress::where('user_id',$user->id)->get()->keyBy('kategori');
        $activityLogs  = ActivityLog::where('user_id',$user->id)->latest()->take(20)->get();
        $totalSkor     = $hasilKuis->sum('skor');
        $levelTercapai = $hasilKuis->max('level') ?? 0;

        $bulanLabels = [];
        $skorBulanan = [];
        $kuisBulanan = [];
        $aktivitasBulanan = [];

        for ($i = 11; $i >= 0; $i--) {
            $tgl = now()->subMonths($i);
            $bulanLabels[] = $tgl->format('M Y');
            $skorBulanan[] = (int) round(HasilKuisSibi::where('user_id', $user->id)
                ->whereYear('created_at', $tgl->year)
                ->whereMonth('created_at', $tgl->month)
                ->avg('skor') ?? 0);
            $kuisBulanan[] = HasilKuisSibi::where('user_id', $user->id)
                ->whereYear('created_at', $tgl->year)
                ->whereMonth('created_at', $tgl->month)
                ->count();
            $aktivitasBulanan[] = ActivityLog::where('user_id', $user->id)
                ->whereYear('created_at', $tgl->year)
                ->whereMonth('created_at', $tgl->month)
                ->count();
        }

        $kategoriProgress = [];
        foreach (['angka','keluarga','benda','sapaan'] as $kat) {
            $mp = $modulProgress->get($kat);
            $total = KontenSibi::where('kategori', $kat)->count();
            $kategoriProgress[$kat] = [
                'seen'  => $mp?->kartu_dilihat ?? 0,
                'total' => $total,
                'pct'   => ($mp && $total > 0) ? round($mp->kartu_dilihat / $total * 100) : 0,
            ];
        }

        return view($this->viewPrefix.'show', compact(
            'user','hasilKuis','modulProgress','activityLogs',
            'totalSkor','levelTercapai',
            'bulanLabels','skorBulanan','kuisBulanan','aktivitasBulanan',
            'kategoriProgress'
        ));
    }

    public function destroy(User $user) {
        if ($user->role !== 'siswa') abort(403);
        $user->delete();
        return back()->with('success','Siswa berhasil dihapus!');
    }

    public function toggleStatus(User $user) {
        if ($user->role !== 'siswa') abort(403);
        $user->status = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->save();
        return back()->with('success','Status siswa diperbarui!');
    }
}
