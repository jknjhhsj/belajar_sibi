<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\KontenSibi;
use App\Models\ModulProgress;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulController extends Controller {
    private array $modulConfig = [
        'angka'    => ['title'=>'Modul Angka',      'emoji'=>'🔢','c1'=>'#0D2B6E','c2'=>'#1A4F8B'],
        'keluarga' => ['title'=>'Keluarga',         'emoji'=>'🫂','c1'=>'#1B4332','c2'=>'#2D6A4F'],
        'benda'    => ['title'=>'Benda Sehari-hari','emoji'=>'📚','c1'=>'#3B1F6B','c2'=>'#6D3FC0'],
        'sapaan'   => ['title'=>'Kata Sapaan',      'emoji'=>'👋','c1'=>'#0D2651','c2'=>'#2563B0'],
    ];

    public function show(string $kategori) {
        if (!array_key_exists($kategori, $this->modulConfig)) abort(404);
        $konten = KontenSibi::where('kategori', $kategori)->orderBy('urutan')->get();
        $config = $this->modulConfig[$kategori];

        if (Auth::check()) {
            $user = Auth::user();
            $existing = ModulProgress::where('user_id', $user->id)
                ->where('kategori', $kategori)->first();

            // Saat pertama kali buka, kata pertama otomatis terhitung "dilihat" (1),
            // tapi TIDAK langsung dianggap selesai semua. Progress akan naik
            // bertahap lewat endpoint /modul/{kategori}/progress saat siswa
            // menggeser ke kata berikutnya.
            ModulProgress::updateOrCreate(
                ['user_id'=>$user->id, 'kategori'=>$kategori],
                [
                    'total_kartu'   => $konten->count(),
                    'kartu_dilihat' => max($existing?->kartu_dilihat ?? 0, $konten->count() > 0 ? 1 : 0),
                ]
            );
            ActivityLog::create(['user_id'=>$user->id,'tipe'=>'modul','deskripsi'=>'Membuka modul '.$config['title']]);
        }
        return view('frontend.modul', compact('konten','config','kategori'));
    }

    public function updateProgress(Request $request, string $kategori) {
        if (!array_key_exists($kategori, $this->modulConfig)) abort(404);
        if (!Auth::check()) return response()->json(['ok' => false], 401);

        $data = $request->validate([
            'index' => 'required|integer|min:0',
        ]);

        $user  = Auth::user();
        $total = KontenSibi::where('kategori', $kategori)->count();
        $seenNow = min($data['index'] + 1, $total); // index 0-based -> "sudah lihat ke-berapa"

        $progress = ModulProgress::firstOrNew(['user_id'=>$user->id, 'kategori'=>$kategori]);
        $progress->total_kartu   = $total;
        $progress->kartu_dilihat = max($progress->kartu_dilihat ?? 0, $seenNow);
        $progress->save();

        return response()->json([
            'ok'     => true,
            'seen'   => $progress->kartu_dilihat,
            'total'  => $total,
            'persen' => $total > 0 ? round($progress->kartu_dilihat / $total * 100) : 0,
        ]);
    }
}