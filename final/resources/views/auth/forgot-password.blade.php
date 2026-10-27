<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lupa Sandi — SIBI Belajar</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:#F0F5FF}
.page{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
.card{background:#fff;border-radius:20px;padding:48px 44px;width:100%;max-width:440px;
  box-shadow:0 8px 40px rgba(26,79,139,.10)}
.brand{display:flex;align-items:center;gap:10px;margin-bottom:32px;justify-content:center}
.brand-mark{width:42px;height:42px;background:linear-gradient(135deg,#1A4F8B,#2563B0);
  border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px}
.brand-name{font-family:'Nunito',sans-serif;font-size:22px;font-weight:900;color:#0D1B2E}
.brand-name em{color:#2563B0;font-style:normal}
.ico-wrap{width:72px;height:72px;background:#EFF6FF;border-radius:18px;
  display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 20px}
h1{font-family:'Nunito',sans-serif;font-size:24px;font-weight:900;color:#0D1B2E;
  text-align:center;margin-bottom:8px}
.sub{text-align:center;color:#8BA5BF;font-size:13.5px;margin-bottom:28px;line-height:1.6}
.field{margin-bottom:18px}
.field label{display:block;font-size:12.5px;font-weight:700;color:#4A637E;margin-bottom:7px}
.fw{position:relative}
.fic{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#B0C4D8;font-size:13px;pointer-events:none}
.field input{width:100%;padding:13px 14px 13px 40px;border:1.5px solid #E2EBF4;
  border-radius:12px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;
  color:#0D1B2E;background:#F8FAFC;outline:none;transition:all .2s}
.field input:focus{border-color:#2563B0;background:#fff;box-shadow:0 0 0 4px rgba(37,99,176,.08)}
.field input::placeholder{color:#B0C4D8}
.btn-go{width:100%;padding:14px;border-radius:14px;
  background:linear-gradient(135deg,#1A4F8B,#2563B0);color:#fff;
  font-family:'Nunito',sans-serif;font-size:16px;font-weight:800;
  border:none;cursor:pointer;transition:all .2s;
  display:flex;align-items:center;justify-content:center;gap:8px;
  box-shadow:0 4px 20px rgba(26,79,139,.28)}
.btn-go:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(26,79,139,.36)}
.back{display:flex;align-items:center;justify-content:center;gap:6px;
  margin-top:18px;font-size:13px;color:#8BA5BF;text-decoration:none}
.back:hover{color:#2563B0}
.alert-s{background:#EFF6FF;border:1px solid #BFDBFE;border-left:3px solid #2563B0;
  border-radius:10px;padding:12px 14px;margin-bottom:20px;font-size:13px;
  color:#1E40AF;font-weight:600;display:flex;align-items:flex-start;gap:9px}
.alert-e{background:#FEF2F2;border:1px solid #FECACA;border-left:3px solid #DC2626;
  border-radius:10px;padding:12px 14px;margin-bottom:20px;font-size:13px;
  color:#DC2626;font-weight:600;display:flex;align-items:flex-start;gap:9px}
.new-pw-section{display:none}
</style>
</head>
<body>
<div class="page">
  <div class="card">
    <div class="brand">
      <div class="brand-mark">🤟</div>
      <div class="brand-name">SI<em>BI</em> Belajar</div>
    </div>

    <div class="ico-wrap">🔑</div>
    <h1>Lupa Sandi</h1>
    <p class="sub">Masukkan email admin kamu, lalu buat sandi baru langsung di sini.</p>

    @if(session('success'))
    <div class="alert-s"><i class="fas fa-check-circle" style="margin-top:2px"></i><span>{{ session('success') }}</span></div>
    @endif

    @if(session('error'))
    <div class="alert-e"><i class="fas fa-exclamation-circle" style="margin-top:2px"></i><span>{{ session('error') }}</span></div>
    @endif

    @if($errors->any())
    <div class="alert-e"><i class="fas fa-exclamation-circle" style="margin-top:2px"></i>
      <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    </div>
    @endif

    {{-- Step 1: Cari akun --}}
    <form action="{{ route('password.find') }}" method="POST" id="formCari" @if(session('found')) style="display:none" @endif>
      @csrf
      <div class="field">
        <label>Email Admin</label>
        <div class="fw">
          <i class="fas fa-envelope fic"></i>
          <input type="email" name="email" value="{{ old('email', session('email')) }}" placeholder="admin@email.com" required autofocus>
        </div>
      </div>
      <button type="submit" class="btn-go"><i class="fas fa-search"></i> Cari Akun</button>
    </form>

    {{-- Step 2: Set sandi baru --}}
    @if(session('found'))
    <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:10px;padding:11px 14px;margin-bottom:20px;font-size:13px;color:#166534;font-weight:600;display:flex;align-items:center;gap:9px">
      <i class="fas fa-user-check"></i> Akun ditemukan: <strong>{{ session('found_name') }}</strong>
    </div>
    <form action="{{ route('password.update.direct') }}" method="POST">
      @csrf
      <input type="hidden" name="email" value="{{ session('email') }}">
      <div class="field">
        <label>Sandi Baru</label>
        <div class="fw">
          <i class="fas fa-lock fic"></i>
          <input type="password" name="password" id="pw1" placeholder="Minimal 6 karakter" required style="padding-right:44px">
          <button type="button" onclick="togglePw('pw1','eye1')" style="position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#B0C4D8;font-size:14px;padding:4px">
            <i id="eye1" class="fas fa-eye"></i>
          </button>
        </div>
      </div>
      <div class="field">
        <label>Konfirmasi Sandi Baru</label>
        <div class="fw">
          <i class="fas fa-lock fic"></i>
          <input type="password" name="password_confirmation" id="pw2" placeholder="Ulangi sandi baru" required style="padding-right:44px">
          <button type="button" onclick="togglePw('pw2','eye2')" style="position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#B0C4D8;font-size:14px;padding:4px">
            <i id="eye2" class="fas fa-eye"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-go"><i class="fas fa-save"></i> Simpan Sandi Baru</button>
    </form>
    @endif

    <a href="{{ route('login') }}" class="back"><i class="fas fa-arrow-left"></i> Kembali ke halaman masuk</a>
  </div>
</div>
<script>
function togglePw(id, ico){
  const i=document.getElementById(id), e=document.getElementById(ico);
  i.type=i.type==='password'?'text':'password';
  e.className='fas fa-'+(i.type==='password'?'eye':'eye-slash');
}
</script>
</body>
</html>
