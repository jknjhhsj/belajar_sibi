<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title','Dashboard'); ?> — Panel Kepala Sekolah SIBI</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{
            --bg:#F4F6F9;--surf:#FFFFFF;--card:#FFFFFF;
            --border:#E5E9F0;--border2:#D0D7E3;
            --text:#1A202C;--text2:#4A5568;--text3:#8A94A6;
            --accent:#1A4F8B;--accent2:#2563B0;--accent-light:#DBEAFE;--accent-light2:#BFDBFE;
            --red:#DC2626;--red-light:#FEF2F2;
            --yellow:#D97706;--yellow-light:#FFFBEB;
            --blue:#2563EB;--blue-light:#EFF6FF;
            --purple:#7C3AED;--purple-light:#F5F3FF;
            --shadow-sm:0 1px 3px rgba(0,0,0,.06),0 1px 2px rgba(0,0,0,.04);
            --shadow:0 4px 16px rgba(0,0,0,.07),0 2px 6px rgba(0,0,0,.04);
            --shadow-lg:0 10px 32px rgba(0,0,0,.09),0 4px 12px rgba(0,0,0,.05);
            --r:12px;--r-sm:8px;--r-lg:18px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;-webkit-font-smoothing:antialiased}

        /* ── LAYOUT ── */
        .adm-wrap{display:flex;min-height:100vh}

        /* ── SIDEBAR ── */
        .sidebar{
            width:256px;min-height:100vh;
            background:var(--surf);
            border-right:1px solid var(--border);
            position:fixed;left:0;top:0;z-index:50;
            display:flex;flex-direction:column;
            transition:transform .28s cubic-bezier(.4,0,.2,1);
        }

        /* Logo */
        .sb-logo{
            padding:18px 16px 16px;
            border-bottom:1px solid var(--border);
            display:flex;align-items:center;gap:11px;
            text-decoration:none;flex-shrink:0;
        }
        .sb-logo-mark{
            width:40px;height:40px;
            background:var(--accent);
            border-radius:11px;
            display:flex;align-items:center;justify-content:center;
            font-size:20px;flex-shrink:0;
            box-shadow:0 4px 12px rgba(26,79,139,.3);
        }
        .sb-logo-name{font-family:'Outfit',sans-serif;font-size:18px;font-weight:800;color:var(--text);letter-spacing:-.3px;line-height:1}
        .sb-logo-sub{font-size:10px;font-weight:600;color:var(--text3);margin-top:2px;letter-spacing:.2px}

        /* User chip */
        .sb-user{
            margin:12px 12px 4px;
            background:var(--accent-light);
            border:1px solid var(--accent-light2);
            border-radius:var(--r);
            padding:11px 12px;
            display:flex;align-items:center;gap:10px;
            flex-shrink:0;
        }
        .sb-user-av{
            width:36px;height:36px;border-radius:10px;
            background:var(--accent);
            display:flex;align-items:center;justify-content:center;
            font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;
            color:#fff;flex-shrink:0;
        }
        .sb-user-name{font-weight:700;font-size:13px;color:var(--text);line-height:1.2}
        .sb-user-role{font-size:10px;font-weight:600;color:var(--accent);margin-top:2px}
        .sb-user-dot{width:7px;height:7px;border-radius:50%;background:#60a5fa;box-shadow:0 0 6px #60a5fa;margin-left:auto;flex-shrink:0}

        /* Nav */
        nav.sb-nav{padding:8px 10px;flex:1;overflow-y:auto}
        .sb-cat{
            font-size:9.5px;font-weight:700;letter-spacing:1.2px;
            text-transform:uppercase;color:var(--text3);
            padding:2px 8px;margin:16px 0 5px;display:block;
        }
        .sb-cat:first-child{margin-top:4px}
        .sl{
            display:flex;align-items:center;gap:9px;
            padding:8px 10px;border-radius:var(--r-sm);
            color:var(--text2);font-size:13px;font-weight:500;
            text-decoration:none;transition:all .14s;
            margin-bottom:1px;border:none;background:none;
            cursor:pointer;width:100%;font-family:'DM Sans',sans-serif;
            position:relative;
        }
        .sl:hover{background:var(--bg);color:var(--text)}
        .sl.active{background:var(--accent-light);color:var(--accent);font-weight:600}
        .sl.active::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:2.5px;background:var(--accent);border-radius:0 2px 2px 0}
        .sl-ico{
            width:30px;height:30px;border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            font-size:13px;flex-shrink:0;
            background:var(--bg);color:var(--text3);
            transition:all .14s;
        }
        .sl:hover .sl-ico{background:var(--border);color:var(--text2)}
        .sl.active .sl-ico{background:var(--accent-light2);color:var(--accent)}

        /* Logout */
        .sb-logout{padding:10px 12px;border-top:1px solid var(--border);flex-shrink:0}
        .sl-logout{color:var(--red)!important}
        .sl-logout:hover{background:var(--red-light)!important;color:var(--red)!important}
        .sl-logout .sl-ico{color:var(--red)!important;background:var(--red-light)!important}

        /* ── TOPBAR ── */
        .adm-topbar{
            background:var(--surf);
            border-bottom:1px solid var(--border);
            padding:0 24px;height:62px;
            display:flex;align-items:center;gap:14px;
            position:sticky;top:0;z-index:40;
            box-shadow:var(--shadow-sm);
        }
        .adm-topbar-title{font-family:'Outfit',sans-serif;font-size:17px;font-weight:700;color:var(--text);letter-spacing:-.2px}
        .adm-topbar-sub{font-size:11px;font-weight:500;color:var(--text3);margin-top:1px}

        /* ── MAIN ── */
        .adm-main{flex:1;margin-left:256px;display:flex;flex-direction:column;min-height:100vh}
        .adm-content{flex:1;padding:26px}

        /* ── INPUTS ── */
        .inp{
            width:100%;padding:10px 13px;
            border:1.5px solid var(--border);border-radius:var(--r-sm);
            background:var(--surf);font-family:'DM Sans',sans-serif;
            font-size:13.5px;font-weight:500;color:var(--text);
            transition:all .15s;outline:none;
        }
        .inp:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-light)}
        .inp::placeholder{color:var(--text3)}
        .inp option{background:#fff;color:var(--text)}

        /* ── BUTTONS ── */
        .btn-p{
            padding:9px 18px;border-radius:var(--r-sm);
            border:none;background:var(--accent);color:#fff;
            font-family:'DM Sans',sans-serif;font-weight:600;font-size:13px;
            cursor:pointer;transition:all .15s;
            display:inline-flex;align-items:center;gap:7px;
            box-shadow:0 2px 8px rgba(26,79,139,.25);
        }
        .btn-p:hover{background:var(--accent2);transform:translateY(-1px);box-shadow:0 4px 14px rgba(26,79,139,.3)}
        .btn-s{
            padding:8px 16px;border-radius:var(--r-sm);
            border:1.5px solid var(--border);background:var(--surf);
            color:var(--text2);font-family:'DM Sans',sans-serif;
            font-weight:500;font-size:13px;cursor:pointer;
            transition:all .15s;text-decoration:none;
            display:inline-flex;align-items:center;gap:6px;
        }
        .btn-s:hover{border-color:var(--border2);background:var(--bg);color:var(--text)}

        /* ── TABLE ── */
        .tbl{width:100%;font-size:13px;border-collapse:collapse}
        .tbl th{
            padding:10px 14px;text-align:left;
            font-size:10.5px;font-weight:700;color:var(--text3);
            text-transform:uppercase;letter-spacing:.6px;
            background:var(--bg);border-bottom:1px solid var(--border);
            white-space:nowrap;
        }
        .tbl td{padding:11px 14px;border-bottom:1px solid var(--border);color:var(--text2)}
        .tbl tr:last-child td{border-bottom:none}
        .tbl tbody tr:hover td{background:#FAFBFC}

        /* ── BADGE ── */
        .badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:99px;font-size:11px;font-weight:700}

        /* ── CARD ── */
        .adm-card{background:var(--surf);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--shadow-sm)}

        /* ── STAT CARD ── */
        .stat-card{
            background:var(--surf);border:1px solid var(--border);
            border-radius:var(--r-lg);padding:20px 22px;
            text-decoration:none;display:flex;align-items:center;gap:16px;
            transition:all .18s;box-shadow:var(--shadow-sm);
        }
        .stat-card:hover{transform:translateY(-2px);box-shadow:var(--shadow);border-color:var(--border2)}
        .stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
        .stat-num{font-family:'Outfit',sans-serif;font-size:28px;font-weight:800;color:var(--text);line-height:1}
        .stat-lbl{font-size:11.5px;font-weight:600;color:var(--text3);margin-top:3px;text-transform:uppercase;letter-spacing:.4px}
        .stat-trend{font-size:11px;font-weight:600;margin-top:4px;display:flex;align-items:center;gap:3px}

        /* ── FLASH ── */
        .flash-s{background:var(--accent-light);border:1.5px solid var(--accent-light2);border-radius:var(--r);padding:12px 16px;display:flex;align-items:center;gap:10px;margin-bottom:18px}
        .flash-e{background:var(--red-light);border:1.5px solid #FCA5A5;border-radius:var(--r);padding:12px 16px;display:flex;align-items:center;gap:10px;margin-bottom:18px}

        /* ── ANIM ── */
        @keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
        .fu{animation:fadeUp .35s ease both}
        .d1{animation-delay:.05s}.d2{animation-delay:.10s}.d3{animation-delay:.15s}.d4{animation-delay:.20s}.d5{animation-delay:.25s}

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar{width:4px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:var(--border2);border-radius:99px}

        /* ── MOBILE ── */
        @media(max-width:768px){
            .sidebar{transform:translateX(-100%)}
            .sidebar.open{transform:translateX(0)}
            .adm-main{margin-left:0!important}
            #sb-tog{display:flex!important}
        }
        #sb-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);z-index:49;backdrop-filter:blur(3px)}
        @media(max-width:768px){#sb-overlay.show{display:block}}

        /* Form helpers */
        .flbl{display:block;font-size:11px;font-weight:700;color:var(--text2);text-transform:uppercase;letter-spacing:.6px;margin-bottom:6px}
        .ferr{color:var(--red);font-size:12px;font-weight:600;margin-top:5px;display:flex;align-items:center;gap:4px}
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<div class="adm-wrap">

<div id="sb-overlay" onclick="closeSidebar()"></div>


<aside class="sidebar" id="sidebar">

    
    <a href="<?php echo e(route('home')); ?>" class="sb-logo">
        <div class="sb-logo-mark">🤟</div>
        <div>
            <div class="sb-logo-name">SIBI</div>
            <div class="sb-logo-sub">Panel Kepala Sekolah</div>
        </div>
    </a>

    
    <div class="sb-user">
        <div class="sb-user-av"><?php echo e(strtoupper(substr(Auth::user()->name ?? 'A', 0, 1))); ?></div>
        <div style="min-width:0">
            <div class="sb-user-name"><?php echo e(Str::limit(Auth::user()->name ?? 'Admin', 16)); ?></div>
            <div class="sb-user-role">Kepala Sekolah SLB</div>
        </div>
        <div class="sb-user-dot"></div>
    </div>

    
    <nav class="sb-nav">
        <span class="sb-cat">Menu Utama</span>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="sl <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <div class="sl-ico"><i class="fas fa-chart-bar"></i></div>
            Dashboard
        </a>

        <?php if(Route::has('admin.siswa.index')): ?>
        <span class="sb-cat">Pengguna</span>
        <a href="<?php echo e(route('admin.siswa.index')); ?>" class="sl <?php echo e(request()->routeIs('admin.siswa.*') ? 'active' : ''); ?>">
            <div class="sl-ico"><i class="fas fa-user-group"></i></div>
            Data Siswa
        </a>
        <?php endif; ?>

    </nav>

</aside>


<div class="adm-main" id="adm-main">

    
    <header class="adm-topbar">
        <button id="sb-tog" onclick="toggleSidebar()"
            style="display:none;background:var(--bg);border:1px solid var(--border);border-radius:var(--r-sm);padding:8px 11px;cursor:pointer;color:var(--text2);font-size:15px;flex-shrink:0">
            <i class="fas fa-bars"></i>
        </button>
        <div>
            <div class="adm-topbar-title"><?php echo $__env->yieldContent('page-title','Dashboard'); ?></div>
            <div class="adm-topbar-sub"><?php echo $__env->yieldContent('page-subtitle','Panel Kepala Sekolah SIBI'); ?></div>
        </div>
        <div style="margin-left:auto;display:flex;align-items:center;gap:10px">
            <div style="background:var(--bg);border:1px solid var(--border);border-radius:var(--r-sm);padding:7px 14px;font-size:12px;font-weight:600;color:var(--text3);display:flex;align-items:center;gap:7px">
                <i class="far fa-calendar-alt" style="color:var(--accent)"></i>
                <?php echo e(now()->translatedFormat('l, d F Y')); ?>

            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0">
                <?php echo csrf_field(); ?>
                <button type="submit" style="display:flex;align-items:center;gap:7px;padding:7px 14px;background:var(--red-light);border:1px solid #FCA5A5;border-radius:var(--r-sm);font-family:'DM Sans',sans-serif;font-size:12px;font-weight:600;color:var(--red);cursor:pointer;transition:all .15s;white-space:nowrap"
                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='var(--red-light)'">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    
    <div style="padding:0 26px">
        <?php if(session('success')): ?>
        <div class="flash-s fu" style="margin-top:18px">
            <div style="width:30px;height:30px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <i class="fas fa-check" style="color:#fff;font-size:11px"></i>
            </div>
            <span style="font-weight:600;color:var(--accent);font-size:13px"><?php echo e(session('success')); ?></span>
            <button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:var(--text3);font-size:18px;line-height:1">&times;</button>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="flash-e fu" style="margin-top:18px">
            <div style="width:30px;height:30px;background:var(--red);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <i class="fas fa-times" style="color:#fff;font-size:11px"></i>
            </div>
            <span style="font-weight:600;color:var(--red);font-size:13px"><?php echo e(session('error')); ?></span>
            <button onclick="this.parentElement.remove()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:var(--text3);font-size:18px;line-height:1">&times;</button>
        </div>
        <?php endif; ?>
    </div>

    <main class="adm-content"><?php echo $__env->yieldContent('content'); ?></main>
</div>

</div>

<script>
const sb  = document.getElementById('sidebar');
const ov  = document.getElementById('sb-overlay');
const tog = document.getElementById('sb-tog');

function checkMobile() {
    const m = window.innerWidth <= 768;
    if (tog) tog.style.display = m ? 'flex' : 'none';
    if (!m) { sb.classList.remove('open'); ov.classList.remove('show'); }
}
function toggleSidebar() { sb.classList.toggle('open'); ov.classList.toggle('show'); }
function closeSidebar()  { sb.classList.remove('open'); ov.classList.remove('show'); }

checkMobile();
window.addEventListener('resize', checkMobile);
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\final\resources\views/layouts/admin.blade.php ENDPATH**/ ?>