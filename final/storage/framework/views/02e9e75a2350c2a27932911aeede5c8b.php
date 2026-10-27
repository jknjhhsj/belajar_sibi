<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — SIBI Belajar</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:#F0F5FF}
.page{min-height:100vh;display:flex}

/* LEFT PANEL */
.left{flex:1;background:linear-gradient(145deg,#071428 0%,#0D2A5E 55%,#1A4F8B 100%);
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  padding:60px 48px;position:relative;overflow:hidden}
.left::before{content:'';position:absolute;width:480px;height:480px;
  background:radial-gradient(circle,rgba(96,165,250,.15) 0%,transparent 70%);
  top:-120px;right:-100px;border-radius:50%}
.left::after{content:'';position:absolute;width:320px;height:320px;
  background:radial-gradient(circle,rgba(96,165,250,.10) 0%,transparent 70%);
  bottom:-80px;left:-80px;border-radius:50%}
.brand{display:flex;align-items:center;gap:12px;margin-bottom:56px;z-index:1;position:relative}
.brand-mark{width:46px;height:46px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.22);
  border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px}
.brand-name{font-family:'Nunito',sans-serif;font-size:26px;font-weight:900;color:#fff}
.brand-name em{color:#93C5FD;font-style:normal}
.ilus{z-index:1;position:relative;text-align:center;margin-bottom:44px}
.ilus-circle{width:190px;height:190px;background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.14);
  border-radius:50%;display:flex;align-items:center;justify-content:center;
  margin:0 auto 22px;font-size:86px;animation:float 4s ease-in-out infinite;
  box-shadow:0 24px 60px rgba(0,0,0,.28)}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-14px)}}
.ilus-title{font-family:'Nunito',sans-serif;font-size:30px;font-weight:900;color:#fff;
  line-height:1.2;letter-spacing:-.5px;margin-bottom:12px}
.ilus-title em{color:#93C5FD;font-style:normal}
.ilus-desc{color:rgba(255,255,255,.6);font-size:14px;line-height:1.7;max-width:300px;margin:0 auto}
.chips{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;z-index:1;position:relative}
.chip{background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.16);
  border-radius:99px;padding:8px 16px;font-size:12px;color:rgba(255,255,255,.82);
  font-weight:600;display:flex;align-items:center;gap:6px}

/* RIGHT PANEL */
.right{width:470px;flex-shrink:0;background:#fff;display:flex;flex-direction:column;
  align-items:center;justify-content:center;padding:52px 44px;
  box-shadow:-8px 0 40px rgba(26,79,139,.07);position:relative}
.kepsek-ico{position:absolute;top:18px;right:18px;width:34px;height:34px;border-radius:10px;
  background:#F1F5F9;border:1px solid #E2EBF4;color:#94A3B8;cursor:pointer;
  display:flex;align-items:center;justify-content:center;font-size:14px;transition:all .2s}
