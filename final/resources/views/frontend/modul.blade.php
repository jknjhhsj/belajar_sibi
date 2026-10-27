@extends('layouts.siswa')
@section('title', $config['title'].' — Belajar SIBI')

@push('styles')
<style>
.main-content{ max-width:100% !important; padding:0 !important; }

/* ── TOPBAR ── */
.mod-topbar{
    display:flex;align-items:center;gap:12px;
    padding:10px 16px;
    background:linear-gradient(135deg,{{ $config['c1'] }},{{ $config['c2'] }});
    position:relative;overflow:hidden;flex-shrink:0;
}
.mod-topbar::after{
    content:'{{ $config['emoji'] }}';
    position:absolute;right:20px;top:50%;transform:translateY(-50%);
    font-size:80px;opacity:.07;pointer-events:none;line-height:1;
}
.mod-back{
    display:inline-flex;align-items:center;gap:6px;
    background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);
    border-radius:var(--r-sm);padding:6px 12px;text-decoration:none;
    color:#fff;font-size:12px;font-weight:600;flex-shrink:0;
    transition:background .15s;position:relative;z-index:1;
}
.mod-back:hover{background:rgba(255,255,255,.25)}
.mod-topbar-icon{
    width:34px;height:34px;background:rgba(255,255,255,.18);
    border:1.5px solid rgba(255,255,255,.25);border-radius:9px;
    display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;
    position:relative;z-index:1;
}
.mod-topbar-info{position:relative;z-index:1;flex:1;min-width:0}
.mod-topbar-title{font-family:'Outfit',sans-serif;color:#fff;font-size:15px;font-weight:700;letter-spacing:-.2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mod-topbar-sub{color:rgba(255,255,255,.65);font-size:10px;margin-top:1px}
.mod-topbar-counter{
    background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
    border-radius:var(--r-sm);padding:5px 12px;text-align:center;
    position:relative;z-index:1;flex-shrink:0;
}
.mod-topbar-counter-num{font-family:'Outfit',sans-serif;font-weight:800;font-size:13px;color:#fff;line-height:1}
.mod-topbar-counter-lbl{font-size:8px;color:rgba(255,255,255,.6);font-weight:600;margin-top:1px;text-transform:uppercase;letter-spacing:.4px}

/* ── PROGRESS STRIP ── */
.prog-strip{height:4px;background:rgba(0,0,0,.08);flex-shrink:0}
.prog-fill{height:100%;transition:width .5s ease}

/* ── MAIN LAYOUT: fit satu layar HP, tidak perlu geser ── */
.modul-page{
    display:flex;flex-direction:column;
    height:calc(100dvh - 52px - 4px);
    overflow:hidden;
}

/* ── CARD VIEWER (mobile: kolom tunggal, stack ke bawah) ── */
.card-viewer{
    flex:1;min-height:0;
    display:flex;flex-direction:column;
    max-width:680px;width:100%;
    margin:0 auto;
    padding:10px 14px;
    gap:8px;
}

.card-main{ flex:1 1 auto; min-height:0; display:flex; }
.card-side{ display:flex;flex-direction:column;gap:8px;flex-shrink:0; }

/* ── VIDEO AREA — contain supaya orangnya TIDAK PERNAH terpotong ── */
.card-video{
    background:var(--bg);
    border:1px solid var(--border);
    border-radius:var(--r-lg);
    overflow:hidden;
    flex:1 1 auto;
    width:100%;
    min-height:120px;
    max-height:38vh;
    display:flex;align-items:center;justify-content:center;
    box-shadow:var(--shadow);
    position:relative;
}
.card-video img,
.card-video video{
    width:100%;height:100%;
    object-fit:contain;
}
.card-video-ph{
    display:flex;flex-direction:column;align-items:center;gap:8px;
    opacity:.3;padding:16px;
}
.card-video-ph span{font-size:44px;line-height:1}
.card-video-ph p{font-size:12px;font-weight:600;color:var(--text3);text-align:center}

/* ── TEXT INFO ── */
.card-info{
    display:grid;grid-template-columns:1fr 1fr;
    gap:8px;flex-shrink:0;
}
.card-info-cell{
    background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r);padding:10px 14px;
    display:flex;flex-direction:column;gap:2px;
    box-shadow:var(--shadow-sm);
}
.card-info-lbl{font-size:9px;font-weight:700;letter-spacing:.6px;text-transform:uppercase;color:var(--text3)}
.card-info-val{font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:var(--text);line-height:1.1;overflow-wrap:break-word}

/* ── NAVIGATION ── */
.card-nav{
    display:flex;align-items:center;gap:8px;flex-shrink:0;
}
.nav-btn{
    display:flex;align-items:center;justify-content:center;gap:6px;
    padding:10px 16px;border-radius:var(--r);
    font-family:'Outfit',sans-serif;font-size:13px;font-weight:700;
    cursor:pointer;transition:all .15s;border:1.5px solid var(--border);
    background:var(--surface);color:var(--text2);
    flex-shrink:0;
}
.nav-btn:disabled{opacity:.3;cursor:not-allowed}
.nav-btn:not(:disabled):hover{background:var(--bg);border-color:var(--border2)}
.nav-btn-next{
    flex:1;
    background:linear-gradient(135deg,{{ $config['c1'] }},{{ $config['c2'] }}) !important;
    color:#fff !important;border-color:transparent !important;
    box-shadow:var(--shadow);
}
.nav-btn-next:not(:disabled):hover{transform:translateY(-1px);box-shadow:var(--shadow-lg) !important}

/* ── DOTS ── */
.dots-row{
    display:flex;flex-wrap:wrap;gap:5px;justify-content:center;
    padding:2px 0;flex-shrink:0;max-height:24px;overflow:hidden;
}
.dot{
    width:7px;height:7px;border-radius:99px;border:none;
    cursor:pointer;padding:0;transition:all .22s;
    background:var(--border2);flex-shrink:0;
}
.dot.active{width:18px}

/* ── SLIDE TRANSITIONS ── */
.card-video,.card-info{transition:opacity .22s,transform .22s}
.slide-out-l{opacity:0;transform:translateX(-18px) scale(.98)}
.slide-out-r{opacity:0;transform:translateX(18px) scale(.98)}
@keyframes sInL{from{opacity:0;transform:translateX(-18px)}to{opacity:1;transform:none}}
@keyframes sInR{from{opacity:0;transform:translateX(18px)}to{opacity:1;transform:none}}
.slide-in-l{animation:sInL .22s ease both}
.slide-in-r{animation:sInR .22s ease both}

/* ── CTA ── */
.card-cta{
    display:flex;align-items:center;justify-content:center;gap:6px;
    padding:9px;border-radius:var(--r);text-decoration:none;
    font-family:'Outfit',sans-serif;font-weight:700;font-size:12px;
    flex-shrink:0;
}

/* ── RESPONSIVE: layar sempit (HP) ── */
@media(max-width:500px){
    .card-info-val{font-size:17px}
    .card-viewer{padding:8px 10px;gap:6px}
    .nav-btn{padding:9px 12px;font-size:12px}
    .mod-topbar{padding:8px 12px}
    .mod-topbar-title{font-size:13px}
    .card-video{max-height:34vh}
}

/* ── RESPONSIVE: layar pendek ── */
@media(max-height:700px){
    .card-video{max-height:28vh}
    .card-info-val{font-size:16px}
    .card-info-cell{padding:8px 12px}
    .card-viewer{gap:5px;padding:8px 10px}
    .nav-btn{padding:8px 12px}
}
@media(max-height:600px){
    .card-video{max-height:24vh;min-height:90px}
    .card-video-ph span{font-size:32px}
    .card-info-cell{padding:6px 10px}
    .card-info-val{font-size:15px}
}

/* ── DESKTOP/LAPTOP: video di KIRI, teks+nav di KANAN ── */
@media(min-width:768px){
    .modul-page{ height:auto; min-height:calc(100vh - 60px); overflow:visible; }
    .card-viewer{
        flex-direction:row;
        max-width:900px;
        gap:20px;
        padding:24px;
        align-items:stretch;
    }
    .card-main{ flex:0 0 340px; }
    .card-video{ max-height:none; height:100%; min-height:420px; }
    .card-side{ flex:1;justify-content:center;gap:14px; }
    .card-info{ grid-template-columns:1fr 1fr; }
    .card-info-val{ font-size:24px; }
}
</style>
@endpush

@section('content')

{{-- TOPBAR --}}
<div class="mod-topbar">
    <a href="{{ route('home') }}" class="mod-back">
        <i class="fas fa-arrow-left" style="font-size:11px"></i> Kembali
    </a>
    <div class="mod-topbar-icon">{{ $config['emoji'] }}</div>
    <div class="mod-topbar-info">
        <div class="mod-topbar-title">{{ $config['title'] }}</div>
        <div class="mod-topbar-sub">{{ $konten->count() }} konten isyarat</div>
    </div>
    <div class="mod-topbar-counter">
        <div class="mod-topbar-counter-num" id="counter-top">1 / {{ $konten->count() }}</div>
        <div class="mod-topbar-counter-lbl">Konten</div>
    </div>
</div>

{{-- PROGRESS STRIP --}}
<div class="prog-strip">
    <div class="prog-fill" id="prog"
         style="width:{{ $konten->count() > 0 ? round(1/$konten->count()*100,1) : 100 }}%;background:{{ $config['c1'] }}">
    </div>
</div>

{{-- CARD VIEWER --}}
<div class="modul-page">
<div class="card-viewer">

    {{-- VIDEO (kolom kiri di desktop) --}}
    <div class="card-main">
        <div class="card-video" id="card-video">
            @php $firstGif = $konten->first()?->gif_url; $firstExt = $firstGif ? strtolower(pathinfo($firstGif, PATHINFO_EXTENSION)) : ''; @endphp
            @if($firstGif)
                @if(in_array($firstExt, ['mp4','webm','mov']))
                    <video src="{{ asset($firstGif) }}" autoplay loop muted playsinline id="card-img"
                           style="width:100%;height:100%;object-fit:contain"
                           onerror="this.parentElement.innerHTML='<div class=card-video-ph><span>🎬</span><p>Video belum tersedia</p></div>'"></video>
                @else
                    <img src="{{ asset($firstGif) }}" alt="{{ $konten->first()->judul }}" id="card-img"
                         style="width:100%;height:100%;object-fit:contain"
                         onerror="this.parentElement.innerHTML='<div class=card-video-ph><span>🎬</span><p>Video belum tersedia</p></div>'">
                @endif
            @else
                <div class="card-video-ph">
                    <span>🎬</span>
                    <p>Video belum tersedia</p>
                </div>
            @endif
        </div>
    </div>

    {{-- TEKS + DOTS + NAV + CTA (kolom kanan di desktop) --}}
    <div class="card-side">

        {{-- TEXT INFO --}}
        <div class="card-info" id="card-info">
            <div class="card-info-cell">
                <div class="card-info-lbl">🤟 Isyarat SIBI</div>
                <div class="card-info-val" id="txt-sibi">{{ $konten->first()?->teks_sibi }}</div>
            </div>
            <div class="card-info-cell" style="background:var(--yellow-light);border-color:#FDE68A">
                <div class="card-info-lbl" style="color:var(--yellow)">🗣️ Belinyu</div>
                <div class="card-info-val" style="color:var(--yellow)" id="txt-bel">{{ $konten->first()?->teks_belinyu ?: '—' }}</div>
            </div>
        </div>

        {{-- DOTS --}}
        <div class="dots-row" id="dots-row">
            @foreach($konten as $idx => $_)
            <button class="dot {{ $idx === 0 ? 'active' : '' }}"
                    onclick="goTo({{ $idx }})"
                    style="{{ $idx === 0 ? 'width:18px;background:'.$config['c1'] : '' }}">
            </button>
            @endforeach
        </div>

        {{-- NAV BUTTONS --}}
        <div class="card-nav">
            <button class="nav-btn" id="btn-prev" onclick="goSlide(-1)" disabled>
                <i class="fas fa-chevron-left" style="font-size:11px"></i> Sebelumnya
            </button>
            <button class="nav-btn nav-btn-next" id="btn-next" onclick="goSlide(1)">
                Selanjutnya <i class="fas fa-chevron-right" style="font-size:11px"></i>
            </button>
        </div>

        {{-- CTA --}}
        <a href="{{ route('kuis.index') }}" class="card-cta"
           style="background:var(--yellow-light);border:1.5px solid #FDE68A;color:var(--yellow)">
            🏆 Selesai? Lanjut ke Kuis!
        </a>

    </div>

</div>
</div>

{{-- DATA FOR JS --}}
<script>
@php
$cardsData = $konten->values()->map(function($c) {
    $url = $c->gif_url ? asset($c->gif_url) : null;
    $ext = $c->gif_url ? strtolower(pathinfo($c->gif_url, PATHINFO_EXTENSION)) : '';
    return [
        'gif'  => $url,
        'ext'  => $ext,
        'sibi' => $c->teks_sibi,
        'bel'  => $c->teks_belinyu ?: '—',
        'judul'=> $c->judul,
    ];
})->values()->toArray();
@endphp
const CARDS = {!! json_encode($cardsData) !!};
const C1 = "{{ $config['c1'] }}";
const TOTAL = CARDS.length;
const KATEGORI_SLUG = "{{ $kategori }}";
const CSRF_MODUL = document.querySelector('meta[name=csrf-token]')?.content;
let cur = 0;

function kirimProgress(idx) {
    if (!CSRF_MODUL) return;
    fetch(`/modul/${KATEGORI_SLUG}/progress`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_MODUL,
        },
        body: JSON.stringify({ index: idx }),
    }).catch(() => {});
}

