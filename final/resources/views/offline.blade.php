<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline — SIBI</title>
    @include('layouts.partials.pwa_head')
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800&family=DM+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'DM Sans',sans-serif;
            background:linear-gradient(160deg,#071428 0%,#0d2a5e 50%,#071428 100%);
            min-height:100vh;display:flex;align-items:center;justify-content:center;
            color:#fff;padding:24px;
        }
        .container{text-align:center;max-width:360px;}
        .icon{font-size:72px;margin-bottom:20px;display:block;}
        h1{font-family:'Outfit',sans-serif;font-size:28px;font-weight:800;margin-bottom:10px;}
        p{font-size:14px;color:rgba(255,255,255,.6);line-height:1.6;margin-bottom:28px;}
        .btn{
            display:inline-block;background:#1A4F8B;color:#fff;
            border:none;border-radius:14px;padding:14px 28px;
            font-family:'Outfit',sans-serif;font-weight:700;font-size:15px;
            cursor:pointer;text-decoration:none;
        }
        .btn:active{opacity:.8}
    </style>
</head>
<body>
    <div class="container">
        <span class="icon">📡</span>
        <h1>Tidak Ada Koneksi</h1>
        <p>Kamu sedang offline. Periksa koneksi internetmu dan coba lagi.</p>
        <button class="btn" onclick="window.location.reload()">🔄 Coba Lagi</button>
    </div>
</body>
</html>
