<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('page-title','Dashboard'); ?>
<?php $__env->startSection('page-subtitle'); ?>
Selamat datang, <?php echo e(Auth::user()->name ?? 'Admin'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.section-title{
    font-family:'Outfit',sans-serif;font-size:15px;font-weight:700;
    color:var(--text);margin-bottom:14px;
    display:flex;align-items:center;gap:8px;
}
.section-title::before{content:'';width:3px;height:16px;background:var(--accent);border-radius:99px;display:inline-block}

/* ══ QUICK ACTIONS ══ */
.qa-grid{display:grid;grid-template-columns:repeat(8,1fr);gap:10px}
.qa-btn{
    display:flex;flex-direction:column;align-items:center;gap:8px;
    padding:14px 8px;border-radius:var(--r);
    background:var(--surf);border:1px solid var(--border);
    text-decoration:none;transition:all .18s;cursor:pointer;
    font-family:'DM Sans',sans-serif;
}
.qa-btn:hover{border-color:var(--accent);background:var(--accent-light);transform:translateY(-3px);box-shadow:var(--shadow)}
.qa-icon{
    width:46px;height:46px;border-radius:12px;
    display:flex;align-items:center;justify-content:center;
    font-size:20px;flex-shrink:0;
    transition:transform .18s;
}
.qa-btn:hover .qa-icon{transform:scale(1.1)}
.qa-lbl{
    font-size:10.5px;font-weight:700;color:var(--text2);
    text-transform:uppercase;letter-spacing:.4px;
    text-align:center;line-height:1.3;
}

.chart-card{background:var(--surf);border:1px solid var(--border);border-radius:var(--r);padding:18px 20px}
.chart-title{font-family:'Outfit',sans-serif;font-size:13px;font-weight:700;color:var(--text);margin-bottom:14px;display:flex;align-items:center;gap:7px}

/* Fallback bar chart */
.bar-fallback{display:flex;align-items:flex-end;gap:6px;height:120px;padding:0 4px}
.bar-col{display:flex;flex-direction:column;align-items:center;gap:4px;flex:1}
.bar-fill{width:100%;border-radius:4px 4px 0 0;min-height:4px;transition:height .4s ease}
.bar-day{font-size:10px;color:var(--text3);font-weight:600;white-space:nowrap}
.bar-val{font-size:10px;font-weight:700;color:var(--text2)}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div style="background:linear-gradient(135deg,#0D2A5E,#1A4F8B);border-radius:var(--r-lg);padding:24px 30px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;gap:16px" class="fu">
    <div>
        <div style="color:rgba(255,255,255,.65);font-size:12px;font-weight:600;margin-bottom:6px;display:flex;align-items:center;gap:7px">
            <div style="width:7px;height:7px;border-radius:50%;background:#60a5fa;box-shadow:0 0 8px #60a5fa"></div>
            <?php echo e(now()->translatedFormat('l, d F Y')); ?>

        </div>
        <div style="font-family:'Outfit',sans-serif;color:#fff;font-size:24px;font-weight:800;line-height:1.2;letter-spacing:-.3px">
            Halo, <?php echo e(Auth::user()->name ?? 'Admin'); ?>! 👋
        </div>
        <div style="color:rgba(255,255,255,.65);font-size:13px;margin-top:6px;line-height:1.5">
            Kelola konten SIBI dan pantau aktivitas belajar siswa dari sini.
        </div>
    </div>

</div>


<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px">
<?php
$cards = [
    [route('guru.siswa.index'), '#EEF2FF', '#4338CA', 'fas fa-users',          'Total Siswa',     $stats['total_siswa'],    'Terdaftar di sistem'],
    [route('guru.konten.index'),'#E6F4ED', '#1A4F8B', 'fas fa-hand-paper',     'Konten SIBI',     $stats['total_konten'],   'Total konten isyarat'],
    [route('guru.kuis.index'),  '#FFFBEB', '#D97706', 'fas fa-question-circle','Soal Kuis',       $stats['total_soal'],     'Total bank soal'],
    ['#',                        '#FFF0F0', '#DC2626', 'fas fa-trophy',          'Kuis Dikerjakan', $stats['total_kuis'],     'Total pengerjaan siswa'],
];
?>
<?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => [$url,$bg,$color,$icon,$lbl,$val,$sub]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e($url); ?>" class="stat-card fu d<?php echo e($i+1); ?>">
    <div class="stat-icon" style="background:<?php echo e($bg); ?>">
        <i class="<?php echo e($icon); ?>" style="color:<?php echo e($color); ?>;font-size:19px"></i>
    </div>
    <div>
        <div class="stat-num"><?php echo e($val); ?></div>
        <div class="stat-lbl"><?php echo e($lbl); ?></div>
        <div class="stat-trend" style="color:<?php echo e($color); ?>">
            <i class="fas fa-circle" style="font-size:5px"></i> <?php echo e($sub); ?>

        </div>
    </div>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div style="margin-bottom:24px" class="fu d2">
    <div class="section-title">Aksi Cepat</div>
    <div class="qa-grid">
    <?php $__currentLoopData = [
        [route('guru.konten.create'),                     '#E6F4ED','#1A4F8B','fas fa-plus',      'Konten Baru'],
        [route('guru.kuis.create'),                       '#FFFBEB','#D97706','fas fa-question',   'Soal Baru'],
        [route('guru.konten.index').'?kategori=angka',    '#EDE9FE','#7C3AED','🔢',                'Angka'],
        [route('guru.konten.index').'?kategori=keluarga', '#E6F4ED','#059669','🫂',                'Keluarga'],
        [route('guru.konten.index').'?kategori=benda',    '#FEF3C7','#D97706','📚',                'Benda'],
        [route('guru.konten.index').'?kategori=sapaan',   '#EFF6FF','#2563EB','👋',                'Sapaan'],
        [route('guru.siswa.index'),                       '#F0FDF4','#16A34A','fas fa-user-group', 'Data Siswa'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$url,$bg,$color,$icon,$lbl]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e($url); ?>" class="qa-btn">
        <div class="qa-icon" style="background:<?php echo e($bg); ?>">
            <?php if(str_starts_with($icon,'fas')): ?>
                <i class="<?php echo e($icon); ?>" style="color:<?php echo e($color); ?>;font-size:18px"></i>
            <?php else: ?>
                <span style="font-size:22px;line-height:1"><?php echo e($icon); ?></span>
            <?php endif; ?>
        </div>
        <span class="qa-lbl" style="color:<?php echo e($color); ?>"><?php echo e($lbl); ?></span>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div style="margin-bottom:20px" class="fu d3">

    
    <div class="chart-card">
        <div class="chart-title">
            <i class="fas fa-chart-bar" style="color:var(--accent);font-size:12px"></i>
            Aktivitas Belajar 7 Hari Terakhir
        </div>
        
        <canvas id="chartAktivitas" height="140" style="display:none"></canvas>
        
        <?php
        $maxAkt = 1;
        $hariRows = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = now()->subDays($i)->format('Y-m-d');
            $jml = $aktivitasHarian->firstWhere('tgl', $tgl)?->jml ?? 0;
            $label = now()->subDays($i)->translatedFormat('D');
            $hariRows[] = ['label'=>$label,'jml'=>$jml,'tgl'=>$tgl];
            if($jml > $maxAkt) $maxAkt = $jml;
        }
        ?>
        <div class="bar-fallback" id="barFallback">
            <?php $__currentLoopData = $hariRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $pct = $maxAkt > 0 ? round($row['jml']/$maxAkt*100) : 0; ?>
            <div class="bar-col">
                <div class="bar-val"><?php echo e($row['jml']); ?></div>
                <div class="bar-fill" style="height:<?php echo e(max($pct,4)); ?>%;background:<?php echo e($row['tgl']===now()->format('Y-m-d') ? 'var(--accent)' : 'var(--accent-light2)'); ?>"></div>
                <div class="bar-day"><?php echo e($row['label']); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

</div>


<div class="adm-card fu d5">
    <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between">
        <div style="display:flex;align-items:center;gap:11px">
            <div style="width:36px;height:36px;background:var(--yellow-light);border-radius:10px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-trophy" style="color:var(--yellow);font-size:15px"></i>
            </div>
            <div>
                <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text)">Hasil Kuis Terbaru</div>
                <div style="font-size:11px;font-weight:500;color:var(--text3)"><?php echo e($recentHasil->count()); ?> data terakhir</div>
            </div>
        </div>
        <a href="<?php echo e(route('guru.kuis.index')); ?>"
           style="font-size:12px;color:var(--accent);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px">
            Lihat Semua <i class="fas fa-arrow-right" style="font-size:10px"></i>
        </a>
    </div>

    <?php if($recentHasil->isEmpty()): ?>
    <div style="padding:52px;text-align:center">
        <div style="width:58px;height:58px;background:var(--bg);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px">
            <i class="fas fa-inbox" style="font-size:22px;color:var(--text3)"></i>
        </div>
        <div style="font-weight:700;font-size:15px;color:var(--text);margin-bottom:4px">Belum Ada Data</div>
        <div style="font-size:13px;color:var(--text3)">Kuis yang dikerjakan siswa akan muncul di sini.</div>
    </div>
    <?php else: ?>
    <div style="overflow-x:auto">
        <table class="tbl">
            <thead><tr>
                <?php $__currentLoopData = ['Pengguna','Level','Skor','Jawaban Benar','Waktu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($h); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr></thead>
            <tbody>
            <?php $__currentLoopData = $recentHasil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:32px;height:32px;border-radius:9px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;font-family:'Outfit',sans-serif;font-size:13px;font-weight:800;color:var(--accent);flex-shrink:0">
                            <?php echo e(strtoupper(substr($h->user->name ?? '?', 0, 1))); ?>

                        </div>
                        <span style="font-weight:600;color:var(--text);font-size:13px"><?php echo e(Str::limit($h->user->name ?? 'Tamu', 18)); ?></span>
                    </div>
                </td>
                <td>
                    <span class="badge" style="background:var(--yellow-light);color:var(--yellow);border:1px solid #FDE68A">
                        Level <?php echo e($h->level); ?>

                    </span>
                </td>
                <td>
                    <span style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;color:var(--accent)">
                        <?php echo e($h->skor ?? round($h->benar / $h->total_soal * 100)); ?>%
                    </span>
                </td>
                <td>
                    <span style="font-weight:700;color:var(--text);font-size:13px"><?php echo e($h->benar); ?>/<?php echo e($h->total_soal); ?></span>
                </td>
                <td style="font-size:12px;color:var(--text3)"><?php echo e($h->created_at->diffForHumans()); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
(function() {
    // Data dari PHP
    <?php
    $hariLabels = [];
    $hariData   = [];
    for ($i = 6; $i >= 0; $i--) {
        $tgl = now()->subDays($i)->format('Y-m-d');
        $jml = $aktivitasHarian->firstWhere('tgl', $tgl)?->jml ?? 0;
        $hariLabels[] = now()->subDays($i)->translatedFormat('D, d M');
        $hariData[]   = $jml;
    }
    ?>

    const HARI_LABELS  = <?php echo json_encode($hariLabels, 15, 512) ?>;
    const HARI_DATA    = <?php echo json_encode($hariData, 15, 512) ?>;

    function buildCharts() {
        if (typeof Chart === 'undefined') return; // pakai fallback CSS

        Chart.defaults.font.family = "'DM Sans', sans-serif";
        Chart.defaults.color = '#64748B';

        // Sembunyikan fallback, tampilkan canvas
        ['barFallback'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        });
        document.querySelectorAll('canvas').forEach(c => c.style.display = 'block');

        // 1. Aktivitas harian
        new Chart(document.getElementById('chartAktivitas'), {
            type:'bar',
            data:{
                labels: HARI_LABELS,
                datasets:[{
                    label:'Aktivitas',
                    data: HARI_DATA,
                    backgroundColor: HARI_DATA.map((_,i)=>i===6?'rgba(26,79,139,.85)':'rgba(26,79,139,.4)'),
                    borderRadius:6, borderSkipped:false,
                }]
            },
            options:{
                responsive:true,
                plugins:{legend:{display:false}},
                scales:{
                    y:{beginAtZero:true,ticks:{stepSize:1},grid:{color:'rgba(0,0,0,.05)'}},
                    x:{grid:{display:false}}
                }
            }
        });

    }

    // Coba load Chart.js dari CDN, fallback jika gagal
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
    script.onload  = buildCharts;
    script.onerror = function() {
        // CDN gagal → pakai fallback CSS bar chart (sudah tampil by default)
        console.warn('Chart.js CDN gagal, menggunakan tampilan fallback.');
    };
    document.head.appendChild(script);
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\final\resources\views/guru/dashboard.blade.php ENDPATH**/ ?>