function goTo(idx) {
    if (idx === cur || idx < 0 || idx >= TOTAL) return;
    const dir = idx > cur ? 1 : -1;
    const video = document.getElementById('card-video');
    const info  = document.getElementById('card-info');
    const outCls = dir > 0 ? 'slide-out-l' : 'slide-out-r';
    const inCls  = dir > 0 ? 'slide-in-r'  : 'slide-in-l';

    [video, info].forEach(el => { el.classList.add(outCls); });

    setTimeout(() => {
        const c = CARDS[idx];
        if (c.gif) {
            const isVideo = ['mp4','webm','mov'].includes(c.ext);
            if (isVideo) {
                video.innerHTML = `<video src="${c.gif}" autoplay loop muted playsinline id="card-img" style="width:100%;height:100%;object-fit:contain" onerror="this.parentElement.innerHTML='<div class=card-video-ph><span>🎬</span><p>Video belum tersedia</p></div>'"></video>`;
            } else {
                video.innerHTML = `<img src="${c.gif}" alt="${c.judul}" id="card-img" style="width:100%;height:100%;object-fit:contain" onerror="this.parentElement.innerHTML='<div class=card-video-ph><span>🎬</span><p>Video belum tersedia</p></div>'">`;
            }
        } else {
            video.innerHTML = '<div class="card-video-ph"><span>🎬</span><p>Video belum tersedia</p></div>';
        }
        document.getElementById('txt-sibi').textContent = c.sibi;
        document.getElementById('txt-bel').textContent  = c.bel;

        [video, info].forEach(el => {
            el.classList.remove(outCls);
            el.classList.add(inCls);
            setTimeout(() => el.classList.remove(inCls), 240);
        });

        cur = idx;
        updateUI();
        kirimProgress(idx);
    }, 180);
}

