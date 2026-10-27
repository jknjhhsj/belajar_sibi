<div style="display:grid;grid-template-columns:1fr 110px;gap:14px;margin-bottom:18px">
    <div>
        <label class="flbl"><i class="fas fa-tag" style="color:var(--accent);margin-right:5px"></i>Kategori *</label>
        <select name="kategori" class="inp" required>
            <option value="">— Pilih Kategori —</option>
            @php
                $daftarKategori = [
                    'angka' => '🔢 Angka',
                    'keluarga' => '🫂 Keluarga',
                    'benda' => '📚 Benda Sekolah',
                    'sapaan' => '👋 Kata Sapaan',
                ];
                $kategoriTerpilih = old('kategori', $konten?->kategori);
            @endphp
            @foreach($daftarKategori as $kategoriValue => $kategoriLabel)
            <option value="{{ $kategoriValue }}" {{ $kategoriTerpilih === $kategoriValue ? 'selected' : '' }}>{{ $kategoriLabel }}</option>
            @endforeach
        </select>
        @error('kategori')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
    </div>
    <div>
        <label class="flbl">Urutan</label>
        <input type="number" name="urutan" value="{{ old('urutan', $konten?->urutan ?? 0) }}" min="0" class="inp" placeholder="0">
    </div>
</div>

<div style="margin-bottom:18px">
    <label class="flbl"><i class="fas fa-font" style="color:var(--accent);margin-right:5px"></i>Kata / Judul *</label>
    <input type="text" name="judul" value="{{ old('judul', $konten?->judul) }}"
        placeholder="Contoh: Ayah, 5, Pensil, Selamat Pagi..." class="inp" required>
    @error('judul')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
</div>

<div style="margin-bottom:18px">
    <label class="flbl"><i class="fas fa-hand-paper" style="color:var(--accent);margin-right:5px"></i>Teks SIBI *</label>
    <input type="text" name="teks_sibi" value="{{ old('teks_sibi', $konten?->teks_sibi) }}"
        placeholder="Contoh: AYAH, LIMA, PENSIL..." class="inp" required>
    @error('teks_sibi')<div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
</div>

<div style="margin-bottom:18px">
    <label class="flbl">
        <i class="fas fa-comments" style="color:var(--yellow);margin-right:5px"></i>
        Teks Bahasa Belinyu
        <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--text3)">(opsional)</span>
    </label>
    <input type="text" name="teks_belinyu" value="{{ old('teks_belinyu', $konten?->teks_belinyu) }}"
        placeholder="Terjemahan dalam Bahasa Belinyu..." class="inp">
</div>

