<?php $__env->startSection('title','Dashboard — SIBI'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ── WELCOME BANNER ── */
.welcome-banner{
    background:linear-gradient(135deg,#1e3a5f 0%,#2a5298 55%,#2d7dd2 100%);
    border-radius:var(--r-lg);padding:28px 32px;margin-bottom:26px;
    position:relative;overflow:hidden;
}
.wb-deco{position:absolute;border-radius:50%;pointer-events:none}
.wb-greet{color:rgba(255,255,255,.6);font-size:12px;font-weight:600;margin-bottom:5px;display:flex;align-items:center;gap:6px}
.wb-name{font-family:'Outfit',sans-serif;font-size:26px;font-weight:800;color:#fff;letter-spacing:-.5px;line-height:1.1}
.wb-sub{color:rgba(255,255,255,.65);font-size:13px;margin-top:6px;line-height:1.5}
.wb-stats{display:flex;gap:24px;margin-top:18px;flex-wrap:wrap}
.wb-stat-num{font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:#fff;line-height:1}
.wb-stat-lbl{font-size:10px;color:rgba(255,255,255,.55);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-top:2px}
.wb-divider{width:1px;background:rgba(255,255,255,.2);align-self:stretch;flex-shrink:0}

/* ── SECTION HEAD ── */
.sec-hd{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:14px}
.sec-title{font-family:'Outfit',sans-serif;font-size:17px;font-weight:700;color:var(--text);letter-spacing:-.2px}
.sec-sub{font-size:12px;color:var(--text3);margin-top:2px}
.see-all{font-size:12px;color:var(--accent);font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:5px}
.see-all:hover{text-decoration:underline}

/* ── MENU CARDS ── */
.menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-bottom:26px}
.menu-card{
    background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r);padding:18px;
    display:flex;align-items:center;gap:14px;
    text-decoration:none;transition:all .15s;
}
.menu-card:hover{border-color:var(--accent-light2);background:var(--accent-light);transform:translateY(-2px);box-shadow:var(--shadow)}
.menu-ico{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;transition:transform .2s}
.menu-card:hover .menu-ico{transform:scale(1.1)}
.menu-name{font-weight:700;font-size:14px;color:var(--text);margin-bottom:3px}
.menu-desc{font-size:12px;color:var(--text3);line-height:1.4}

/* ── RECENT ACTIVITY ── */
.activity-list{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);overflow:hidden}
.act-item{display:flex;align-items:center;gap:14px;padding:13px 16px;border-bottom:1px solid var(--border)}
.act-item:last-child{border-bottom:none}
.act-ico{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.act-title{font-size:13px;font-weight:600;color:var(--text)}
.act-sub{font-size:11px;color:var(--text3);margin-top:2px}
.act-badge{margin-left:auto;flex-shrink:0}

/* ── RESPONSIVE ── */
@media(max-width:700px){
    .wb-stats{gap:14px}
    .menu-grid{grid-template-columns:1fr 1fr}
    .welcome-banner{padding:20px}
}
@media(max-width:400px){
    .menu-grid{grid-template-columns:1fr}
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="welcome-banner fu">
    <div class="wb-deco" style="width:280px;height:280px;background:rgba(255,255,255,.04);top:-120px;right:-60px"></div>
    <div class="wb-deco" style="width:160px;height:160px;background:rgba(255,255,255,.04);bottom:-70px;left:-40px"></div>

    <div style="position:relative;z-index:2">
        <div class="wb-greet">
            <div style="width:7px;height:7px;border-radius:50%;background:#4ADE80;box-shadow:0 0 7px #4ADE80"></div>
            Selamat datang kembali 👋
        </div>
        <div class="wb-name"><?php echo e(Auth::user()->name); ?></div>
        <div class="wb-sub">Terus semangat belajar bahasa isyarat! Konsistensi adalah kunci.</div>

        <div class="wb-stats">
            <div>
                <div class="wb-stat-num"><?php echo e($modulSelesai ?? 0); ?></div>
                <div class="wb-stat-lbl">Modul Selesai</div>
            </div>
            <div class="wb-divider"></div>
            <div>
                <div class="wb-stat-num"><?php echo e($skorRata ?? 0); ?>%</div>
                <div class="wb-stat-lbl">Skor Rata-rata</div>
            </div>
            <div class="wb-divider"></div>
            <div>
                <div class="wb-stat-num"><?php echo e($kuisSelesai ?? 0); ?></div>
                <div class="wb-stat-lbl">Kuis Selesai</div>
            </div>
        </div>
    </div>
</div>


<div class="sec-hd">
    <div>
        <div class="sec-title">Menu Belajar</div>
        <div class="sec-sub">Pilih topik isyarat yang ingin kamu pelajari</div>
    </div>
</div>

<div class="menu-grid">
    <?php $__currentLoopData = [
        [route('modul.show','angka'),   '🔢','#DBEAFE','#1A4F8B','Modul Angka',        'Belajar isyarat angka 0–20'],
        [route('modul.show','keluarga'),'🫂','#DCFCE7','#16A34A','Keluarga',           'Isyarat anggota keluarga'],
        [route('modul.show','benda'),   '📚','#F3E8FF','#7C3AED','Benda Sehari-hari',  'Benda di sekitar kita'],
        [route('modul.show','sapaan'),  '👋','#EEF4FB','#2563EB','Kata Sapaan',        'Perkenalan & salam'],
        [route('kuis.index'),           '🏆','#FFF7ED','#D97706','Kuis Interaktif',    'Uji kemampuan isyaratmu'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => [$url,$ico,$bg,$col,$name,$desc]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e($url); ?>" class="menu-card fu d<?php echo e($i+1); ?>">
        <div class="menu-ico" style="background:<?php echo e($bg); ?>"><?php echo e($ico); ?></div>
        <div style="flex:1;min-width:0">
            <div class="menu-name"><?php echo e($name); ?></div>
            <div class="menu-desc"><?php echo e($desc); ?></div>
        </div>
        <i class="fas fa-chevron-right" style="color:<?php echo e($col); ?>;font-size:11px;flex-shrink:0;opacity:.7"></i>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="sec-hd">
    <div>
        <div class="sec-title">Aktivitas Terakhir</div>
        <div class="sec-sub">Riwayat kuis kamu</div>
    </div>
    <a href="<?php echo e(route('kuis.index')); ?>" class="see-all">
        Lihat Semua <i class="fas fa-arrow-right" style="font-size:10px"></i>
    </a>
</div>

<div class="activity-list fu d2">
    <?php $__empty_1 = true; $__currentLoopData = $recentKuis ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="act-item">
        <div class="act-ico" style="background:var(--yellow-light)">🏆</div>
        <div>
            <div class="act-title">Kuis Level <?php echo e($k->level); ?></div>
            <div class="act-sub"><?php echo e($k->created_at->diffForHumans()); ?></div>
        </div>
        <div class="act-badge">
            <span style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;color:<?php echo e(($k->skor ?? 0) >= 70 ? 'var(--accent)' : 'var(--yellow)'); ?>">
                <?php echo e($k->skor ?? round($k->benar / $k->total_soal * 100)); ?>%
            </span>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div style="padding:40px;text-align:center">
        <div style="font-size:32px;margin-bottom:10px">📋</div>
        <div style="font-weight:700;font-size:14px;color:var(--text);margin-bottom:4px">Belum Ada Aktivitas</div>
        <div style="font-size:12px;color:var(--text3)">Mulai kerjakan kuis untuk melihat riwayat kamu.</div>
        <a href="<?php echo e(route('kuis.index')); ?>"
            style="display:inline-flex;align-items:center;gap:6px;margin-top:12px;padding:8px 16px;background:var(--accent);color:#fff;border-radius:var(--r-sm);font-size:12px;font-weight:600;text-decoration:none">
            <i class="fas fa-play" style="font-size:10px"></i> Mulai Kuis
        </a>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.siswa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\final\resources\views/frontend/siswa/dashboard.blade.php ENDPATH**/ ?>