<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Isi tabel konten_sibis dari video mp4 yang sudah ada di public/assets/gifs/.
     * Sebelumnya tabel ini kosong (siswa buka modul Angka/Keluarga/Benda/Sapaan
     * tapi tidak ada video sama sekali). Data di bawah dicocokkan otomatis dengan
     * nama file yang benar-benar ada di folder, jadi tidak ada path yang salah.
     */
    public function up(): void
    {
        // Kalau sudah pernah keisi (misal re-run manual), jangan dobel.
        if (DB::table('konten_sibis')->count() > 0) {
            return;
        }

        $now = now();

        // [kategori, judul, teks_sibi, gif_url, urutan]
        $konten = [
            ['angka', '1', 'SATU', 'assets/gifs/angka/satu-1781585830.mp4', 1],
            ['angka', '2', 'DUA', 'assets/gifs/angka/dua-1781586969.mp4', 2],
            ['angka', '3', 'TIGA', 'assets/gifs/angka/tiga-1781587062.mp4', 3],
            ['angka', '4', 'EMPAT', 'assets/gifs/angka/empat-1781587086.mp4', 4],
            ['angka', '5', 'LIMA', 'assets/gifs/angka/lima-1781587113.mp4', 5],
            ['angka', '6', 'ENAM', 'assets/gifs/angka/enam-1781587137.mp4', 6],
            ['angka', '7', 'TUJUH', 'assets/gifs/angka/tujuh-1781587167.mp4', 7],
            ['angka', '8', 'DELAPAN', 'assets/gifs/angka/delapan-1781587192.mp4', 8],
            ['angka', '9', 'SEMBILAN', 'assets/gifs/angka/sembilan-1781587364.mp4', 9],
            ['angka', '10', 'SEPULUH', 'assets/gifs/angka/sepuluh-1781587608.mp4', 10],
            ['angka', '20', 'DUA PULUH', 'assets/gifs/angka/dua-puluh-1783359848.mp4', 11],
            ['angka', '30', 'TIGA PULUH', 'assets/gifs/angka/tiga-puluh-1783359903.mp4', 12],
            ['angka', '40', 'EMPAT PULUH', 'assets/gifs/angka/empat-puluh-1783359955.mp4', 13],
            ['angka', '50', 'LIMA PULUH', 'assets/gifs/angka/lima-puluh-1783360000.mp4', 14],
            ['angka', '75', 'TUJUH PULUH LIMA', 'assets/gifs/angka/tujuh-puluh-lima-1783410740.mp4', 15],
            ['angka', '100', 'SERATUS', 'assets/gifs/angka/seratus-1783360046.mp4', 16],
            ['angka', '1.000', 'SERIBU', 'assets/gifs/angka/seribu-1783360084.mp4', 17],
            ['angka', '1.000.000', 'SATU JUTA', 'assets/gifs/angka/satu-juta-1783360132.mp4', 18],
            ['keluarga', 'Ayah', 'AYAH', 'assets/gifs/keluarga/ayah-1781457886.mp4', 1],
            ['keluarga', 'Ibu', 'IBU', 'assets/gifs/keluarga/ibu-1781457922.mp4', 2],
            ['keluarga', 'Kakak', 'KAKAK', 'assets/gifs/keluarga/kakak-1781458006.mp4', 3],
            ['keluarga', 'Adik', 'ADIK', 'assets/gifs/keluarga/adik-1781458042.mp4', 4],
            ['keluarga', 'Kakek', 'KAKEK', 'assets/gifs/keluarga/kakek-1781458121.mp4', 5],
            ['keluarga', 'Nenek', 'NENEK', 'assets/gifs/keluarga/nenek-1781458164.mp4', 6],
            ['keluarga', 'Paman', 'PAMAN', 'assets/gifs/keluarga/paman-1781458318.mp4', 7],
            ['keluarga', 'Bibik', 'BIBIK', 'assets/gifs/keluarga/bibik-1781458369.mp4', 8],
            ['benda', 'Buku', 'BUKU', 'assets/gifs/benda/buku-1783355585.mp4', 1],
            ['benda', 'Pulpen', 'PULPEN', 'assets/gifs/benda/pulpen-1783355673.mp4', 2],
            ['benda', 'Pensil', 'PENSIL', 'assets/gifs/benda/pensil-1783355767.mp4', 3],
            ['benda', 'Penggaris', 'PENGGARIS', 'assets/gifs/benda/penggaris-1783356571.mp4', 4],
            ['benda', 'Penghapus', 'PENGHAPUS', 'assets/gifs/benda/pengapus-1783356242.mp4', 5],
            ['benda', 'Peruncing', 'PERUNCING', 'assets/gifs/benda/peruncing-1783356455.mp4', 6],
            ['benda', 'Tas', 'TAS', 'assets/gifs/benda/tas-1783355882.mp4', 7],
            ['benda', 'Papan Tulis', 'PAPAN TULIS', 'assets/gifs/benda/papan-tulis-1783356057.mp4', 8],
            ['benda', 'Meja', 'MEJA', 'assets/gifs/benda/meja-1783356372.mp4', 9],
            ['benda', 'Kursi', 'KURSI', 'assets/gifs/benda/kursi-1783356410.mp4', 10],
            ['benda', 'Lemari', 'LEMARI', 'assets/gifs/benda/lemari-1783356643.mp4', 11],
            ['benda', 'Jam Dinding', 'JAM DINDING', 'assets/gifs/benda/jam-dinding-1783356697.mp4', 12],
            ['benda', 'Bendera', 'BENDERA', 'assets/gifs/benda/bendera-1783356193.mp4', 13],
            ['benda', 'Sepeda', 'SEPEDA', 'assets/gifs/benda/sepeda-1783358941.mp4', 14],
            ['benda', 'Kompor', 'KOMPOR', 'assets/gifs/benda/kompor-1783359087.mp4', 15],
            ['benda', 'Wajan', 'WAJAN', 'assets/gifs/benda/wajan-1783359235.mp4', 16],
            ['benda', 'Teko', 'TEKO', 'assets/gifs/benda/teko-1783359119.mp4', 17],
            ['benda', 'Piring', 'PIRING', 'assets/gifs/benda/piring-1783359011.mp4', 18],
            ['benda', 'Gelas', 'GELAS', 'assets/gifs/benda/gelas-1783359541.mp4', 19],
            ['benda', 'Sendok', 'SENDOK', 'assets/gifs/benda/sendok-1783359275.mp4', 20],
            ['benda', 'Wadah', 'WADAH', 'assets/gifs/benda/wadah-1783359372.mp4', 21],
            ['benda', 'Vas Bunga', 'VAS BUNGA', 'assets/gifs/benda/vas-bunga-1783359189.mp4', 22],
            ['benda', 'Penyapu', 'PENYAPU', 'assets/gifs/benda/penyapu-1783356787.mp4', 23],
            ['sapaan', 'Aku', 'AKU', 'assets/gifs/sapaan/aku-1781582809.mp4', 1],
            ['sapaan', 'Kamu', 'KAMU', 'assets/gifs/sapaan/kamu-1781582892.mp4', 2],
            ['sapaan', 'Kita', 'KITA', 'assets/gifs/sapaan/kita-1781583068.mp4', 3],
            ['sapaan', 'Mereka', 'MEREKA', 'assets/gifs/sapaan/mereka-1781583005.mp4', 4],
            ['sapaan', 'Apa', 'APA', 'assets/gifs/sapaan/apa-1781582085.mp4', 5],
            ['sapaan', 'Siapa', 'SIAPA', 'assets/gifs/sapaan/siapa-1781582208.mp4', 6],
            ['sapaan', 'Dimana', 'DIMANA', 'assets/gifs/sapaan/dimana-1781582585.mp4', 7],
            ['sapaan', 'Kapan', 'KAPAN', 'assets/gifs/sapaan/kapan-1781582516.mp4', 8],
            ['sapaan', 'Mengapa', 'MENGAPA', 'assets/gifs/sapaan/mengapa-1781582723.mp4', 9],
            ['sapaan', 'Bagaimana', 'BAGAIMANA', 'assets/gifs/sapaan/bagaimana-1781582651.mp4', 10],
            ['sapaan', 'Selamat Sore', 'SELAMAT SORE', 'assets/gifs/sapaan/selamat-sore-1783359511.mp4', 11],
        ];

        foreach ($konten as $k) {
            DB::table('konten_sibis')->insert([
                'kategori'     => $k[0],
                'judul'        => $k[1],
                'teks_sibi'    => $k[2],
                'teks_belinyu' => null,
                'gif_url'      => $k[3],
                'urutan'       => $k[4],
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }
    }

    public function down(): void
    {
        // Tidak perlu rollback data seed.
    }
};