{{-- ── UPLOAD MEDIA ── --}}
<div>
    <label class="flbl">
        <i class="fas fa-film" style="color:var(--purple);margin-right:5px"></i>
        Upload GIF / Video Isyarat
        <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--text3)">(opsional)</span>
    </label>

    {{-- Preview media yang sudah ada --}}
    @if(!empty($konten?->gif_url))
    <div id="current-media-wrap" style="margin-bottom:12px;border:1px solid var(--border);border-radius:var(--r);overflow:hidden;background:var(--bg);max-width:260px">
        <div style="padding:8px 12px;font-size:11px;font-weight:600;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--border)">
            <i class="fas fa-image" style="margin-right:5px;color:var(--accent)"></i>Media saat ini
        </div>
        @php $ext = strtolower(pathinfo($konten->gif_url, PATHINFO_EXTENSION)); @endphp
        @if(in_array($ext, ['mp4','webm','mov']))
            <video src="{{ asset($konten->gif_url) }}" autoplay loop muted playsinline
                   style="width:100%;display:block;max-height:180px;object-fit:contain;background:#000"></video>
        @else
            <img src="{{ asset($konten->gif_url) }}" alt="preview"
                 style="width:100%;display:block;max-height:180px;object-fit:contain">
        @endif
        <div style="padding:6px 12px;font-size:11px;color:var(--text3)">Upload file baru untuk mengganti</div>
    </div>
    @endif

    {{-- Dropzone upload --}}
    <div id="drop-zone"
         style="border:2px dashed var(--border);border-radius:var(--r);padding:28px 20px;text-align:center;cursor:pointer;transition:.2s;background:var(--bg);position:relative"
         onclick="document.getElementById('media_file_input').click()"
         ondragover="event.preventDefault();this.style.borderColor='var(--accent)';this.style.background='var(--accent-light)'"
         ondragleave="this.style.borderColor='var(--border)';this.style.background='var(--bg)'"
         ondrop="handleDrop(event)">
        <i class="fas fa-cloud-upload-alt" style="font-size:32px;color:var(--accent);margin-bottom:10px;display:block"></i>
        <div style="font-weight:600;color:var(--text);margin-bottom:4px">Klik atau seret file ke sini</div>
        <div style="font-size:12px;color:var(--text3)">GIF, MP4, WebM, MOV — maks. 20 MB</div>
        <input type="file" id="media_file_input" name="media_file"
               accept=".gif,.mp4,.webm,.mov" style="display:none"
               onchange="previewMedia(this)">
    </div>

    {{-- Preview setelah pilih file baru --}}
    <div id="new-preview-wrap" style="display:none;margin-top:12px;border:1px solid var(--accent);border-radius:var(--r);overflow:hidden;max-width:260px">
        <div style="padding:8px 12px;font-size:11px;font-weight:600;color:var(--accent);text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--accent);background:var(--accent-light)">
            <i class="fas fa-check-circle" style="margin-right:5px"></i>File baru dipilih
        </div>
        <div id="new-preview-media" style="background:#000"></div>
        <div style="padding:8px 12px;display:flex;justify-content:space-between;align-items:center">
            <span id="new-preview-name" style="font-size:12px;color:var(--text3);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:160px"></span>
            <button type="button" onclick="clearFile()"
                    style="font-size:11px;color:var(--red,#e53);border:none;background:none;cursor:pointer;font-weight:600;padding:2px 6px">
                <i class="fas fa-times"></i> Hapus
            </button>
        </div>
    </div>

    @error('media_file')<div class="ferr" style="margin-top:8px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
</div>

<script>
function previewMedia(input) {
    if (!input.files || !input.files[0]) return;
    const file  = input.files[0];
    const url   = URL.createObjectURL(file);
    const ext   = file.name.split('.').pop().toLowerCase();
    const wrap  = document.getElementById('new-preview-wrap');
    const media = document.getElementById('new-preview-media');
    const name  = document.getElementById('new-preview-name');

    if (['mp4','webm','mov'].includes(ext)) {
        media.innerHTML = `<video src="${url}" autoplay loop muted playsinline style="width:100%;display:block;max-height:180px;object-fit:contain"></video>`;
    } else {
        media.innerHTML = `<img src="${url}" style="width:100%;display:block;max-height:180px;object-fit:contain">`;
    }
    name.textContent = file.name;
    wrap.style.display = 'block';

    // highlight dropzone
    const dz = document.getElementById('drop-zone');
    dz.style.borderColor = 'var(--accent)';
    dz.style.background  = 'var(--accent-light)';
}

function clearFile() {
    document.getElementById('media_file_input').value = '';
    document.getElementById('new-preview-wrap').style.display = 'none';
    const dz = document.getElementById('drop-zone');
    dz.style.borderColor = 'var(--border)';
    dz.style.background  = 'var(--bg)';
}

function handleDrop(e) {
    e.preventDefault();
    const dz    = document.getElementById('drop-zone');
    dz.style.borderColor = 'var(--border)';
    dz.style.background  = 'var(--bg)';
    const input = document.getElementById('media_file_input');
    const dt    = e.dataTransfer;
    if (!dt.files.length) return;
    // assign files to input
    const transfer = new DataTransfer();
    transfer.items.add(dt.files[0]);
    input.files = transfer.files;
    previewMedia(input);
}
</script>
