<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Belajar Bahasa Isyarat Indonesia (SIBI) — platform pembelajaran isyarat modern.">
    <title>@yield('title','SIBI — Belajar Bahasa Isyarat')</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{
            --bg:#EEF4FB;--surface:#FFFFFF;--card:#FFFFFF;--card2:#F0F6FF;
            --border:#D1E3F8;--border2:#AACBF0;
            --text:#0D1B2E;--text2:#4A637E;--text3:#8BA5BF;
            --accent:#1A4F8B;--accent2:#2563B0;--accent-light:#DBEAFE;--accent-light2:#BFDBFE;
            --red:#B03A2E;--red-light:#FDEDEA;
            --yellow:#D68910;--yellow-light:#FEF9E7;
            --blue:#2471A3;--blue-light:#EBF5FB;
            --purple:#7D3C98;--purple-light:#F4ECF7;
            --shadow-sm:0 1px 3px rgba(26,79,139,.06),0 1px 2px rgba(26,79,139,.04);
            --shadow:0 4px 16px rgba(26,79,139,.10),0 2px 4px rgba(26,79,139,.05);
            --shadow-lg:0 12px 40px rgba(26,79,139,.13),0 4px 12px rgba(26,79,139,.07);
            --r:14px;--r-sm:9px;--r-lg:22px;--r-xl:30px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased}

        /* ── SPLASH SCREEN ── */
        #sibi-splash{
            position:fixed;inset:0;z-index:9999;
            background:linear-gradient(160deg,#071428 0%,#0d2a5e 50%,#071428 100%);
            display:flex;flex-direction:column;align-items:center;justify-content:center;
            transition:opacity .5s ease, visibility .5s ease;
        }
        #sibi-splash.hide{opacity:0;visibility:hidden}
        .splash-ring{
            width:130px;height:130px;border-radius:50%;
            border:2px solid rgba(96,165,250,.2);
            display:flex;align-items:center;justify-content:center;
            animation:splashPulse 2s ease infinite;
        }
        .splash-inner{
            width:92px;height:92px;border-radius:50%;
            background:rgba(96,165,250,.12);
            border:1.5px solid rgba(96,165,250,.4);
            display:flex;align-items:center;justify-content:center;
            font-size:40px;
        }
        @keyframes splashPulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.07);opacity:.75}}
        .splash-title{font-family:'Outfit',sans-serif;font-size:36px;font-weight:800;color:#fff;letter-spacing:-1.5px;margin-top:22px}
        .splash-title em{color:#60a5fa;font-style:normal}
        .splash-tagline{font-size:12px;color:rgba(255,255,255,.4);letter-spacing:2px;text-transform:uppercase;margin-top:6px}
        .splash-dots{display:flex;gap:7px;margin-top:36px}
        .s-dot{width:8px;height:8px;border-radius:50%;background:rgba(96,165,250,.2);animation:dotBlink 1.4s ease infinite}
        .s-dot:nth-child(2){animation-delay:.22s}
        .s-dot:nth-child(3){animation-delay:.44s}
        @keyframes dotBlink{0%,80%,100%{background:rgba(96,165,250,.2)}40%{background:#60a5fa}}

        /* ── LOADING SCREEN ── */
        #sibi-loading{
            position:fixed;inset:0;z-index:9998;
            background:#0d2a5e;
            display:flex;flex-direction:column;align-items:center;justify-content:center;
            opacity:0;visibility:hidden;
            transition:opacity .4s ease, visibility .4s ease;
        }
        #sibi-loading.show{opacity:1;visibility:visible}
        .load-logo{display:flex;align-items:center;gap:13px;margin-bottom:36px}
        .load-mark{width:44px;height:44px;border-radius:12px;background:#60a5fa;display:flex;align-items:center;justify-content:center;font-size:22px}
        .load-name{font-family:'Outfit',sans-serif;font-size:24px;font-weight:800;color:#fff;letter-spacing:-.5px}
        .load-name em{color:#60a5fa;font-style:normal}
        .load-track{width:220px;height:4px;background:rgba(255,255,255,.12);border-radius:99px;overflow:hidden}
        .load-fill{height:100%;width:0%;background:#60a5fa;border-radius:99px;transition:width .1s linear}
        .load-pct{font-size:13px;font-weight:600;color:rgba(255,255,255,.45);margin-top:11px;letter-spacing:.5px}
        .load-status{font-size:11px;color:rgba(255,255,255,.3);margin-top:5px}

        /* ── LAYOUT ── */
        .app{display:grid;grid-template-columns:256px 1fr;grid-template-rows:64px 1fr;min-height:100vh}

        /* ── TOPBAR ── */
        .topbar{grid-column:1/-1;height:64px;background:var(--surface);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 24px;gap:16px;position:sticky;top:0;z-index:100;box-shadow:var(--shadow-sm)}
        .logo{display:flex;align-items:center;gap:10px;text-decoration:none}
        .logo-mark{width:34px;height:34px;background:var(--accent);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;flex-shrink:0}
        .logo-name{font-family:'Outfit',sans-serif;font-size:17px;font-weight:700;color:var(--text);letter-spacing:-.3px}
        .logo-name em{color:var(--accent);font-style:normal}
        .top-divider{width:1px;height:22px;background:var(--border);flex-shrink:0}
        .top-tag{font-size:12px;color:var(--text3);font-weight:400}
        .top-spacer{flex:1}
        .top-actions{display:flex;align-items:center;gap:8px}

        /* ── SIDEBAR ── */
        .sidebar{background:var(--surface);border-right:1px solid var(--border);padding:20px 12px;display:flex;flex-direction:column;gap:2px;position:sticky;top:64px;height:calc(100vh - 64px);overflow-y:auto}
        .sb-label{font-size:10px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text3);padding:0 10px;margin:14px 0 4px}
        .sb-label:first-child{margin-top:0}
        .nav-item{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:var(--r-sm);text-decoration:none;color:var(--text2);font-size:13px;font-weight:500;transition:all .15s;position:relative;cursor:pointer}
        .nav-item:hover{background:var(--card2);color:var(--text)}
        .nav-item.active{background:var(--accent-light);color:var(--accent);font-weight:600}
        .nav-item.active::before{content:'';position:absolute;left:0;top:5px;bottom:5px;width:2.5px;background:var(--accent);border-radius:0 2px 2px 0}
        .nav-icon{width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;background:rgba(0,0,0,.04);transition:background .15s}
        .nav-item.active .nav-icon{background:var(--accent-light2)}
        .nav-badge{margin-left:auto;background:var(--accent-light);color:var(--accent);font-size:10px;font-weight:700;padding:2px 6px;border-radius:99px}
        .sb-footer{margin-top:auto;padding-top:14px;border-top:1px solid var(--border)}
        .sb-tip{background:var(--accent-light);border-radius:var(--r-sm);padding:12px;font-size:11px;color:var(--accent2);line-height:1.5}
        .sb-tip strong{color:var(--accent);display:block;margin-bottom:3px;font-size:12px}

        /* ── MAIN ── */
        .main{padding:32px 36px;max-width:1080px;overflow-x:hidden}

        /* ── BUTTONS ── */
        .btn{display:inline-flex;align-items:center;gap:7px;padding:8px 14px;border-radius:var(--r-sm);font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;text-decoration:none;transition:all .15s;border:1px solid var(--border);background:var(--surface);color:var(--text2)}
        .btn:hover{background:var(--card2);border-color:var(--border2);color:var(--text)}
        .btn-green{border:none;background:var(--accent);color:#fff;font-weight:600}
        .btn-green:hover{background:var(--accent2);transform:translateY(-1px);box-shadow:var(--shadow)}

        /* ── FORM ── */
        .form-label{display:block;font-size:11px;font-weight:600;color:var(--text2);margin-bottom:5px;letter-spacing:.3px}
        .form-input{width:100%;padding:10px 13px;border:1px solid var(--border);border-radius:var(--r-sm);background:var(--bg);font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text);transition:all .15s;outline:none}
        .form-input:focus{border-color:var(--accent);background:var(--surface);box-shadow:0 0 0 3px var(--accent-light)}
        .form-input::placeholder{color:var(--text3)}

        /* ── TOAST ── */
        .toast-area{position:fixed;top:72px;right:20px;z-index:500;display:flex;flex-direction:column;gap:8px}
        .toast{display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:var(--r);box-shadow:var(--shadow-lg);background:var(--surface);border:1px solid var(--border);animation:tIn .3s cubic-bezier(.34,1.4,.64,1) both;min-width:240px;max-width:340px}
        .toast-s{border-left:3px solid var(--accent)}
        .toast-e{border-left:3px solid var(--red)}
        .toast-ico{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;flex-shrink:0}
        .toast-s .toast-ico{background:var(--accent-light);color:var(--accent)}
        .toast-e .toast-ico{background:var(--red-light);color:var(--red)}
        .toast-msg{font-size:13px;font-weight:500;color:var(--text);flex:1}
        .toast-x{background:none;border:none;cursor:pointer;color:var(--text3);font-size:15px;padding:2px;line-height:1}
        @keyframes tIn{from{opacity:0;transform:translateX(16px)}to{opacity:1;transform:none}}

        /* ── MODAL ── */
        .modal-bg{position:fixed;inset:0;z-index:400;background:rgba(27,26,23,.45);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;padding:20px}
        .modal-box{background:var(--surface);border-radius:var(--r-lg);box-shadow:var(--shadow-lg);width:100%;max-width:400px;padding:32px;animation:mIn .25s cubic-bezier(.34,1.2,.64,1) both;border:1px solid var(--border)}
        @keyframes mIn{from{opacity:0;transform:scale(.96) translateY(8px)}to{opacity:1;transform:none}}

        /* ── ANIMS ── */
        @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:none}}
        .fu{animation:fadeUp .4s ease both}
        .d1{animation-delay:.06s}.d2{animation-delay:.12s}.d3{animation-delay:.18s}.d4{animation-delay:.24s}.d5{animation-delay:.30s}

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar{width:5px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:var(--border2);border-radius:99px}

        /* ── RESPONSIVE ── */
        @media(max-width:900px){
            .app{grid-template-columns:1fr}
            .sidebar{display:none}
            .main{padding:20px 16px}
        }

        .hidden{display:none!important}
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══════════════════════════════════════
     SPLASH SCREEN
═══════════════════════════════════════ --}}
<div id="sibi-splash">
    <div class="splash-ring">
        <div class="splash-inner">🤟</div>
    </div>
    <div class="splash-title">SI<em>BI</em></div>
    <div class="splash-tagline">Bahasa Isyarat Indonesia</div>
    <div class="splash-dots">
        <div class="s-dot"></div>
        <div class="s-dot"></div>
        <div class="s-dot"></div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     LOADING SCREEN
═══════════════════════════════════════ --}}
<div id="sibi-loading">
    <div class="load-logo">
        <div class="load-mark">🤟</div>
        <div class="load-name">SI<em>BI</em></div>
    </div>
    <div class="load-track">
        <div class="load-fill" id="loadFill"></div>
    </div>
    <div class="load-pct" id="loadPct">0%</div>
    <div class="load-status" id="loadStatus">Memuat sumber daya...</div>
