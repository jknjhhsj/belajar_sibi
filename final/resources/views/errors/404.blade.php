@extends('layouts.app')
@section('title','Halaman Tidak Ditemukan — SIBI')

@push('styles')
<style>
.err-wrap{
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    min-height:calc(100vh - 200px);
    text-align:center;padding:40px 20px;
    animation:fadeUp .5s ease both;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:none}}

.err-emoji{
    font-size:80px;line-height:1;margin-bottom:22px;
    animation:wiggle 3s ease-in-out infinite;
}
@keyframes wiggle{
    0%,100%{transform:rotate(0)}
    20%{transform:rotate(-8deg)}
    40%{transform:rotate(8deg)}
    60%{transform:rotate(-4deg)}
    80%{transform:rotate(4deg)}
}
.err-code{
    font-family:'Outfit',sans-serif;font-size:88px;font-weight:900;
    color:var(--border2);line-height:1;margin-bottom:8px;letter-spacing:-4px;
    background:linear-gradient(135deg,var(--border2),var(--border));
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.err-title{
    font-family:'Outfit',sans-serif;font-size:24px;font-weight:800;
    color:var(--text);margin-bottom:10px;letter-spacing:-.4px;
}
.err-sub{
    font-size:14px;color:var(--text3);line-height:1.7;
    max-width:380px;margin-bottom:32px;
}
.err-btns{display:flex;gap:10px;flex-wrap:wrap;justify-content:center}

.err-card{
    background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-lg);padding:18px 22px;
    max-width:440px;margin-top:36px;
    display:flex;align-items:center;gap:14px;text-align:left;
}
.err-card-ico{
    width:42px;height:42px;border-radius:11px;
    background:var(--accent-light);
    display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;
}
</style>
@endpush

@section('content')
<div class="err-wrap">
    <div class="err-emoji">🤷</div>
    <div class="err-code">404</div>
    <div class="err-title">Halaman Tidak Ditemukan</div>
    <p class="err-sub">
        Halaman yang kamu cari tidak ada, mungkin sudah dipindahkan atau URL-nya salah.
        Yuk, kembali ke beranda!
    </p>
    <div class="err-btns">
        <a href="{{ route('home') }}" class="btn btn-green" style="padding:12px 24px;font-size:14px">
            <i class="fas fa-home" style="font-size:11px"></i> Kembali ke Beranda
        </a>
        <a href="{{ route('modul.show','angka') }}" class="btn" style="padding:12px 22px;font-size:14px">
            🔢 Mulai Belajar
        </a>
    </div>

    <div class="err-card">
        <div class="err-card-ico">💡</div>
        <div>
            <div style="font-weight:700;font-size:13px;color:var(--text);margin-bottom:3px">Tips</div>
            <div style="font-size:12px;color:var(--text3);line-height:1.55">
                Periksa kembali URL yang kamu ketik, atau gunakan menu navigasi di atas untuk berpindah halaman.
            </div>
        </div>
    </div>
</div>
@endsection