.kepsek-ico:hover{background:#EFF6FF;color:#2563B0;border-color:#BFDBFE}
.kepsek-ico.active{background:#2563B0;color:#fff;border-color:#2563B0}
.form-head{text-align:center;margin-bottom:30px;width:100%}
.form-head h1{font-family:'Nunito',sans-serif;font-size:28px;font-weight:900;
  color:#0D1B2E;letter-spacing:-.5px;margin-bottom:6px}
.form-head p{color:#8BA5BF;font-size:13.5px}

/* TABS */
.tabs{display:flex;background:#F1F5F9;border-radius:14px;padding:5px;margin-bottom:26px;width:100%;gap:4px}
.tab{flex:1;padding:10px 14px;border:none;border-radius:10px;
  font-family:'Plus Jakarta Sans',sans-serif;font-size:13px;font-weight:700;
  cursor:pointer;transition:all .2s;background:transparent;color:#94A3B8;
  display:flex;align-items:center;justify-content:center;gap:7px}
.tab.active{background:#fff;color:#1A4F8B;box-shadow:0 2px 8px rgba(26,79,139,.12)}

/* HINT */
.hint{display:flex;gap:10px;background:#EFF6FF;border:1px solid #BFDBFE;
  border-left:3px solid #2563B0;border-radius:10px;padding:11px 14px;
  margin-bottom:20px;width:100%}
.hint.warn{background:#FFFBEB;border-color:#FDE68A;border-left-color:#D97706}
.hint-ico{font-size:16px;flex-shrink:0;line-height:1.4}
.hint-txt{font-size:12px;color:#1E40AF;line-height:1.6}
.hint-txt.warn{color:#92400E}
.hint-txt strong{display:block;font-weight:700;margin-bottom:2px}

/* ERROR */
.err-box{display:flex;align-items:flex-start;gap:9px;background:#FEF2F2;
  border:1px solid #FECACA;border-left:3px solid #DC2626;
  border-radius:10px;padding:11px 14px;margin-bottom:16px;width:100%}
.err-box i{color:#DC2626;font-size:13px;margin-top:2px;flex-shrink:0}
.err-box p{font-size:12.5px;color:#DC2626;font-weight:600;line-height:1.5}

/* FIELDS */
.field{margin-bottom:15px;width:100%}
.field label{display:block;font-size:12.5px;font-weight:700;color:#4A637E;margin-bottom:7px}
.fw{position:relative}
.fic{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#B0C4D8;font-size:13px;pointer-events:none}
.field input{width:100%;padding:13px 14px 13px 40px;border:1.5px solid #E2EBF4;
  border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;
  color:#0D1B2E;background:#F8FAFC;outline:none;transition:all .2s}
.field input:focus{border-color:#2563B0;background:#fff;box-shadow:0 0 0 4px rgba(37,99,176,.08)}
.field input::placeholder{color:#B0C4D8}
.eye{position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;
  border:none;cursor:pointer;color:#B0C4D8;font-size:14px;padding:4px}
.eye:hover{color:#4A637E}

/* BUTTON */
.btn-go{width:100%;padding:14px;border-radius:14px;
  background:linear-gradient(135deg,#1A4F8B,#2563B0);color:#fff;
  font-family:'Nunito',sans-serif;font-size:16px;font-weight:800;
  border:none;cursor:pointer;transition:all .2s;
  display:flex;align-items:center;justify-content:center;gap:8px;margin-top:8px;
  box-shadow:0 4px 20px rgba(26,79,139,.28)}
.btn-go:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(26,79,139,.36)}

.divider{display:flex;align-items:center;gap:12px;margin:20px 0;width:100%}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:#E8F0F8}
.divider span{font-size:11px;color:#B0C4D8;font-weight:600;letter-spacing:.5px}

.foot{text-align:center;width:100%}
.foot p{font-size:13px;color:#8BA5BF}
.foot a{color:#2563B0;font-weight:700;text-decoration:none}
.back{display:inline-flex;align-items:center;gap:6px;margin-top:14px;
  font-size:12px;color:#B0C4D8;text-decoration:none}
.back:hover{color:#4A637E}

@media(max-width:768px){
  .page{flex-direction:column}
  .left{
    flex:none;
    width:100%;
    padding:36px 24px 32px;
    min-height:auto;
  }
  .left::before{width:280px;height:280px;top:-80px;right:-60px}
  .left::after{width:200px;height:200px;bottom:-50px;left:-50px}
  .brand{margin-bottom:28px}
  .ilus{margin-bottom:20px}
  .ilus-circle{width:120px;height:120px;font-size:54px;margin-bottom:14px}
  .ilus-title{font-size:22px;margin-bottom:8px}
  .ilus-desc{font-size:13px}
  .chips{gap:8px}
  .chip{font-size:11px;padding:6px 12px}
  .right{width:100%;padding:36px 24px;box-shadow:none}
}
</style>
</head>
<body>
<div class="page">
  <div class="left">
    <div class="brand">
      <div class="brand-mark">🤟</div>
      <div class="brand-name">SI<em>BI</em> Belajar</div>
    </div>
    <div class="ilus">
      <div class="ilus-circle">🤟</div>
      <div class="ilus-title">Belajar <em>Bahasa</em><br>Isyarat Bareng!</div>
      <div class="ilus-desc">Platform SIBI untuk anak tunarungu. Interaktif, menyenangkan, dan gratis.</div>
    </div>
    <div class="chips">
      <div class="chip">📖 Konten Isyarat SIBI</div>
      <div class="chip">🏆 Kuis 5 Level</div>
      <div class="chip">📊 Lacak Progress</div>
    </div>
  </div>

  <div class="right">
    <button type="button" class="kepsek-ico" id="kepsekIco" onclick="switchTab('admin')" title="Login Kepala Sekolah">
      <i class="fas fa-shield-halved"></i>
    </button>

    <div class="form-head">
      <h1>Selamat Datang! 👋</h1>
      <p>Masuk ke akun SIBI Belajar kamu</p>
    </div>

    <div class="tabs">
      <button class="tab active" id="tSiswa" onclick="switchTab('siswa')">👤 Siswa</button>
      <button class="tab" id="tAdmin" onclick="switchTab('guru')">🧑‍🏫 Guru</button>
    </div>

    <div class="hint" id="hintBox">
      <span class="hint-ico">💡</span>
      <div class="hint-txt" id="hintTxt">
        <strong>Login Siswa</strong>Gunakan email &amp; password yang sudah kamu daftarkan.
      </div>
    </div>

    <?php if($errors->any()): ?>
    <div class="err-box">
      <i class="fas fa-exclamation-circle"></i>
      <div><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><p><?php echo e($e); ?></p><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('login')); ?>" method="POST" style="width:100%">
      <?php echo csrf_field(); ?>
      <div class="field">
        <label>Alamat Email</label>
        <div class="fw">
          <i class="fas fa-envelope fic"></i>
          <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="kamu@email.com" required autofocus>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="fw">
          <i class="fas fa-lock fic"></i>
          <input type="password" name="password" id="pwInput" placeholder="••••••••" required style="padding-right:44px">
          <button type="button" class="eye" onclick="togglePw()"><i id="eyeIco" class="fas fa-eye"></i></button>
        </div>
      </div>
      <button type="submit" class="btn-go"><i class="fas fa-sign-in-alt"></i> Masuk Sekarang</button>
    </form>

    <div class="foot" id="footReg" style="margin-top:16px">
      <p>Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar Sekarang →</a></p>
    </div>

    <div class="foot" id="footForgot" style="display:none;margin-top:16px">
      <p><a href="<?php echo e(route('password.request')); ?>">🔑 Lupa sandi? Reset di sini</a></p>
    </div>
  </div>
</div>
<script>
function switchTab(r){
  const hb=document.getElementById('hintBox'),ht=document.getElementById('hintTxt');
  const tS=document.getElementById('tSiswa'),tA=document.getElementById('tAdmin');
  const ico=document.getElementById('kepsekIco');
  const fr=document.getElementById('footReg');
  const ff=document.getElementById('footForgot');
  const emailInput=document.querySelector('input[name="email"]');
  const pwInput=document.getElementById('pwInput');
  if(r==='admin'){
    tS.classList.remove('active');tA.classList.remove('active');
    ico.classList.add('active');
    hb.classList.add('warn');ht.className='hint-txt warn';
    ht.innerHTML='<strong>🛡️ Login Kepala Sekolah</strong>Khusus akun admin/kepala sekolah.';
    fr.style.display='none';
    ff.style.display='';
    // Isi otomatis akun kepala sekolah, tinggal klik "Masuk Sekarang"
    emailInput.value='admin@SLB.id';
    pwInput.value='SLB12345';
  }else if(r==='guru'){
    tA.classList.add('active');tS.classList.remove('active');
    ico.classList.remove('active');
    hb.classList.add('warn');ht.className='hint-txt warn';
    ht.innerHTML='<strong>🧑‍🏫 Login Guru</strong>Gunakan akun guru yang sudah diberikan sekolah.';
    fr.style.display='none';
    ff.style.display='';
    emailInput.value='';
    pwInput.value='';
  }else{
    tS.classList.add('active');tA.classList.remove('active');
    ico.classList.remove('active');
    hb.classList.remove('warn');ht.className='hint-txt';
    ht.innerHTML='<strong>Login Siswa</strong>Gunakan email & password yang sudah kamu daftarkan.';
    fr.style.display='';
    ff.style.display='none';
    emailInput.value='';
    pwInput.value='';
  }
}
function togglePw(){
  const i=document.getElementById('pwInput'),e=document.getElementById('eyeIco');
  i.type=i.type==='password'?'text':'password';
  e.className='fas fa-'+(i.type==='password'?'eye':'eye-slash');
}
</script>
</body>
</html><?php /**PATH C:\laragon\www\final\resources\views/auth/login.blade.php ENDPATH**/ ?>