</div>

<div class="app">

    {{-- TOPBAR --}}
    <header class="topbar">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-mark">🤟</div>
            <span class="logo-name">SI<em>BI</em></span>
        </a>
        <div class="top-divider"></div>
        <span class="top-tag">Bahasa Isyarat Indonesia</span>
        <div class="top-spacer"></div>
        <div class="top-actions">
            @auth
            <span style="font-size:12px;color:var(--text2);font-weight:500">
                <i class="fas fa-user-circle" style="margin-right:4px;color:var(--accent)"></i>
                {{ Auth::user()->name }}
            </span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn" style="font-size:12px;padding:6px 12px">
                    <i class="fas fa-sign-out-alt" style="font-size:10px"></i> Keluar
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn" style="font-size:12px;padding:6px 12px">
                <i class="fas fa-sign-in-alt" style="font-size:10px"></i> Masuk
            </a>
            <button onclick="openAdminModal()" class="btn btn-green" style="font-size:12px;padding:6px 12px">
                <i class="fas fa-shield-alt" style="font-size:10px"></i> Admin
            </button>
            @endauth
        </div>
    </header>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <span class="sb-label">Belajar</span>
        @php
        $modules = [
            ['angka',    '🔢', 'Angka'],
            ['keluarga', '👪', 'Keluarga'],
            ['benda',    '🧸', 'Benda'],
        ];
        @endphp
        @foreach($modules as [$kat, $ico, $nama])
        @php $cnt = \App\Models\KontenSibi::where('kategori',$kat)->count(); @endphp
        <a href="{{ route('modul.show', $kat) }}"
           class="nav-item {{ request('kategori')===$kat ? 'active' : '' }}">
            <div class="nav-icon">{{ $ico }}</div>
            {{ $nama }}
            @if($cnt)<span class="nav-badge">{{ $cnt }}</span>@endif
        </a>
        @endforeach

        <span class="sb-label">Tantangan</span>
        <a href="{{ route('kuis.index') }}" class="nav-item {{ request()->routeIs('kuis.*') ? 'active' : '' }}">
            <div class="nav-icon">🏆</div>
            Kuis Interaktif
            <span class="nav-badge">5 lv</span>
        </a>

        <div class="sb-footer">
            <div class="sb-tip">
                <strong>💡 Tips Belajar</strong>
                Ulangi setiap isyarat 3× untuk lebih mudah diingat!
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="main">
        @if(session('success'))
        <div class="toast-area">
            <div class="toast toast-s" id="ts">
                <div class="toast-ico"><i class="fas fa-check"></i></div>
                <span class="toast-msg">{{ session('success') }}</span>
                <button class="toast-x" onclick="this.closest('.toast').remove()">&times;</button>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="toast-area">
            <div class="toast toast-e" id="te">
                <div class="toast-ico"><i class="fas fa-times"></i></div>
                <span class="toast-msg">{{ session('error') }}</span>
                <button class="toast-x" onclick="this.closest('.toast').remove()">&times;</button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

