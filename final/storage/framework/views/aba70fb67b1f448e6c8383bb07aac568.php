<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title','SIBI Belajar'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg:#EEF4FB; --surface:#fff; --card:#fff;
            --border:#D1E3F8; --border2:#AACBF0;
            --text:#0D1B2E; --text2:#4A637E; --text3:#8BA5BF;
            --accent:#1A4F8B; --accent2:#2563B0;
            --accent-light:#DBEAFE; --accent-light2:#BFDBFE;
            --dark:#071428; --navy:#0D2A5E;
            --red:#DC2626; --red-light:#FEF2F2;
            --green:#16A34A; --green-light:#DCFCE7;
            --yellow:#D97706; --yellow-light:#FFFBEB;
            --shadow-sm:0 1px 4px rgba(26,79,139,.08);
            --shadow:0 4px 20px rgba(26,79,139,.12);
            --shadow-lg:0 12px 40px rgba(26,79,139,.18);
            --r:16px; --r-sm:10px; --r-lg:22px; --r-xl:28px;
            --nav-h:70px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased;overscroll-behavior:none}

        /* SPLASH */
        #splash{position:fixed;inset:0;z-index:9999;background:linear-gradient(160deg,var(--dark) 0%,var(--navy) 60%,#1A4F8B 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity .5s,visibility .5s}
        #splash.hide{opacity:0;visibility:hidden;pointer-events:none}
        .sp-ring{width:120px;height:120px;border-radius:50%;border:2px solid rgba(96,165,250,.25);display:flex;align-items:center;justify-content:center;animation:pulse 2s ease infinite}
        .sp-inner{width:82px;height:82px;border-radius:50%;background:rgba(96,165,250,.15);border:1.5px solid rgba(96,165,250,.4);display:flex;align-items:center;justify-content:center;font-size:36px}
        @keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.07);opacity:.8}}
        .sp-title{font-family:'Outfit',sans-serif;font-size:34px;font-weight:900;color:#fff;letter-spacing:-1px;margin-top:20px}
        .sp-title em{color:#60a5fa;font-style:normal}
        .sp-sub{font-size:11px;color:rgba(255,255,255,.4);letter-spacing:2px;text-transform:uppercase;margin-top:5px}
        .sp-dots{display:flex;gap:7px;margin-top:30px}
        .sp-dot{width:8px;height:8px;border-radius:50%;background:rgba(96,165,250,.25);animation:blink 1.4s ease infinite}
        .sp-dot:nth-child(2){animation-delay:.22s}
        .sp-dot:nth-child(3){animation-delay:.44s}
        @keyframes blink{0%,80%,100%{background:rgba(96,165,250,.25)}40%{background:#60a5fa}}

        /* LOGIN SLIDE - full screen overlay */
        #login-slide{position:fixed;inset:0;z-index:9000;background:linear-gradient(160deg,var(--dark) 0%,var(--navy) 60%,#1A4F8B 100%);display:flex;flex-direction:column;align-items:center;justify-content:flex-end;transform:translateY(100%);transition:transform .5s cubic-bezier(.32,0,.67,0);visibility:hidden}
        #login-slide.show{transform:translateY(0);visibility:visible}
        .ls-top{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px 24px 0;text-align:center;width:100%}
        .ls-icon{font-size:64px;margin-bottom:16px;animation:floatY 3s ease-in-out infinite}
        @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        .ls-title{font-family:'Outfit',sans-serif;font-size:30px;font-weight:900;color:#fff;letter-spacing:-1px;line-height:1.1;margin-bottom:8px}
        .ls-title em{color:#60a5fa;font-style:normal}
        .ls-desc{color:rgba(255,255,255,.6);font-size:13px;line-height:1.6;max-width:280px}
        .ls-sheet{background:#fff;border-radius:28px 28px 0 0;padding:28px 24px 40px;width:100%;box-shadow:0 -20px 60px rgba(0,0,0,.3)}
        .ls-pill{width:40px;height:4px;background:#E5E7EB;border-radius:99px;margin:0 auto 24px}
        .ls-tabs{display:flex;background:#F1F5F9;border-radius:12px;padding:4px;gap:4px;margin-bottom:22px}
        .ls-tab{flex:1;padding:10px;border-radius:9px;font-family:'Outfit',sans-serif;font-weight:700;font-size:14px;text-align:center;cursor:pointer;transition:all .2s;border:none;background:transparent;color:#94A3B8}
        .ls-tab.active{background:#fff;color:var(--accent);box-shadow:var(--shadow-sm)}
        .ls-input{width:100%;padding:13px 16px;border:1.5px solid #E2E8F0;border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:var(--text);outline:none;transition:all .2s;margin-bottom:12px;background:#F8FAFC}
        .ls-input:focus{border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px var(--accent-light)}
        .ls-btn{width:100%;padding:14px;border-radius:14px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-family:'Outfit',sans-serif;font-weight:700;font-size:16px;border:none;cursor:pointer;transition:all .2s;margin-top:4px}
        .ls-btn:hover{transform:translateY(-1px);box-shadow:var(--shadow)}
        .ls-err{background:#FEF2F2;border:1px solid #FECACA;border-radius:10px;padding:10px 14px;margin-bottom:12px;color:#DC2626;font-size:12px;font-weight:600;display:flex;align-items:center;gap:7px}
        .ls-skip{text-align:center;margin-top:14px;font-size:13px;color:var(--text3)}
        .ls-skip a{color:var(--accent);font-weight:700;text-decoration:none}

        /* TOP BAR */
        .topbar{position:sticky;top:0;z-index:100;background:var(--surface);border-bottom:1px solid var(--border);height:56px;display:flex;align-items:center;padding:0 16px;gap:12px;box-shadow:var(--shadow-sm)}
        .logo{display:flex;align-items:center;gap:8px;text-decoration:none}
        .logo-mark{width:32px;height:32px;background:var(--accent);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px}
        .logo-name{font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;color:var(--text);letter-spacing:-.3px}
        .logo-name em{color:var(--accent);font-style:normal}
        .top-spacer{flex:1}
        .top-user-btn{display:flex;align-items:center;gap:8px;background:var(--accent-light);border:1px solid var(--accent-light2);border-radius:99px;padding:5px 12px 5px 5px;text-decoration:none;cursor:pointer}
        .top-av{width:26px;height:26px;border-radius:50%;background:var(--accent);color:#fff;font-family:'Outfit',sans-serif;font-weight:800;font-size:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .top-uname{font-size:12px;font-weight:700;color:var(--accent);max-width:80px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}

        /* MAIN CONTENT */
        .main-content{padding:16px 20px calc(var(--nav-h) + 16px);min-height:calc(100vh - 56px);max-width:960px;margin:0 auto}

        /* BOTTOM NAV (Shopee-style) */
        .bottom-nav{position:fixed;bottom:0;left:0;right:0;z-index:200;background:var(--surface);border-top:1px solid var(--border);height:var(--nav-h);display:flex;align-items:stretch;box-shadow:0 -4px 20px rgba(26,79,139,.1);padding-bottom:env(safe-area-inset-bottom)}
        .nav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:4px;text-decoration:none;color:var(--text3);transition:all .2s;position:relative;border:none;background:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;padding:8px 4px}
        .nav-item.active{color:var(--accent)}
        .nav-item.active .nav-icon-wrap{background:var(--accent-light);transform:scale(1.1)}
        .nav-icon-wrap{width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;transition:all .2s;margin-bottom:1px}
        .nav-ico{font-size:18px;line-height:1}
        .nav-lbl{font-size:10px;font-weight:700;letter-spacing:.2px}

        /* CARDS */
        .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:20px}
        .card-sm{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-sm);padding:14px}

        /* BTN */
        .btn-pri{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 24px;border-radius:14px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-family:'Outfit',sans-serif;font-weight:700;font-size:15px;text-decoration:none;border:none;cursor:pointer;transition:all .2s;width:100%}
        .btn-pri:hover{transform:translateY(-1px);box-shadow:var(--shadow)}
        .btn-sec{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 20px;border-radius:14px;background:var(--accent-light);color:var(--accent);font-family:'Outfit',sans-serif;font-weight:700;font-size:14px;text-decoration:none;border:1px solid var(--accent-light2);cursor:pointer;transition:all .2s}

        /* PROGRESS BAR */
        .prog-bar{height:8px;background:var(--border);border-radius:99px;overflow:hidden}
        .prog-fill{height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:99px;transition:width .8s cubic-bezier(.34,1,.64,1)}

        /* BADGE */
        .badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700}

        /* TOAST */
        .toast-area{position:fixed;top:66px;left:50%;transform:translateX(-50%);z-index:500;width:calc(100% - 32px);max-width:400px}
        .toast{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:14px;box-shadow:var(--shadow-lg);background:var(--surface);border:1px solid var(--border);animation:tIn .3s cubic-bezier(.34,1.4,.64,1) both;margin-bottom:8px}
        .toast-s{border-left:3px solid var(--green)}
        .toast-e{border-left:3px solid var(--red)}
        @keyframes tIn{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:none}}

        /* ANIM */
        @keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:none}}
        .fu{animation:fadeUp .4s ease both}
        .d1{animation-delay:.06s}.d2{animation-delay:.12s}.d3{animation-delay:.18s}.d4{animation-delay:.24s}.d5{animation-delay:.30s}

        ::-webkit-scrollbar{width:4px}
        ::-webkit-scrollbar-thumb{background:var(--border2);border-radius:99px}
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<div id="splash">
    <div class="sp-ring">
        <div class="sp-inner">🤟</div>
    </div>
    <div class="sp-title">SI<em>BI</em></div>
    <div class="sp-sub">Bahasa Isyarat Indonesia</div>
    <div class="sp-dots">
        <div class="sp-dot"></div><div class="sp-dot"></div><div class="sp-dot"></div>
    </div>
</div>


<?php if(auth()->guard()->guest()): ?>
<div id="login-slide">
    <div class="ls-top">
        <div class="ls-icon">🤟</div>
        <div class="ls-title">Belajar<br><em>Bahasa Isyarat</em><br>Bareng!</div>
        <div class="ls-desc">Platform belajar SIBI untuk anak tunarungu. Gratis dan mudah digunakan.</div>
    </div>
    <div class="ls-sheet">
        <div class="ls-pill"></div>
        <div class="ls-tabs">
            <button class="ls-tab active" onclick="switchTab('masuk')">Masuk</button>
            <button class="ls-tab" onclick="switchTab('daftar')">Daftar</button>
        </div>

        
        <?php if($errors->any()): ?>
        <div class="ls-err"><i class="fas fa-exclamation-circle"></i> <?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        
        <div id="tab-masuk">
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="Email" class="ls-input" value="<?php echo e(old('email')); ?>" required>
                <input type="password" name="password" placeholder="Password" class="ls-input" required>
                <button type="submit" class="ls-btn">Masuk 🚀</button>
            </form>
        </div>

        
        <div id="tab-daftar" style="display:none">
            <form action="<?php echo e(route('register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="text" name="name" placeholder="Nama lengkap" class="ls-input" value="<?php echo e(old('name')); ?>" required>
                <input type="text" name="kelas" placeholder="Kelas (opsional, cth: 5A)" class="ls-input" value="<?php echo e(old('kelas')); ?>">
                <input type="email" name="email" placeholder="Email" class="ls-input" value="<?php echo e(old('email')); ?>" required>
                <input type="password" name="password" placeholder="Password (min. 6 karakter)" class="ls-input" required>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" class="ls-input" required>
                <button type="submit" class="ls-btn">Daftar Sekarang ✨</button>
            </form>
        </div>

        <div class="ls-skip">Mau lihat-lihat dulu? <a href="#" onclick="dismissLogin()">Lewati →</a></div>
    </div>
</div>
<?php endif; ?>


<header class="topbar">
    <a href="<?php echo e(route('home')); ?>" class="logo">
        <div class="logo-mark">🤟</div>
        <span class="logo-name">SI<em>BI</em></span>
    </a>
    <div class="top-spacer"></div>
    <?php if(auth()->guard()->check()): ?>
    <a href="<?php echo e(route('siswa.profil')); ?>" class="top-user-btn">
        <div class="top-av"><?php echo e(strtoupper(substr(Auth::user()->name,0,1))); ?></div>
        <span class="top-uname"><?php echo e(Auth::user()->name); ?></span>
    </a>
    <?php else: ?>
    <button onclick="openLogin()" style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:99px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-family:'Outfit',sans-serif;font-weight:700;font-size:12px;border:none;cursor:pointer">
        <i class="fas fa-sign-in-alt" style="font-size:10px"></i> Masuk
    </button>
    <?php endif; ?>
</header>


<?php if(session('success')): ?>
<div class="toast-area"><div class="toast toast-s" id="ts"><i class="fas fa-check" style="color:var(--green)"></i><span style="font-size:13px;font-weight:600;color:var(--text);flex:1"><?php echo e(session('success')); ?></span><button onclick="this.closest('.toast').remove()" style="background:none;border:none;cursor:pointer;color:var(--text3);font-size:16px">&times;</button></div></div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="toast-area"><div class="toast toast-e" id="te"><i class="fas fa-times" style="color:var(--red)"></i><span style="font-size:13px;font-weight:600;color:var(--text);flex:1"><?php echo e(session('error')); ?></span><button onclick="this.closest('.toast').remove()" style="background:none;border:none;cursor:pointer;color:var(--text3);font-size:16px">&times;</button></div></div>
<?php endif; ?>


<main class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<nav class="bottom-nav">
    <?php
    $navItems = [
        ['route'=>'home',       'ico'=>'🏠','lbl'=>'Beranda', 'match'=>'home'],
        ['route'=>'modul.show', 'ico'=>'📖','lbl'=>'Belajar', 'match'=>'modul.*','param'=>'angka'],
        ['route'=>'kuis.index', 'ico'=>'🏆','lbl'=>'Kuis',    'match'=>'kuis.*'],
    ];
    ?>
    <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $isActive = request()->routeIs($nav['match']);
        $url = isset($nav['param']) ? route($nav['route'], $nav['param']) : route($nav['route']);
    ?>
    <?php if($nav['route'] === 'siswa.dashboard' && !Auth::check()): ?>
        <button onclick="openLogin()" class="nav-item <?php echo e($isActive ? 'active':''); ?>">
            <div class="nav-icon-wrap"><span class="nav-ico"><?php echo e($nav['ico']); ?></span></div>
            <span class="nav-lbl"><?php echo e($nav['lbl']); ?></span>
        </button>
    <?php else: ?>
        <a href="<?php echo e($url); ?>" class="nav-item <?php echo e($isActive ? 'active':''); ?>">
            <div class="nav-icon-wrap"><span class="nav-ico"><?php echo e($nav['ico']); ?></span></div>
            <span class="nav-lbl"><?php echo e($nav['lbl']); ?></span>
        </a>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(auth()->guard()->check()): ?>
    <form action="<?php echo e(route('logout')); ?>" method="POST" style="flex:1;display:contents">
        <?php echo csrf_field(); ?>
        <button type="submit" class="nav-item">
            <div class="nav-icon-wrap"><span class="nav-ico">🚪</span></div>
            <span class="nav-lbl">Keluar</span>
        </button>
    </form>
    <?php endif; ?>
</nav>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script>
(function(){
    const splash = document.getElementById('splash');
    const shown  = sessionStorage.getItem('sibi_splash');
    if(shown){ splash.style.display='none'; return; }
    setTimeout(()=>{
        splash.classList.add('hide');
        sessionStorage.setItem('sibi_splash','1');
        // Show login slide after splash for guests
        <?php if(auth()->guard()->guest()): ?>
        if(!sessionStorage.getItem('sibi_login_dismissed')){
            setTimeout(()=>{ openLogin(); }, 400);
        }
        <?php endif; ?>
    }, 2000);
})();

function openLogin(){
    const s = document.getElementById('login-slide');
    if(s){ s.classList.add('show'); document.body.style.overflow='hidden'; }
}
function dismissLogin(){
    const s = document.getElementById('login-slide');
    if(s){ s.classList.remove('show'); document.body.style.overflow=''; }
    sessionStorage.setItem('sibi_login_dismissed','1');
}
function switchTab(t){
    document.getElementById('tab-masuk').style.display = t==='masuk'?'block':'none';
    document.getElementById('tab-daftar').style.display = t==='daftar'?'block':'none';
    document.querySelectorAll('.ls-tab').forEach((el,i)=>el.classList.toggle('active', (t==='masuk'&&i===0)||(t==='daftar'&&i===1)));
}
<?php if($errors->has('email') || $errors->any()): ?> openLogin(); <?php endif; ?>
setTimeout(()=>document.getElementById('ts')?.remove(),4000);
setTimeout(()=>document.getElementById('te')?.remove(),4000);
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\final\resources\views/layouts/siswa.blade.php ENDPATH**/ ?>