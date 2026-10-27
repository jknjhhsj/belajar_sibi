<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\SoalKuis;
use App\Models\KontenSibi;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    // Prefix ini dioverride oleh Admin\KuisController supaya bisa pakai view & route admin.*
    protected string $viewPrefix  = 'guru.kuis.';
    protected string $routePrefix = 'guru.kuis.';

    public function index(Request $request)
    {
        $tingkatMap = ['mudah' => 1, 'sedang' => 2, 'susah' => 3];

        $soal = SoalKuis::query()
            ->when($request->kategori, fn($q, $k) => $q->where('kategori', $k))
            ->when($request->tingkat && isset($tingkatMap[$request->tingkat]),
                fn($q) => $q->where('level', $tingkatMap[$request->tingkat]))
            ->orderBy('level')->orderBy('kategori')->orderBy('id')
            ->paginate(20)
            ->withQueryString();

        return view($this->viewPrefix.'index', compact('soal'));
    }

    public function create()
    {
        $soal = null;
        $kontenPerKategori = $this->kontenPerKategori();
        return view($this->viewPrefix.'create', compact('soal', 'kontenPerKategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori'      => 'required|in:angka,keluarga,benda,sapaan',
            'level'         => 'required|integer|min:1|max:3',
            'gif_soal'      => 'required|string|max:255',
            'pertanyaan'    => 'required|string|max:500',
            'pilihan_a'     => 'required|string|max:200',
            'pilihan_b'     => 'required|string|max:200',
            'pilihan_c'     => 'required|string|max:200',
            'pilihan_d'     => 'required|string|max:200',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ], [
            'gif_soal.required' => 'Video/GIF soal wajib dipilih supaya jelas untuk siswa tunarungu.',
        ]);

        SoalKuis::create($data);

        return redirect()->route($this->routePrefix.'index')
            ->with('success', 'Soal kuis berhasil ditambahkan!');
    }

    public function edit(SoalKuis $kui)
    {
        $soal = $kui;
        $kontenPerKategori = $this->kontenPerKategori();
        return view($this->viewPrefix.'edit', compact('soal', 'kontenPerKategori'));
    }

    public function update(Request $request, SoalKuis $kui)
    {
        $data = $request->validate([
            'kategori'      => 'required|in:angka,keluarga,benda,sapaan',
            'level'         => 'required|integer|min:1|max:3',
            'gif_soal'      => 'required|string|max:255',
            'pertanyaan'    => 'required|string|max:500',
            'pilihan_a'     => 'required|string|max:200',
            'pilihan_b'     => 'required|string|max:200',
            'pilihan_c'     => 'nullable|string|max:200',
            'pilihan_d'     => 'nullable|string|max:200',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ], [
            'gif_soal.required' => 'Video/GIF soal wajib dipilih supaya jelas untuk siswa tunarungu.',
        ]);

        $kui->update($data);

        return redirect()->route($this->routePrefix.'index')
            ->with('success', 'Soal kuis berhasil diperbarui!');
    }

    public function destroy(SoalKuis $kui)
    {
        $kui->delete();
        return redirect()->route($this->routePrefix.'index')
            ->with('success', 'Soal kuis berhasil dihapus!');
    }

    private function kontenPerKategori(): array
    {
        return KontenSibi::orderBy('urutan')
            ->get(['kategori', 'judul', 'teks_sibi', 'gif_url'])
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->map(fn($i) => [
                    'judul'    => $i->judul,
                    'teks'     => $i->teks_sibi,
                    'gif_url'  => $i->gif_url,
                ])->values();
            })->toArray();
    }
}