</div>

{{-- ADMIN LOGIN MODAL --}}
@guest
<div id="admin-modal" class="modal-bg hidden" onclick="if(event.target===this)closeAdminModal()">
    <div class="modal-box">
        <div style="text-align:center;margin-bottom:26px">
            <div style="width:52px;height:52px;background:var(--accent);border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 12px">🔐</div>
            <div style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:700;color:var(--text)">Masuk ke Panel Admin</div>
            <div style="font-size:12px;color:var(--text2);margin-top:3px">Akses khusus pengelola SLB</div>
        </div>
        @if($errors->any())
        <div style="background:var(--red-light);border:1px solid rgba(176,58,46,.2);border-radius:var(--r-sm);padding:10px 13px;margin-bottom:16px">
            @foreach($errors->all() as $e)
            <p style="color:var(--red);font-size:12px;font-weight:500;margin:0 0 2px;display:flex;align-items:center;gap:5px">
                <i class="fas fa-exclamation-circle" style="font-size:10px"></i> {{ $e }}
            </p>
            @endforeach
        </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom:12px">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@slb.id" class="form-input" required>
            </div>
            <div style="margin-bottom:20px">
                <label class="form-label">Password</label>
                <div style="position:relative">
                    <input type="password" name="password" id="adm-pw" placeholder="••••••••" class="form-input" style="padding-right:38px" required>
                    <button type="button" onclick="togglePw()" style="position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text3);font-size:13px">
                        <i id="adm-eye" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-green" style="width:100%;justify-content:center;padding:11px">
                <i class="fas fa-sign-in-alt" style="font-size:11px"></i> Masuk ke Panel Admin
            </button>
        </form>
        <button onclick="closeAdminModal()" style="width:100%;margin-top:8px;padding:10px;border-radius:var(--r-sm);border:1px solid var(--border);background:transparent;color:var(--text2);font-family:'DM Sans',sans-serif;font-weight:500;font-size:13px;cursor:pointer">Batal</button>
    </div>
