<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun — SIBI Belajar</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:#F0F5FF}
.page{min-height:100vh;display:flex}

.left{flex:1;background:linear-gradient(145deg,#071428 0%,#0D2A5E 55%,#1A4F8B 100%);
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  padding:60px 48px;position:relative;overflow:hidden}
.left::before{content:'';position:absolute;width:480px;height:480px;
  background:radial-gradient(circle,rgba(96,165,250,.15) 0%,transparent 70%);
  top:-120px;right:-100px;border-radius:50%}
.left::after{content:'';position:absolute;width:320px;height:320px;
  background:radial-gradient(circle,rgba(96,165,250,.10) 0%,transparent 70%);
  bottom:-80px;left:-80px;border-radius:50%}
.brand{display:flex;align-items:center;gap:12px;margin-bottom:48px;z-index:1;position:relative}
.brand-mark{width:46px;height:46px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.22);
  border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px}
.brand-name{font-family:'Nunito',sans-serif;font-size:26px;font-weight:900;color:#fff}
.brand-name em{color:#93C5FD;font-style:normal}
.ilus{z-index:1;position:relative;text-align:center;margin-bottom:40px}
.ilus-circle{width:180px;height:180px;background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.14);
  border-radius:50%;display:flex;align-items:center;justify-content:center;
  margin:0 auto 20px;font-size:80px;animation:float 4s ease-in-out infinite}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
.ilus-title{font-family:'Nunito',sans-serif;font-size:28px;font-weight:900;color:#fff;line-height:1.2;margin-bottom:10px}
.ilus-title em{color:#93C5FD;font-style:normal}
.ilus-desc{color:rgba(255,255,255,.6);font-size:13.5px;line-height:1.7;max-width:300px;margin:0 auto}
.chips{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;z-index:1;position:relative}
.chip{background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.16);
  border-radius:99px;padding:7px 14px;font-size:12px;color:rgba(255,255,255,.82);font-weight:600}

.right{width:500px;flex-shrink:0;background:#fff;display:flex;flex-direction:column;
  align-items:center;justify-content:center;padding:48px 44px;
  box-shadow:-8px 0 40px rgba(26,79,139,.07);overflow-y:auto}
.form-head{text-align:center;margin-bottom:26px;width:100%}
.form-head h1{font-family:'Nunito',sans-serif;font-size:26px;font-weight:900;color:#0D1B2E;letter-spacing:-.5px;margin-bottom:6px}
.form-head p{color:#8BA5BF;font-size:13px}

.steps{display:flex;gap:4px;margin-bottom:24px;width:100%}
.step{flex:1;height:3px;border-radius:99px;background:#E2EBF4;transition:background .3s}
.step.done{background:#2563B0}

.field{margin-bottom:14px;width:100%}
.field label{display:block;font-size:12.5px;font-weight:700;color:#4A637E;margin-bottom:7px}
.fw{position:relative}
.fic{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#B0C4D8;font-size:13px;pointer-events:none}
.field input{width:100%;padding:13px 14px 13px 40px;border:1.5px solid #E2EBF4;
  border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;
  color:#0D1B2E;background:#F8FAFC;outline:none;transition:all .2s}
.field input:focus{border-color:#2563B0;background:#fff;box-shadow:0 0 0 4px rgba(37,99,176,.08)}
.field input::placeholder{color:#B0C4D8}
.field input.err{border-color:#DC2626;background:#FEF2F2}
.eye{position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;
  border:none;cursor:pointer;color:#B0C4D8;font-size:14px;padding:4px}

.strength-bar{height:3px;border-radius:99px;background:#E2EBF4;margin-top:6px;overflow:hidden}
.strength-fill{height:100%;border-radius:99px;transition:width .3s,background .3s;width:0%}
.strength-lbl{font-size:10px;font-weight:600;margin-top:4px;color:#B0C4D8}

.err-box{display:flex;align-items:flex-start;gap:9px;background:#FEF2F2;
  border:1px solid #FECACA;border-left:3px solid #DC2626;
  border-radius:10px;padding:11px 14px;margin-bottom:16px;width:100%}
.err-box i{color:#DC2626;font-size:13px;margin-top:2px;flex-shrink:0}
.err-box p{font-size:12.5px;color:#DC2626;font-weight:600;line-height:1.5}

.btn-go{width:100%;padding:14px;border-radius:14px;
  background:linear-gradient(135deg,#1A4F8B,#2563B0);color:#fff;
  font-family:'Nunito',sans-serif;font-size:16px;font-weight:800;
  border:none;cursor:pointer;transition:all .2s;
  display:flex;align-items:center;justify-content:center;gap:8px;margin-top:6px;
  box-shadow:0 4px 20px rgba(26,79,139,.28)}
.btn-go:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(26,79,139,.36)}

.divider{display:flex;align-items:center;gap:12px;margin:18px 0;width:100%}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:#E8F0F8}
.divider span{font-size:11px;color:#B0C4D8;font-weight:600;letter-spacing:.5px}
.foot{text-align:center;width:100%}
.foot p{font-size:13px;color:#8BA5BF}
.foot a{color:#2563B0;font-weight:700;text-decoration:none}
.back{display:inline-flex;align-items:center;gap:6px;margin-top:12px;font-size:12px;color:#B0C4D8;text-decoration:none}
.back:hover{color:#4A637E}

@media(max-width:768px){
  .left{display:none}
  .right{width:100%;padding:36px 24px;min-height:100vh;box-shadow:none}
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
      <div class="ilus-circle">🎉</div>
      <div class="ilus-title">Gabung & Mulai<br><em>Belajar Bareng!</em></div>
      <div class="ilus-desc">Buat akun gratis dan langsung akses puluhan konten isyarat + kuis 3 tingkat.</div>
    </div>
    <div class="chips">
      <div class="chip">✅ Gratis Selamanya</div>
      <div class="chip">📱 Bisa di HP</div>
      <div class="chip">🏆 Ada Kuis</div>
    </div>
  </div>

  <div class="right">
    <div class="form-head">
      <h1>Buat Akun Baru 🚀</h1>
      <p>Isi data di bawah untuk mulai belajar SIBI</p>
    </div>

    <div class="steps" id="steps">
      <div class="step done" id="s1"></div>
      <div class="step" id="s2"></div>
      <div class="step" id="s3"></div>
    </div>

    @if($errors->any())
    <div class="err-box">
      <i class="fas fa-exclamation-circle"></i>
      <div>@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST" style="width:100%" id="regForm">
      @csrf
      <div class="field">
        <label>Nama Lengkap</label>
        <div class="fw">
          <i class="fas fa-user fic"></i>
          <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required
            oninput="updateSteps()" class="{{ $errors->has('name') ? 'err' : '' }}">
        </div>
      </div>
      <div class="field">
        <label>Kelas <span style="color:#B0C4D8;font-weight:400">(opsional)</span></label>
        <div class="fw">
          <i class="fas fa-school fic"></i>
          <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: 5A">
        </div>
      </div>
      <div class="field">
        <label>Alamat Email</label>
        <div class="fw">
          <i class="fas fa-envelope fic"></i>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="kamu@email.com" required
            oninput="updateSteps()" class="{{ $errors->has('email') ? 'err' : '' }}">
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="fw">
          <i class="fas fa-lock fic"></i>
          <input type="password" name="password" id="pw1" placeholder="Min. 6 karakter" required
            oninput="checkStrength(this.value);updateSteps()" style="padding-right:44px"
            class="{{ $errors->has('password') ? 'err' : '' }}">
          <button type="button" class="eye" onclick="togglePw('pw1','eye1')"><i id="eye1" class="fas fa-eye"></i></button>
        </div>
        <div class="strength-bar"><div class="strength-fill" id="sBar"></div></div>
        <div class="strength-lbl" id="sLbl"></div>
      </div>
      <div class="field">
        <label>Konfirmasi Password</label>
        <div class="fw">
          <i class="fas fa-lock fic"></i>
          <input type="password" name="password_confirmation" id="pw2" placeholder="Ulangi password" required
            oninput="updateSteps()" style="padding-right:44px">
          <button type="button" class="eye" onclick="togglePw('pw2','eye2')"><i id="eye2" class="fas fa-eye"></i></button>
        </div>
      </div>
      <button type="submit" class="btn-go"><i class="fas fa-user-plus"></i> Buat Akun Sekarang</button>
    </form>

    <div class="divider"><span>SUDAH PUNYA AKUN?</span></div>
    <div class="foot">
      <p><a href="{{ route('login') }}">← Masuk ke Akun</a></p>
    </div>
  </div>
</div>
<script>
function togglePw(id,ico){
  const i=document.getElementById(id),e=document.getElementById(ico);
  i.type=i.type==='password'?'text':'password';
  e.className='fas fa-'+(i.type==='password'?'eye':'eye-slash');
}
function checkStrength(v){
  const b=document.getElementById('sBar'),l=document.getElementById('sLbl');
  let s=0,lbl='',col='';
  if(v.length>=6)s++;if(v.length>=10)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^a-zA-Z0-9]/.test(v))s++;
  if(s<=1){lbl='Terlalu lemah';col='#DC2626'}
  else if(s<=2){lbl='Lemah';col='#F59E0B'}
  else if(s<=3){lbl='Cukup';col='#3B82F6'}
  else{lbl='Kuat 💪';col='#16A34A'}
  b.style.width=(s/5*100)+'%';b.style.background=col;
  l.textContent=v?lbl:'';l.style.color=col;
}
function updateSteps(){
  const n=document.querySelector('[name=name]').value;
  const em=document.querySelector('[name=email]').value;
  const p=document.getElementById('pw1').value;
  const p2=document.getElementById('pw2').value;
  document.getElementById('s1').className='step'+(n?' done':'');
  document.getElementById('s2').className='step'+(n&&em?' done':'');
  document.getElementById('s3').className='step'+(n&&em&&p&&p2?' done':'');
}
</script>
</body>
</html>
