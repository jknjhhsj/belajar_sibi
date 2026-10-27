<?php $__env->startSection('title','Soal Kuis'); ?>
<?php $__env->startSection('page-title','Soal Kuis'); ?>
<?php $__env->startSection('page-subtitle','Kelola bank soal kuis SIBI'); ?>

<?php $__env->startSection('content'); ?>


<div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;margin-bottom:12px">
    <div style="display:flex;flex-wrap:wrap;gap:7px">
        <?php $__currentLoopData = [
            '' =>        ['Semua',    '🗂️'],
            'angka' =>   ['Angka',    '🔢'],
            'keluarga'=> ['Keluarga', '🫂'],
            'benda' =>   ['Benda',    '📚'],
            'sapaan'=>   ['Sapaan',   '👋'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => [$lbl, $em]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('guru.kuis.index', array_filter(['kategori'=>$k, 'tingkat'=>request('tingkat')]))); ?>"
           class="<?php echo e(request('kategori', '') === $k ? 'btn btn-green' : 'btn'); ?>"
           style="font-size:12px;padding:7px 14px;gap:5px">
            <?php echo e($em); ?> <?php echo e($lbl); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <a href="<?php echo e(route('guru.kuis.create')); ?>"
       class="btn btn-green" style="margin-left:auto;font-size:13px;padding:9px 18px">
        <i class="fas fa-plus" style="font-size:11px"></i> Tambah Soal
    </a>
</div>


<div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:20px">
    <?php $__currentLoopData = [
        '' =>       ['Semua Tingkat', '📊', 'var(--text2)'],
        'mudah' =>  ['🟢 Mudah',      '', '#1B6B45'],
        'sedang' => ['🟡 Sedang',     '', '#D68910'],
        'susah' =>  ['🔴 Susah',      '', '#B03A2E'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t => [$lbl, $em, $col]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('guru.kuis.index', array_filter(['kategori'=>request('kategori'), 'tingkat'=>$t]))); ?>"
       style="font-size:12px;padding:7px 14px;border-radius:99px;font-weight:700;text-decoration:none;
              border:1.5px solid <?php echo e(request('tingkat','') === $t ? $col : 'var(--border)'); ?>;
              background:<?php echo e(request('tingkat','') === $t ? $col.'1A' : 'var(--surface)'); ?>;
              color:<?php echo e(request('tingkat','') === $t ? $col : 'var(--text2)'); ?>">
        <?php echo e($lbl); ?>

    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="adm-card">
    <div style="padding:14px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:34px;height:34px;background:var(--yellow-light);border-radius:9px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-trophy" style="color:var(--yellow);font-size:14px"></i>
            </div>
            <div>
                <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text)">
                    Bank Soal Kuis
                    <?php if(request('kategori')): ?> — <?php echo e(ucfirst(request('kategori'))); ?> <?php endif; ?>
                    <?php if(request('tingkat')): ?> — <?php echo e(ucfirst(request('tingkat'))); ?> <?php endif; ?>
                </div>
                <div style="font-size:11px;color:var(--text3)">
                    <?php echo e(method_exists($soal,'total') ? $soal->total() : $soal->count()); ?> total soal —
                    diacak otomatis tiap kali siswa mengerjakan kuis
                </div>
            </div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="tbl" style="min-width:680px">
            <thead><tr>
                <?php $__currentLoopData = ['Tingkat','Kategori','Pertanyaan','Pilihan A','Pilihan B','Pilihan C','Jawaban','Aksi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($h); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $soal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
            $catCfg = [
                'angka'    => ['#E6F4ED', '#1B6B45', '🔢'],
                'keluarga' => ['#EBF5FB', '#2471A3', '🫂'],
                'benda'    => ['#F4ECF7', '#7D3C98', '📚'],
                'sapaan'   => ['#FEF9E7', '#D68910', '👋'],
            ];
            [$cbg, $ccol, $cem] = $catCfg[$s->kategori] ?? ['#F3F4F6', '#6B7280', '❓'];

            $tingkatCfg = [
                1 => ['Mudah', '#E6F4ED', '#1B6B45'],
                2 => ['Sedang', '#FEF9E7', '#D68910'],
                3 => ['Susah', '#FDEDEA', '#B03A2E'],
            ];
            [$tlabel, $tbg, $tcol] = $tingkatCfg[$s->level] ?? ['—', '#F3F4F6', '#6B7280'];
            ?>
            <tr>
                <td>
                    <span class="badge" style="background:<?php echo e($tbg); ?>;color:<?php echo e($tcol); ?>"><?php echo e($tlabel); ?></span>
                </td>
                <td>
                    <span class="badge" style="background:<?php echo e($cbg); ?>;color:<?php echo e($ccol); ?>"><?php echo e($cem); ?> <?php echo e(ucfirst($s->kategori)); ?></span>
                </td>
                <td style="font-weight:600;color:var(--text);max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($s->pertanyaan); ?></td>
                <td style="color:var(--text2);font-size:12px;max-width:90px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($s->pilihan_a); ?></td>
                <td style="color:var(--text2);font-size:12px;max-width:90px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($s->pilihan_b); ?></td>
                <td style="color:var(--text2);font-size:12px;max-width:90px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($s->pilihan_c); ?></td>
                <td>
                    <span class="badge" style="background:var(--accent-light);color:var(--accent);border:1px solid var(--accent-light2);font-size:13px;font-weight:800"><?php echo e(strtoupper($s->jawaban_benar)); ?></span>
                </td>
                <td>
                    <div style="display:flex;align-items:center;gap:8px">
                        <a href="<?php echo e(route('guru.kuis.edit', $s)); ?>" class="btn-s" style="font-size:12px;padding:6px 12px">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="<?php echo e(route('guru.kuis.destroy', $s)); ?>" onsubmit="return confirm('Hapus soal ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-s" style="font-size:12px;padding:6px 10px;color:var(--red);border-color:rgba(220,38,38,.25);background:var(--red-light)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" style="padding:60px;text-align:center">
                    <div style="width:60px;height:60px;background:var(--bg);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:24px">❓</div>
                    <div style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:700;color:var(--text);margin-bottom:5px">Belum Ada Soal</div>
                    <div style="font-size:13px;color:var(--text3);margin-bottom:16px">Tambahkan soal kuis pertama untuk bank soal ini.</div>
                    <a href="<?php echo e(route('guru.kuis.create')); ?>" class="btn-p" style="font-size:13px">
                        <i class="fas fa-plus"></i> Tambah Soal
                    </a>
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if(method_exists($soal, 'hasPages') && $soal->hasPages()): ?>
    <div style="padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;gap:8px;flex-wrap:wrap">
        <?php if($soal->onFirstPage()): ?>
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">← Prev</span>
        <?php else: ?>
            <a href="<?php echo e($soal->previousPageUrl()); ?>" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">← Prev</a>
        <?php endif; ?>
        <?php $__currentLoopData = $soal->getUrlRange(1, $soal->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($page == $soal->currentPage()): ?>
                <span style="padding:7px 12px;border-radius:8px;background:var(--accent);color:#fff;font-size:13px;font-weight:700"><?php echo e($page); ?></span>
            <?php else: ?>
                <a href="<?php echo e($url); ?>" style="padding:7px 12px;border-radius:8px;background:var(--surface);color:var(--text);font-size:13px;border:1px solid var(--border);text-decoration:none"><?php echo e($page); ?></a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($soal->hasMorePages()): ?>
            <a href="<?php echo e($soal->nextPageUrl()); ?>" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">Next →</a>
        <?php else: ?>
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">Next →</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\final\resources\views/guru/kuis/index.blade.php ENDPATH**/ ?>