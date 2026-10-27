<?php $__env->startSection('title','Konten SIBI'); ?>
<?php $__env->startSection('page-title','Konten SIBI'); ?>
<?php $__env->startSection('page-subtitle','Kelola semua konten modul belajar'); ?>

<?php $__env->startSection('content'); ?>


<div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:22px">

    
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center">
        <span style="font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.6px;margin-right:4px">Filter:</span>
        <?php
        $cats = [
            ''         => ['Semua',    '🗂️', '#E8EDF5', '#1A4F8B', '#C3D0E8'],
            'angka'    => ['Angka',    '🔢', '#EDE9FE', '#7C3AED', '#D8D0FB'],
            'keluarga' => ['Keluarga', '🫂', '#E6F4ED', '#1A4F8B', '#B6DEC8'],
            'benda'    => ['Benda',    '📚', '#FEF3C7', '#D97706', '#FDE68A'],
            'sapaan'   => ['Sapaan',   '👋', '#EFF6FF', '#2563EB', '#BFDBFE'],
        ];
        $active = request('kategori', '');
        ?>
        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => [$lbl, $em, $bg, $col, $border]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $isActive = $active === $k; ?>
        <a href="<?php echo e(route('guru.konten.index')); ?><?php echo e($k ? '?kategori='.$k : ''); ?>"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:99px;font-size:12px;font-weight:700;text-decoration:none;transition:all .18s;letter-spacing:.1px;white-space:nowrap;
                  background:<?php echo e($isActive ? $col : $bg); ?>;
                  color:<?php echo e($isActive ? '#fff' : $col); ?>;
                  border:1.5px solid <?php echo e($isActive ? $col : $border); ?>;
                  box-shadow:<?php echo e($isActive ? '0 3px 10px rgba(0,0,0,.15)' : 'none'); ?>;
                  transform:<?php echo e($isActive ? 'translateY(-1px)' : 'none'); ?>">
            <span style="font-size:14px;line-height:1"><?php echo e($em); ?></span>
            <?php echo e($lbl); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="<?php echo e(route('guru.konten.create')); ?>"
           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:var(--r-sm);background:var(--accent);color:#fff;font-size:13px;font-weight:700;text-decoration:none;transition:all .15s;box-shadow:0 3px 10px rgba(26,79,139,.25);white-space:nowrap"
           onmouseover="this.style.background='#154080';this.style.transform='translateY(-1px)'"
           onmouseout="this.style.background='var(--accent)';this.style.transform='none'">
            <i class="fas fa-plus" style="font-size:11px"></i> Tambah Konten
        </a>
    </div>
</div>


<div class="adm-card">
    <div style="padding:14px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:34px;height:34px;background:var(--accent-light);border-radius:9px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-layer-group" style="color:var(--accent);font-size:14px"></i>
            </div>
            <div>
                <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text)">
                    Daftar Konten
                    <?php if(request('kategori')): ?>
                        — <?php echo e(ucfirst(request('kategori'))); ?>

                    <?php endif; ?>
                </div>
                <div style="font-size:11px;color:var(--text3)"><?php echo e($konten->total()); ?> total konten isyarat</div>
            </div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="tbl" style="min-width:600px">
            <thead><tr>
                <?php $__currentLoopData = ['Kata / Judul','Kategori','Teks SIBI','Belinyu','Aksi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($h); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $konten; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
            $catCfg = [
                'angka'       => ['#E6F4ED', '#1B6B45', '🔢'],
                'keluarga'    => ['#EBF5FB', '#2471A3', '🫂'],
                'benda'       => ['#F4ECF7', '#7D3C98', '📚'],
                'sapaan'      => ['#FEF9E7', '#D68910', '👋'],
            ];
            [$cbg, $ccol, $cem] = $catCfg[$k->kategori] ?? ['#F3F4F6', '#6B7280', '❓'];
            ?>
            <tr>
                <td>
                    <span style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:var(--text)">
                        <?php echo e($k->judul); ?>

                    </span>
                </td>
                <td>
                    <span class="badge" style="background:<?php echo e($cbg); ?>;color:<?php echo e($ccol); ?>;border:1px solid <?php echo e($cbg); ?>">
                        <?php echo e($cem); ?> <?php echo e(ucfirst($k->kategori)); ?>

                    </span>
                </td>
                <td>
                    <span style="font-weight:700;color:var(--accent);font-size:14px"><?php echo e($k->teks_sibi); ?></span>
                </td>
                <td style="color:var(--text2);font-size:13px"><?php echo e($k->teks_belinyu ?? '—'); ?></td>
                <td>
                    <div style="display:flex;align-items:center;gap:8px">
                        <a href="<?php echo e(route('guru.konten.edit', $k)); ?>" class="btn-s" style="font-size:12px;padding:6px 12px">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="<?php echo e(route('guru.konten.destroy', $k)); ?>"
                              onsubmit="return confirm('Hapus \'<?php echo e(addslashes($k->judul)); ?>\'?')">
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
                <td colspan="5" style="padding:60px;text-align:center">
                    <div style="width:60px;height:60px;background:var(--bg);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:24px">🤟</div>
                    <div style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:700;color:var(--text);margin-bottom:5px">Belum Ada Konten</div>
                    <div style="font-size:13px;color:var(--text3);margin-bottom:16px">Tambahkan konten belajar pertama untuk modul ini.</div>
                    <a href="<?php echo e(route('guru.konten.create')); ?>" class="btn-p" style="font-size:13px">
                        <i class="fas fa-plus"></i> Tambah Sekarang
                    </a>
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($konten->hasPages()): ?>
    <div style="padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;gap:8px;flex-wrap:wrap">
        <?php if($konten->onFirstPage()): ?>
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">← Prev</span>
        <?php else: ?>
            <a href="<?php echo e($konten->previousPageUrl()); ?>" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">← Prev</a>
        <?php endif; ?>

        <?php $__currentLoopData = $konten->getUrlRange(1, $konten->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($page == $konten->currentPage()): ?>
                <span style="padding:7px 12px;border-radius:8px;background:var(--accent);color:#fff;font-size:13px;font-weight:700"><?php echo e($page); ?></span>
            <?php else: ?>
                <a href="<?php echo e($url); ?>" style="padding:7px 12px;border-radius:8px;background:var(--surface);color:var(--text);font-size:13px;border:1px solid var(--border);text-decoration:none"><?php echo e($page); ?></a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($konten->hasMorePages()): ?>
            <a href="<?php echo e($konten->nextPageUrl()); ?>" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">Next →</a>
        <?php else: ?>
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">Next →</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guru', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\final\resources\views/guru/konten/index.blade.php ENDPATH**/ ?>