function goSlide(d) { goTo(cur + d); }

function updateUI() {
    document.getElementById('counter-top').textContent = (cur+1)+' / '+TOTAL;
    document.getElementById('prog').style.width = ((cur+1)/TOTAL*100).toFixed(1)+'%';

    document.querySelectorAll('.dot').forEach((d,i) => {
        const act = i === cur;
        d.classList.toggle('active', act);
        d.style.width = act ? '18px' : '7px';
        d.style.background = act ? C1 : '';
    });

    const bp = document.getElementById('btn-prev');
    const bn = document.getElementById('btn-next');
    bp.disabled = cur === 0;

    if (cur === TOTAL - 1) {
        bn.disabled = false;
        bn.innerHTML = '<i class="fas fa-check" style="font-size:11px"></i> Selesai!';
        @php
        $modulUrutan = ['angka','keluarga','benda','sapaan'];
        $idxKategori = array_search($kategori, $modulUrutan);
        $nextKategori = ($idxKategori !== false && $idxKategori < count($modulUrutan)-1)
            ? $modulUrutan[$idxKategori + 1]
            : null;
        @endphp
        @if($nextKategori)
        bn.onclick = function() { window.location.href = '{{ route("modul.show", $nextKategori) }}'; };
        @else
        bn.onclick = function() { window.location.href = '{{ route("kuis.index") }}'; };
        @endif
    } else {
        bn.disabled = false;
        bn.innerHTML = 'Selanjutnya <i class="fas fa-chevron-right" style="font-size:11px"></i>';
        bn.onclick = function() { goSlide(1); };
    }
}

document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') goSlide(1);
    if (e.key === 'ArrowLeft')  goSlide(-1);
});

let sx = 0;
document.addEventListener('touchstart', e => { sx = e.touches[0].clientX; }, {passive:true});
document.addEventListener('touchend', e => {
    const dx = e.changedTouches[0].clientX - sx;
    if (Math.abs(dx) > 44) goSlide(dx < 0 ? 1 : -1);
}, {passive:true});

kirimProgress(0);
</script>

@endsection