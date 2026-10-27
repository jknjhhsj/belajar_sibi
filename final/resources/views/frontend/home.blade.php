@extends('layouts.siswa')
@section('title','Beranda — Belajar SIBI')

@push('styles')
<style>
.hero{
    background:linear-gradient(135deg,var(--dark) 0%,var(--navy) 55%,#1A4F8B 100%);
    border-radius:var(--r-lg);padding:28px 22px 24px;margin-bottom:16px;position:relative;overflow:hidden;
}
.hero-deco{position:absolute;border-radius:50%;pointer-events:none;background:rgba(255,255,255,.04)}
.hero h1{font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:#fff;line-height:1.15;letter-spacing:-.5px;margin-bottom:8px}
.hero h1 span{color:#BFDBFE}
.hero p{color:rgba(255,255,255,.7);font-size:13px;line-height:1.65;margin-bottom:18px}
.hero-ctas{display:flex;gap:10px;flex-wrap:wrap}
.hero-btn-pri{display:inline-flex;align-items:center;gap:7px;padding:12px 20px;border-radius:12px;background:#fff;color:var(--accent);font-family:'Outfit',sans-serif;font-weight:700;font-size:14px;text-decoration:none;border:none;cursor:pointer;transition:all .15s}
.hero-btn-pri:active{transform:scale(.97)}
.hero-btn-sec{display:inline-flex;align-items:center;gap:7px;padding:12px 18px;border-radius:12px;background:rgba(255,255,255,.15);color:#fff;font-weight:600;font-size:13px;text-decoration:none;border:1px solid rgba(255,255,255,.25);transition:all .15s}
.hero-btn-sec:active{transform:scale(.97)}
.hero-float{position:absolute;right:16px;top:50%;transform:translateY(-50%);font-size:72px;filter:drop-shadow(0 8px 24px rgba(0,0,0,.3));animation:floatY 4s ease-in-out infinite;pointer-events:none;opacity:.85}
@keyframes floatY{0%,100%{transform:translateY(-50%)}50%{transform:translateY(calc(-50% - 10px))}}

/* Stats */
.stats-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:14px 16px;display:flex;align-items:center;gap:12px;transition:all .15s}
.stat-card:active{transform:scale(.98)}
.stat-icon{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.stat-num{font-family:'Outfit',sans-serif;font-size:22px;font-weight:900;color:var(--text);line-height:1}
.stat-lbl{font-size:11px;color:var(--text2);margin-top:1px;font-weight:500}

/* Section */
.sec-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.sec-title{font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;color:var(--text);letter-spacing:-.2px;display:flex;align-items:center;gap:7px}
.sec-title::before{content:'';width:3px;height:16px;background:var(--accent);border-radius:99px}
.see-all{font-size:12px;color:var(--accent);font-weight:700;text-decoration:none}

/* Module grid */
.module-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:18px}
.mod-card{border-radius:var(--r);overflow:hidden;text-decoration:none;display:block;transition:transform .2s,box-shadow .2s;position:relative}
.mod-card:active{transform:scale(.97)}
.mod-body{padding:20px 16px 16px;position:relative;min-height:130px;display:flex;flex-direction:column;justify-content:space-between}
.mod-tag{display:inline-block;background:rgba(255,255,255,.2);border-radius:99px;padding:3px 10px;font-size:9px;font-weight:700;color:#fff;letter-spacing:.5px;margin-bottom:10px;width:fit-content}
.mod-title{font-family:'Outfit',sans-serif;color:#fff;font-size:17px;font-weight:800;margin-bottom:3px;letter-spacing:-.2px}
.mod-desc{color:rgba(255,255,255,.65);font-size:11px;line-height:1.5}
.mod-cta{display:inline-flex;align-items:center;gap:5px;margin-top:12px;background:rgba(255,255,255,.18);border-radius:8px;padding:5px 12px;color:#fff;font-size:11px;font-weight:600;transition:background .15s}
.mod-bg-em{position:absolute;right:-6px;bottom:-8px;font-size:64px;opacity:.12;line-height:1;pointer-events:none}

/* Kuis banner */
.kuis-banner{border-radius:var(--r);overflow:hidden;text-decoration:none;display:flex;align-items:center;background:linear-gradient(135deg,var(--dark),#1A4F8B);padding:20px;gap:16px;margin-bottom:18px;transition:transform .2s}
.kuis-banner:active{transform:scale(.98)}

/* Steps */
.steps-list{display:flex;flex-direction:column;gap:12px;margin-bottom:18px}
.step-item{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:16px;display:flex;align-items:flex-start;gap:14px;position:relative;overflow:hidden}
.step-item::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:var(--accent)}
.step-num{font-family:'Outfit',sans-serif;font-size:9px;font-weight:800;color:var(--text3);letter-spacing:1px;text-transform:uppercase;margin-bottom:5px}
.step-icon{font-size:26px;flex-shrink:0;margin-top:2px}
.step-title{font-weight:700;font-size:14px;color:var(--text);margin-bottom:3px}
.step-desc{font-size:12px;color:var(--text2);line-height:1.5}

/* CTA */
.cta-card{background:var(--accent-light);border:1px solid var(--accent-light2);border-radius:var(--r);padding:20px;margin-bottom:8px;display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px}
</style>
@endpush

@section('content')

<div class="hero fu">
    <div class="hero-deco" style="width:250px;height:250px;top:-100px;right:120px"></div>
    <div class="hero-deco" style="width:180px;height:180px;bottom:-70px;left:-60px"></div>
    <div style="position:relative;z-index:2;max-width:260px">
        <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:99px;padding:4px 12px;font-size:10px;font-weight:700;color:rgba(255,255,255,.9);margin-bottom:14px;letter-spacing:.3px">
            🇮🇩 Platform SIBI Indonesia
        </div>
        <h1>Belajar<br><span>Isyarat SIBI</span><br>Sekarang!</h1>
        <p>Pelajari Bahasa Isyarat Indonesia dengan cara yang seru, mudah, dan gratis.</p>
        <div class="hero-ctas">
            <a href="{{ route('modul.show','angka') }}" class="hero-btn-pri">
                <i class="fas fa-play" style="font-size:10px"></i> Mulai Belajar
            </a>
            <a href="{{ route('kuis.index') }}" class="hero-btn-sec">🏆 Kuis</a>
        </div>
    </div>
    <div class="hero-float">🤟</div>
</div>

<div class="stats-row">
    @foreach([['🔢','#DBEAFE','17','Konten Angka'],['🫂','#EBF5FB','8','Konten Keluarga'],['📚','#E0F2FE','23','Konten Benda'],['👋','#DBEAFE','11','Konten Sapaan']] as $i=>[$em,$bg,$n,$l])
    <div class="stat-card fu d{{ $i+1 }}">
        <div class="stat-icon" style="background:{{ $bg }}">{{ $em }}</div>
        <div><div class="stat-num">{{ $n }}</div><div class="stat-lbl">{{ $l }}</div></div>
    </div>
    @endforeach
</div>

<div class="sec-hd"><div class="sec-title">Modul Belajar</div></div>
<div class="module-grid">
    @foreach([
       ['modul.show','angka',   '🔢','Angka',   '1 – 1000.000','linear-gradient(135deg,#0D2B6E,#1A4F8B)','21 Angka'],
       ['modul.show','keluarga','👪','Keluarga','Keluarga','linear-gradient(135deg,#093C6B,#1A6DB0)','10 Anggota Keluarga'],
       ['modul.show','benda',   '📚','Benda',   'Benda','linear-gradient(135deg,#0D2651,#1A4F8B)','15 Benda'],
       ['modul.show','sapaan',  '👋','Sapaan',  'Sapaan','linear-gradient(135deg,#0D2651,#2563B0)','10 Kata Sapaan'],
    ] as $i=>[$r,$p,$em,$t,$d,$bg,$tag])
    <a href="{{ route($r,$p) }}" class="mod-card fu d{{ $i+1 }}">
        <div class="mod-body" style="background:{{ $bg }}">
            <div>
                <span class="mod-tag">{{ $tag }}</span>
                <div class="mod-title">{{ $t }}</div>
                <div class="mod-desc">{{ $d }}</div>
                <div class="mod-cta">Mulai <i class="fas fa-arrow-right" style="font-size:9px"></i></div>
            </div>
            <div class="mod-bg-em">{{ $em }}</div>
        </div>
    </a>
    @endforeach
</div>

<a href="{{ route('kuis.index') }}" class="kuis-banner fu d3">
    <div style="font-size:42px">🏆</div>
    <div style="flex:1">
        <span class="mod-tag">3 tingkat</span>
        <div class="mod-title" style="font-size:18px">Kuis Interaktif</div>
        <div class="mod-desc">Uji kemampuan isyaratmu!</div>
    </div>
    <div class="mod-cta" style="font-size:13px;padding:8px 16px;flex-shrink:0">Mulai <i class="fas fa-arrow-right" style="font-size:9px"></i></div>
</a>

<div class="sec-hd"><div class="sec-title">Cara Belajar</div></div>
<div class="steps-list">
    @foreach([['LANGKAH 01','🗂️','Pilih Modul','Tentukan topik isyarat yang ingin kamu pelajari.'],['LANGKAH 02','🎬','Pelajari Gerakan','Amati animasi gerakan isyarat di setiap konten.'],['LANGKAH 03','🏆','Ikut Kuis','Uji kemampuanmu dengan soal kuis bertingkat.']] as $i=>[$num,$em,$t,$d])
    <div class="step-item fu d{{ $i+2 }}">
        <div style="font-size:24px;flex-shrink:0">{{ $em }}</div>
        <div>
            <div class="step-num">{{ $num }}</div>
            <div class="step-title">{{ $t }}</div>
            <div class="step-desc">{{ $d }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="cta-card fu d4">
    <div style="font-size:40px">🌟</div>
    <div>
        <div style="font-family:'Outfit',sans-serif;font-size:18px;font-weight:800;color:var(--accent);margin-bottom:5px">Siap Mulai?</div>
        <div style="font-size:13px;color:var(--text2)">Bergabung dan pelajari SIBI sekarang. Gratis selamanya!</div>
    </div>
    @guest
    <button onclick="openLogin()" class="btn-pri" style="max-width:200px">✨ Daftar Gratis</button>
    @else
    <a href="{{ route('siswa.dashboard') }}" class="btn-pri" style="max-width:200px">📊 Lihat Progress</a>
    @endguest
</div>

@endsection
