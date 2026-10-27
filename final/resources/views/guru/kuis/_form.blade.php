<div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
    <div>
        <label class="flbl"><i class="fas fa-tag" style="color:var(--accent);margin-right:5px"></i>Kategori *</label>
        <select name="kategori" id="sel-kategori" class="inp" required onchange="isiPilihanMateri()">
            <option value="">— Pilih Kategori —</option>
            @foreach(['angka'=>'🔢 Angka','keluarga'=>'🫂 Keluarga','benda'=>'📚 Benda','sapaan'=>'👋 Sapaan'] as $k => $l)
            <option value="{{ $k }}" {{ old('kategori', $soal?->kategori) === $k ? 'selected' : '' }}>{{ $l }}</option>
            @endforeach
        </select>
        @error('kategori')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
    </div>
    <div>
        <label class="flbl"><i class="fas fa-layer-group" style="color:var(--yellow);margin-right:5px"></i>Tingkat Kesulitan *</label>
        <select name="level" class="inp" required>
            @foreach([1=>['🟢 Mudah','#1B6B45'],2=>['🟡 Sedang','#D68910'],3=>['🔴 Susah','#B03A2E']] as $n => [$l, $col])
            <option value="{{ $n }}" {{ old('level', $soal?->level) == $n ? 'selected' : '' }}>{{ $l }}</option>
            @endforeach
        </select>
        @error('level')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
    </div>
</div>

<div style="margin-bottom:18px">
    <label class="flbl"><i class="fas fa-question-circle" style="color:var(--accent);margin-right:5px"></i>Pertanyaan *</label>
    <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $soal?->pertanyaan) }}"
        placeholder="Contoh: Tunjukkan angka 5 dalam SIBI!" class="inp" required>
    @error('pertanyaan')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
</div>

<div style="margin-bottom:18px">
    <label class="flbl">
        <i class="fas fa-film" style="color:var(--purple);margin-right:5px"></i>
        Video / GIF Soal *
        <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--text3)">(pilih dari materi yang sudah diupload)</span>
    </label>
    <select name="gif_soal" id="sel-gif-soal" class="inp" required>
        <option value="">— Pilih kategori dulu di atas —</option>
    </select>
    <div style="font-size:11px;color:var(--text3);margin-top:6px">
        <i class="fas fa-info-circle"></i> Video/GIF wajib dipilih supaya soal jelas untuk siswa tunarungu.
    </div>
    @error('gif_soal')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror

    <div id="gif-soal-preview" style="display:none;margin-top:10px;border:1px solid var(--border);border-radius:var(--r);overflow:hidden;max-width:220px;background:var(--bg)"></div>
</div>

<div style="background:var(--bg);border:1px solid var(--border);border-radius:var(--r);padding:18px;margin-bottom:18px">
    <div style="font-size:11px;font-weight:700;color:var(--text2);text-transform:uppercase;letter-spacing:.6px;margin-bottom:14px">
        Pilihan Jawaban *<span style="font-weight:400;text-transform:none;color:var(--text3)"> — semua wajib diisi, centang salah satu sebagai jawaban benar</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:10px">
        @foreach(['a'=>'A','b'=>'B','c'=>'C','d'=>'D'] as $k => $label)
        <div id="row-{{ $k }}" style="display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:var(--r-sm);border:1.5px solid var(--border);background:var(--surface);transition:all .15s">
            <input type="radio" name="jawaban_benar" value="{{ $k }}"
                {{ old('jawaban_benar', $soal?->jawaban_benar) === $k ? 'checked' : '' }}
                style="accent-color:var(--accent);width:18px;height:18px;flex-shrink:0"
                required
                onchange="highlightAnswer()">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:26px;height:26px;background:var(--bg);border-radius:7px;font-size:12px;font-weight:800;flex-shrink:0">{{ $label }}</span>
            <input type="text" name="pilihan_{{ $k }}" oninput="highlightAnswer()"
                value="{{ old('pilihan_'.$k, $soal?->{'pilihan_'.$k}) }}"
                placeholder="Jawaban {{ $label }}..."
                class="inp" style="flex:1;margin:0" required>
            <span id="ico-{{ $k }}" style="font-size:16px;width:20px;text-align:center;flex-shrink:0"></span>
            @error('pilihan_'.$k)<div class="ferr">{{ $message }}</div>@enderror
        </div>
        @endforeach
    </div>
    @error('jawaban_benar')<div class="ferr" style="margin-top:8px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
</div>

@push('scripts')
<script>
const KONTEN_PER_KATEGORI = {!! json_encode($kontenPerKategori ?? []) !!};
const GIF_SOAL_TERSIMPAN = @json(old('gif_soal', $soal?->gif_soal));

function isiPilihanMateri() {
    const kategori = document.getElementById('sel-kategori').value;
    const select   = document.getElementById('sel-gif-soal');
    const list     = KONTEN_PER_KATEGORI[kategori] || [];

    select.innerHTML = '';

    if (!kategori) {
        select.innerHTML = '<option value="">— Pilih kategori dulu di atas —</option>';
        return;
    }
    if (list.length === 0) {
        select.innerHTML = '<option value="">Belum ada materi untuk kategori ini</option>';
        return;
    }

    select.innerHTML = '<option value="">— Pilih materi / video —</option>';
    list.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.gif_url || '';
        opt.textContent = item.judul + ' (' + item.teks + ')';
        if (GIF_SOAL_TERSIMPAN && item.gif_url === GIF_SOAL_TERSIMPAN) opt.selected = true;
        select.appendChild(opt);
    });

    previewGifSoal();
}

function previewGifSoal() {
    const select = document.getElementById('sel-gif-soal');
    const wrap   = document.getElementById('gif-soal-preview');
    const val    = select.value;

    if (!val) { wrap.style.display = 'none'; wrap.innerHTML = ''; return; }

    const ext = val.split('.').pop().toLowerCase();
    if (['mp4','webm','mov'].includes(ext)) {
        wrap.innerHTML = `<video src="/${val}" autoplay loop muted playsinline style="width:100%;display:block;max-height:160px;object-fit:contain;background:#000"></video>`;
    } else {
        wrap.innerHTML = `<img src="/${val}" style="width:100%;display:block;max-height:160px;object-fit:contain">`;
    }
    wrap.style.display = 'block';
}

document.getElementById('sel-gif-soal')?.addEventListener('change', previewGifSoal);

function highlightAnswer() {
    ['a','b','c','d'].forEach(k => {
        const row   = document.getElementById('row-' + k);
        const ico   = document.getElementById('ico-' + k);
        const radio = row.querySelector('input[type="radio"]');
        const text  = row.querySelector('input[type="text"]');

        if (radio.checked) {
            row.style.borderColor = 'var(--accent)';
            row.style.background  = 'var(--accent-light)';
            ico.textContent = '✅';
        } else if (text.value.trim() !== '') {
            row.style.borderColor = 'var(--red, #e53)';
            row.style.background  = 'var(--red-light, #FDEDEA)';
            ico.textContent = '❌';
        } else {
            row.style.borderColor = 'var(--border)';
            row.style.background  = 'var(--surface)';
            ico.textContent = '';
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    isiPilihanMateri();
    highlightAnswer();
});
</script>
@endpush