</div>
@endguest

@stack('scripts')
<script>
/* ── SPLASH + LOADING LOGIC ── */
(function(){
    const splash  = document.getElementById('sibi-splash');
    const loading = document.getElementById('sibi-loading');
    const fill    = document.getElementById('loadFill');
    const pct     = document.getElementById('loadPct');
    const status  = document.getElementById('loadStatus');

    const msgs = [
        'Memuat sumber daya...',
        'Menyiapkan konten isyarat...',
        'Menghubungkan database...',
        'Hampir siap...',
        'Selesai!'
    ];

    /* Cek apakah splash sudah pernah ditampilkan di sesi ini */
    const shown = sessionStorage.getItem('sibi_splash_done');

    if(shown){
        splash.style.display  = 'none';
        loading.style.display = 'none';
        return;
    }

    /* Tampilkan splash 1.8 detik lalu beralih ke loading */
    setTimeout(function(){
        splash.classList.add('hide');
        loading.classList.add('show');

        let p = 0;
        const t = setInterval(function(){
            p += Math.random() * 9 + 4;
            if(p > 100) p = 100;
            fill.style.width = p + '%';
            pct.textContent  = Math.round(p) + '%';
            status.textContent = msgs[Math.min(Math.floor(p / 25), 4)];
            if(p >= 100){
                clearInterval(t);
                setTimeout(function(){
                    loading.classList.remove('show');
                    sessionStorage.setItem('sibi_splash_done','1');
                }, 500);
            }
        }, 110);
    }, 1800);
})();

/* ── ADMIN MODAL ── */
function openAdminModal(){document.getElementById('admin-modal')?.classList.remove('hidden');document.body.style.overflow='hidden'}
function closeAdminModal(){document.getElementById('admin-modal')?.classList.add('hidden');document.body.style.overflow=''}
function togglePw(){const i=document.getElementById('adm-pw'),e=document.getElementById('adm-eye');i.type=i.type==='password'?'text':'password';e.className='fas fa-'+(i.type==='password'?'eye':'eye-slash')}
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeAdminModal();});
@if($errors->any()) document.addEventListener('DOMContentLoaded',()=>openAdminModal()); @endif
setTimeout(()=>document.getElementById('ts')?.remove(),4500);
setTimeout(()=>document.getElementById('te')?.remove(),4500);
</script>
</body>
</html>
