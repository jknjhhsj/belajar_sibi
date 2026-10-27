<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KontenSibi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    // Prefix ini dioverride oleh Admin\KontenController supaya bisa pakai view & route admin.*
    protected string $viewPrefix  = 'guru.konten.';
    protected string $routePrefix = 'guru.konten.';

    public function index()
    {
        $konten = KontenSibi::when(request('kategori'), fn($q, $k) => $q->where('kategori', $k))
                            ->orderBy('kategori')->orderBy('urutan')->paginate(20);
        return view($this->viewPrefix.'index', compact('konten'));
    }

    public function create()
    {
        return view($this->viewPrefix.'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori'     => 'required|in:angka,keluarga,benda,sapaan',
            'judul'        => 'required|string|max:100',
            'teks_sibi'    => 'required|string|max:100',
            'teks_belinyu' => 'required|string|max:100',
            'media_file'   => 'required|file|mimes:gif,mp4,webm,mov|max:20480',
            'urutan'       => 'nullable|integer|min:0',
        ], [
            'media_file.required' => 'Video/GIF wajib diupload untuk konten baru.',
        ]);

        $gif_url = null;

        if ($request->hasFile('media_file')) {
            $file     = $request->file('media_file');
            $kategori = $request->input('kategori');
            $ext      = strtolower($file->getClientOriginalExtension());
            $filename = \Str::slug($request->input('judul')) . '-' . time() . '.' . $ext;
            $file->move(public_path("assets/gifs/{$kategori}"), $filename);
            $gif_url = "assets/gifs/{$kategori}/{$filename}";
        }

        KontenSibi::create([
            'kategori'     => $request->kategori,
            'judul'        => $request->judul,
            'teks_sibi'    => $request->teks_sibi,
            'teks_belinyu' => $request->teks_belinyu,
            'gif_url'      => $gif_url,
            'urutan'       => $request->urutan ?? 0,
        ]);

        return redirect()->route($this->routePrefix.'index')
                         ->with('success', 'Konten berhasil ditambahkan!');
    }

    public function edit(KontenSibi $konten)
    {
        return view($this->viewPrefix.'edit', compact('konten'));
    }

    public function update(Request $request, KontenSibi $konten)
    {
        $request->validate([
            'kategori'     => 'required|in:angka,keluarga,benda,sapaan',
            'judul'        => 'required|string|max:100',
            'teks_sibi'    => 'required|string|max:100',
            'teks_belinyu' => 'nullable|string|max:100',
            'media_file'   => 'nullable|file|mimes:gif,mp4,webm,mov|max:20480',
            'urutan'       => 'nullable|integer|min:0',
        ]);

        $gif_url = $konten->gif_url; // tetap pakai yang lama kalau tidak upload baru

        if ($request->hasFile('media_file')) {
            // hapus file lama kalau ada
            if ($konten->gif_url && file_exists(public_path($konten->gif_url))) {
                @unlink(public_path($konten->gif_url));
            }
            $file     = $request->file('media_file');
            $kategori = $request->input('kategori');
            $ext      = strtolower($file->getClientOriginalExtension());
            $filename = \Str::slug($request->input('judul')) . '-' . time() . '.' . $ext;
            $file->move(public_path("assets/gifs/{$kategori}"), $filename);
            $gif_url  = "assets/gifs/{$kategori}/{$filename}";
        }

        $konten->update([
            'kategori'     => $request->kategori,
            'judul'        => $request->judul,
            'teks_sibi'    => $request->teks_sibi,
            'teks_belinyu' => $request->teks_belinyu,
            'gif_url'      => $gif_url,
            'urutan'       => $request->urutan ?? 0,
        ]);

        return redirect()->route($this->routePrefix.'index')
                         ->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy(KontenSibi $konten)
    {
        // hapus file media juga kalau ada
        if ($konten->gif_url && file_exists(public_path($konten->gif_url))) {
            @unlink(public_path($konten->gif_url));
        }
        $konten->delete();
        return redirect()->route($this->routePrefix.'index')
                         ->with('success', 'Konten berhasil dihapus!');
    }

    /**
     * Scan folder public/assets/gifs/{kategori}/ dan otomatis buat
     * konten_sibis untuk setiap file video/gif yang belum punya data,
     * tanpa harus diinput satu-satu lewat form.
     */
    public function sync()
    {
        $base = public_path('assets/gifs');

        if (!is_dir($base)) {
            return redirect()->route($this->routePrefix.'index')
                             ->with('success', 'Folder assets/gifs tidak ditemukan.');
        }

        $extAllowed = ['gif', 'mp4', 'webm', 'mov'];
        $added      = 0;
        $skipped    = 0;

        $kategoriFolders = array_filter(scandir($base), function ($f) use ($base) {
            return $f !== '.' && $f !== '..' && is_dir($base . '/' . $f);
        });

        foreach ($kategoriFolders as $kategori) {
            $dir = $base . '/' . $kategori;

            $files = array_filter(scandir($dir), function ($f) use ($dir, $extAllowed) {
                if ($f === '.' || $f === '..') return false;
                if (!is_file($dir . '/' . $f)) return false;
                return in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), $extAllowed);
            });
            sort($files);

            $urutan = (int) (KontenSibi::where('kategori', $kategori)->max('urutan') ?? 0);

            foreach ($files as $file) {
                $relPath = "assets/gifs/{$kategori}/{$file}";

                if (KontenSibi::where('gif_url', $relPath)->exists()) {
                    $skipped++;
                    continue;
                }

                $name = pathinfo($file, PATHINFO_FILENAME);
                $kata = preg_replace('/-\d{6,}$/', '', $name);
                $kata = str_replace(['-', '_'], ' ', $kata);

                $urutan++;

                KontenSibi::create([
                    'kategori'     => $kategori,
                    'judul'        => mb_strtoupper($kata),
                    'teks_sibi'    => mb_strtolower($kata),
                    'teks_belinyu' => null,
                    'gif_url'      => $relPath,
                    'urutan'       => $urutan,
                ]);
                $added++;
            }
        }

        $msg = $added > 0
            ? "Sync selesai! {$added} konten baru otomatis ditambahkan dari folder."
            : 'Sync selesai, tidak ada video baru yang ditemukan.';
        if ($skipped > 0) {
            $msg .= " ({$skipped} file sudah punya data sebelumnya, dilewati.)";
        }

        return redirect()->route($this->routePrefix.'index')->with('success', $msg);
    }
}
