@extends('layouts.siswa')
@section('title','Kuis SIBI — Uji Kemampuanmu')

@push('styles')
<style>
.main-content{ max-width:100% !important; padding:12px 16px !important; }

.screen{display:none}
.screen.active{display:block}

/* ══ HERO ══ */
.kuis-hero{
    background:linear-gradient(135deg,#7D4F00,#D68910);
    border-radius:var(--r-lg);padding:18px 20px;
    position:relative;overflow:hidden;margin-bottom:14px;
}
.kuis-hero::before{
    content:'🏆';position:absolute;right:20px;top:50%;transform:translateY(-50%);
    font-size:52px;opacity:.09;pointer-events:none;line-height:1;
}
.kuis-hero-pill{
    display:inline-flex;align-items:center;gap:6px;
    background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
    border-radius:99px;padding:3px 10px;font-size:10px;font-weight:600;
    color:rgba(255,255,255,.9);margin-bottom:7px;
}
.kuis-hero h2{font-family:'Outfit',sans-serif;color:#fff;font-size:18px;font-weight:800;letter-spacing:-.3px;margin-bottom:4px}
.kuis-hero p{color:rgba(255,255,255,.7);font-size:11px;line-height:1.5}

/* ══ LEVEL GRID ══ */
.level-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.level-card{
    background:var(--surface);border:1px solid var(--border);
    border-radius:var(--r-lg);padding:16px 8px;
    cursor:pointer;text-align:center;transition:all .18s;
    position:relative;overflow:hidden;
}
.level-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-lg)}
.level-emoji{font-size:28px;margin-bottom:6px;line-height:1}
.level-name{font-family:'Outfit',sans-serif;font-size:13px;font-weight:800;color:var(--text);margin-bottom:3px}
.level-cnt{font-size:10px;color:var(--text3);margin-top:1px;font-weight:500;margin-bottom:10px}
.level-go{
    display:flex;align-items:center;justify-content:center;gap:4px;
    padding:8px 6px;border-radius:99px;
    font-size:11px;font-weight:700;color:#fff;
    border:none;cursor:pointer;width:100%;
    transition:all .15s;font-family:'Outfit',sans-serif;
}

/* ══ QUIZ PAGE ══ */
.quiz-page{max-width:860px;margin:0 auto}

.quiz-topbar{
    border-radius:var(--r-lg);padding:9px 12px;
    margin-bottom:10px;
    display:flex;align-items:center;gap:8px;
    position:relative;overflow:hidden;flex-wrap:wrap;
}
.quiz-topbar-back{
    background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.22);
    border-radius:var(--r-sm);padding:6px 10px;
    color:#fff;font-family:'Outfit',sans-serif;font-weight:600;font-size:11px;
    cursor:pointer;display:flex;align-items:center;gap:4px;flex-shrink:0;
}
.quiz-topbar-back:hover{background:rgba(255,255,255,.25)}
.quiz-topbar-title{font-family:'Outfit',sans-serif;color:#fff;font-size:12px;font-weight:700;flex:1;min-width:80px}
.quiz-prog-wrap{height:3px;background:rgba(255,255,255,.2);border-radius:99px;overflow:hidden;margin-top:4px;max-width:160px}
.quiz-prog-fill{height:100%;border-radius:99px;background:rgba(255,255,255,.9);transition:width .5s ease}
.quiz-topbar-score{
    background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
    border-radius:var(--r-sm);padding:4px 12px;text-align:center;flex-shrink:0;
}
.quiz-topbar-score-lbl{font-size:7px;color:rgba(255,255,255,.65);font-weight:700;text-transform:uppercase;letter-spacing:.5px}
.quiz-topbar-score-num{font-family:'Outfit',sans-serif;color:#fff;font-size:16px;font-weight:800;line-height:1}

/* ══ QUIZ LAYOUT ══ */
.quiz-wrap{display:grid;grid-template-columns:1fr 240px;gap:12px;align-items:start}

.q-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--shadow)}

.q-body{ display:flex;flex-direction:column; }

.q-gif{
    background:var(--bg);padding:10px;text-align:center;
    height:min(26vh,190px);min-height:90px;
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    border-bottom:1px solid var(--border);overflow:hidden;
}
.q-gif img,.q-gif video{max-height:100%;max-width:100%;height:100%;border-radius:var(--r);object-fit:contain}
.q-gif-ph{font-size:26px;opacity:.28;margin-bottom:5px}

.q-right{ display:flex;flex-direction:column;min-width:0; }

.q-text{
    font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;
    color:var(--text);padding:10px 12px;border-bottom:1px solid var(--border);line-height:1.35;
    overflow-wrap:break-word;
}

.opt-list{
    padding:8px 10px;
    display:flex;flex-direction:column;gap:6px;
}

.opt-btn{
    display:flex;align-items:center;gap:8px;
    padding:10px 10px;border-radius:var(--r);width:100%;text-align:left;
    background:var(--bg);border:1.5px solid var(--border);
    cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all .15s;
    flex-shrink:0;min-height:44px;
}
.opt-btn:hover:not(:disabled){border-color:var(--accent);background:var(--accent-light)}
.opt-btn:disabled{cursor:not-allowed}
.opt-btn.correct{border-color:var(--accent)!important;background:var(--accent-light)!important}
.opt-btn.wrong{border-color:var(--red)!important;background:var(--red-light)!important}
.opt-lbl{
    width:26px;height:26px;border-radius:7px;
    display:flex;align-items:center;justify-content:center;
    font-family:'Outfit',sans-serif;font-size:11px;font-weight:700;
    flex-shrink:0;background:var(--border);color:var(--text2);transition:all .15s;
}
.opt-btn.correct .opt-lbl{background:var(--accent);color:#fff}
.opt-btn.wrong .opt-lbl{background:var(--red);color:#fff}
.opt-text{font-weight:600;font-size:13px;color:var(--text);flex:1;overflow-wrap:break-word;word-break:break-word;line-height:1.3}
.opt-ico{font-size:15px;flex-shrink:0}

/* ── DESKTOP: video di kiri, pilihan ABCD di kanan, sejajar ── */
@media(min-width:768px){
    .q-body{ flex-direction:row;align-items:stretch; }
    .q-gif{
        flex:0 0 40%;
        height:auto;min-height:340px;
        border-bottom:none;border-right:1px solid var(--border);
    }
    .q-right{ flex:1; }
}

.feedback-box{
    display:flex;align-items:center;gap:9px;
    padding:9px 10px;border-radius:var(--r);margin:0 10px 8px;
    animation:fbIn .2s ease both;
}
.feedback-box.correct{background:var(--accent-light);border:1px solid var(--accent-light2)}
.feedback-box.wrong{background:var(--red-light);border:1px solid rgba(176,58,46,.15)}
.feedback-box > div{overflow-wrap:break-word;min-width:0}
@keyframes fbIn{from{opacity:0;transform:translateY(5px)}to{opacity:1;transform:none}}

.quiz-sidebar{display:flex;flex-direction:column;gap:10px;position:sticky;top:12px}
.q-score-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px;text-align:center}
.q-score-lbl{font-size:9px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.q-score-num{font-family:'Outfit',sans-serif;font-size:38px;font-weight:800;color:var(--text);line-height:1}
.q-score-sub{font-size:10px;color:var(--text2);margin-top:3px}
.q-progress-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:12px}
.q-prog-label{font-size:9px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px}
.q-prog-bar-wrap{background:var(--border);border-radius:99px;height:5px;overflow:hidden;margin-bottom:5px}
.q-prog-bar-fill{height:100%;border-radius:99px;transition:width .5s ease}
.q-prog-frac{font-family:'Outfit',sans-serif;font-size:12px;font-weight:700;color:var(--text)}
.q-tip-card{background:var(--accent-light);border:1px solid var(--accent-light2);border-radius:var(--r-lg);padding:10px 12px}
.q-tip-lbl{font-size:9px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px}
.q-tip-text{font-size:11px;color:var(--accent2);line-height:1.55}

/* ══ RESULT ══ */
.result-wrap{max-width:480px;margin:0 auto;padding:12px 0;text-align:center}
.result-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-xl);padding:28px 20px;box-shadow:var(--shadow-lg)}
.result-icon{font-size:44px;margin-bottom:8px;animation:popIn .4s cubic-bezier(.34,1.4,.64,1) both}
@keyframes popIn{from{opacity:0;transform:scale(.5)}to{opacity:1;transform:scale(1)}}
.result-title{font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;color:var(--text);margin-bottom:5px}
.result-stars{font-size:18px;letter-spacing:3px;margin-bottom:5px}
.result-pct{font-family:'Outfit',sans-serif;font-size:52px;font-weight:800;color:var(--accent);line-height:1;margin:8px 0 5px}
.result-det{font-size:12px;color:var(--text2);margin-bottom:16px}
.result-btns{display:flex;flex-direction:column;gap:8px}
.final-card{background:linear-gradient(135deg,var(--accent-light),var(--accent-light2));border:1px solid var(--accent-light2);border-radius:var(--r-xl);padding:28px 20px;text-align:center}
@keyframes confFall{0%{transform:translateY(-20px) rotate(0);opacity:1}100%{transform:translateY(280px) rotate(720deg);opacity:0}}
.conf{position:fixed;top:0;pointer-events:none;animation:confFall 2.2s ease forwards;z-index:9999}

/* ══ RESPONSIVE ══ */
@media(max-width:860px){
    .quiz-wrap{grid-template-columns:1fr}
    .quiz-sidebar{display:none}
}
@media(max-width:600px){
    .level-grid{grid-template-columns:1fr}
    .main-content{padding:8px 10px !important}
    .q-gif{height:min(22vh,150px)}
}
@media(max-width:460px){
    .opt-text{font-size:13px}
    .q-text{font-size:13px}
    .quiz-topbar-title{font-size:11px}
    .opt-btn{padding:9px 8px}
    .opt-lbl{width:24px;height:24px;font-size:10px}
}
@media(max-height:650px){
    .q-gif{height:min(18vh,120px)}
    .kuis-hero{padding:12px 16px;margin-bottom:10px}
    .level-card{padding:12px 6px}
    .level-emoji{font-size:22px;margin-bottom:4px}
}
</style>
@endpush

@section('content')

{{-- ══ TINGKAT SELECT ══ --}}
<div id="sc-lv" class="screen active">
    <div class="kuis-hero">
        <div class="kuis-hero-pill">🏆 Kuis Interaktif</div>
        <h2>Uji Kemampuanmu!</h2>
        <p>Pilih tingkat kesulitan sesuai kemampuanmu. Soal akan selalu diacak setiap kamu mulai kuis!</p>
    </div>

    <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text);margin-bottom:10px;display:flex;align-items:center;gap:7px">
        <span style="display:inline-block;width:3px;height:14px;background:var(--accent);border-radius:99px"></span>
        Pilih Tingkat Kesulitan
    </div>

    <div class="level-grid">
        @php
        $lvlData = [
            [1, '🟢', 'Mudah',  '5 soal (acak)', '#1B6B45'],
            [2, '🟡', 'Sedang', '5 soal (acak)', '#D68910'],
            [3, '🔴', 'Susah',  '5 soal (acak)', '#B03A2E'],
        ];
        @endphp
        @foreach($lvlData as [$n, $em, $lb, $cnt, $col])
        <div class="level-card fu d{{ $n }}" onclick="startLevel({{ $n }}, '{{ $col }}')" style="border-top:3px solid {{ $col }}">
            <div class="level-emoji">{{ $em }}</div>
            <div class="level-name" style="color:{{ $col }}">{{ $lb }}</div>
            <div class="level-cnt">{{ $cnt }}</div>
            <button class="level-go" style="background:{{ $col }}">
                Mulai <i class="fas fa-arrow-right" style="font-size:10px"></i>
            </button>
        </div>
        @endforeach
    </div>
</div>

{{-- ══ QUIZ ══ --}}
<div id="sc-qz" class="screen">
<div class="quiz-page">
    <div class="quiz-topbar" id="quiz-topbar" style="background:linear-gradient(135deg,#7D3C98,#9B59B6)">
        <button class="quiz-topbar-back" onclick="backToLevels()">
            <i class="fas fa-arrow-left" style="font-size:10px"></i> Keluar
        </button>
        <div style="flex:1">
            <div class="quiz-topbar-title" id="lv-name"></div>
            <div class="quiz-prog-wrap">
                <div class="quiz-prog-fill" id="q-pg" style="width:20%"></div>
            </div>
        </div>
        <div style="color:rgba(255,255,255,.75);font-size:11px;font-weight:600" id="q-cnt">Soal 1</div>
        <div class="quiz-topbar-score">
            <div class="quiz-topbar-score-lbl">Skor</div>
            <div class="quiz-topbar-score-num" id="score">0</div>
        </div>
    </div>

    <div class="quiz-wrap">
        <div>
            <div class="q-card">
                <div class="q-body">
                    <div class="q-gif" id="gif-box">
                        <div class="q-gif-ph">🎬</div>
                        <div style="font-size:12px;font-weight:600;color:var(--text3)">Video Isyarat SIBI</div>
                    </div>
                    <div class="q-right">
                        <div class="q-text" id="q-txt"></div>
                        <div class="opt-list" id="q-opts"></div>
                    </div>
                </div>
            </div>
            <div id="q-fb" style="display:none;margin-top:8px"></div>
        </div>

        <div class="quiz-sidebar">
            <div class="q-score-card">
                <div class="q-score-lbl">Skor Kamu</div>
                <div class="q-score-num" id="score2">0</div>
                <div class="q-score-sub" id="score-lvl-lbl"></div>
            </div>
            <div class="q-progress-card">
                <div class="q-prog-label">Progress Soal</div>
                <div class="q-prog-bar-wrap">
                    <div class="q-prog-bar-fill" id="q-prog2" style="width:20%;background:var(--accent)"></div>
                </div>
                <div class="q-prog-frac" id="q-cnt2">1 / -</div>
            </div>
            <div class="q-tip-card">
                <div class="q-tip-lbl">💡 Tips</div>
                <div class="q-tip-text">Perhatikan gerakan tangan secara seksama. Setiap isyarat memiliki gerakan unik yang membedakannya dari isyarat lain.</div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- ══ RESULT ══ --}}
<div id="sc-res" class="screen">
    <div class="result-wrap">
        <div class="result-card">
            <div class="result-icon">🎊</div>
            <div class="result-title" id="res-ttl">Tingkat Selesai!</div>
            <div class="result-stars" id="res-stars"></div>
            <div class="result-pct" id="res-pct">80%</div>
            <div class="result-det" id="res-det"></div>
            <div class="result-btns">
                <button id="btn-nxt" onclick="nextLevel()"
                    class="btn btn-green" style="justify-content:center;padding:11px;font-size:13px">
                    <span id="btn-nxt-txt"></span>
                </button>
                <button onclick="backToLevels()" class="btn" style="justify-content:center;padding:11px">
                    ← Pilih Tingkat Lain
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ══ FINAL ══ --}}
<div id="sc-fin" class="screen">
    <div class="result-wrap">
        <div class="final-card">
            <div style="font-size:48px;margin-bottom:10px">🏅</div>
            <div style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:var(--accent);margin-bottom:5px">Semua Tingkat Selesai!</div>
            <div style="font-size:12px;color:var(--accent2);margin-bottom:12px">Luar biasa, kamu hebat sekali! 💪</div>
            <div style="font-family:'Outfit',sans-serif;font-size:60px;font-weight:800;color:var(--accent);line-height:1;margin:8px 0 5px" id="fin-pct">90%</div>
            <div style="font-size:12px;color:var(--accent2);margin-bottom:20px" id="fin-det"></div>
            <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
                <button onclick="restartAll()" class="btn btn-green" style="padding:10px 20px">🔄 Main Lagi</button>
                <a href="{{ route('home') }}" class="btn" style="padding:10px 20px">🏠 Beranda</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name=csrf-token]').content;
let lv=1, qs=[], qi=0, sc=0, ans=false, tB=0, tS=0, lvColor='#1B6B45';

function show(id) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    window.scrollTo(0,0);
}

const lvLabels = {
    1:'🟢 Tingkat Mudah',
    2:'🟡 Tingkat Sedang',
    3:'🔴 Tingkat Susah',
};

async function startLevel(level, color) {
    lv=level; qi=0; sc=0; ans=false; lvColor=color||'#1B6B45';
    document.getElementById('lv-name').textContent      = lvLabels[level];
    document.getElementById('score-lvl-lbl').textContent= lvLabels[level];
    document.getElementById('quiz-topbar').style.background=`linear-gradient(135deg,${lvColor},${lvColor}cc)`;
    try { const r=await fetch(`/kuis/soal/${level}`); qs=await r.json(); }
    catch { qs=demoQs(); }
    show('sc-qz'); renderQ();
}

function renderQ() {
    if (qi>=qs.length) { lvResult(); return; }
    const q=qs[qi]; ans=false;
    const frac=`${qi+1} / ${qs.length}`;
    const pct=((qi+1)/qs.length*100).toFixed(0)+'%';
    document.getElementById('q-cnt').textContent=`Soal ${qi+1} dari ${qs.length}`;
    document.getElementById('q-cnt2').textContent=frac;
    document.getElementById('q-pg').style.width=pct;
    document.getElementById('q-prog2').style.width=pct;
    document.getElementById('score').textContent=sc;
    document.getElementById('score2').textContent=sc;
    document.getElementById('q-txt').textContent=q.pertanyaan;
    document.getElementById('q-fb').style.display='none';

    const gif=document.getElementById('gif-box');
    if (q.gif_soal) {
        const src = q.gif_soal.startsWith('/') ? q.gif_soal : '/' + q.gif_soal;
        const ext = q.gif_soal.split('.').pop().toLowerCase();
        if (['mp4','webm','mov'].includes(ext)) {
            gif.innerHTML = `<video src="${src}" autoplay loop muted playsinline style="max-height:100%;max-width:100%;height:100%;border-radius:var(--r);object-fit:contain" onerror="this.parentElement.innerHTML='<div class=q-gif-ph>🎬</div><div style=font-size:12px;font-weight:600;color:var(--text3)>Video tidak tersedia</div>'"></video>`;
        } else {
            gif.innerHTML = `<img src="${src}" style="max-height:100%;max-width:100%;height:100%;border-radius:var(--r);object-fit:contain" onerror="this.parentElement.innerHTML='<div class=q-gif-ph>🎬</div><div style=font-size:12px;font-weight:600;color:var(--text3)>Video tidak tersedia</div>'">`;
        }
    } else {
        gif.innerHTML = `<div class="q-gif-ph">🎬</div><div style="font-size:12px;font-weight:600;color:var(--text3)">Video Isyarat SIBI</div>`;
    }

    const opts=document.getElementById('q-opts');
    opts.innerHTML='';
    [['a',q.pilihan_a],['b',q.pilihan_b],['c',q.pilihan_c],['d',q.pilihan_d]].forEach(([id,txt])=>{
        if(!txt) return;
        const b=document.createElement('button');
        b.className='opt-btn';
        b.innerHTML=`<span class="opt-lbl">${id.toUpperCase()}</span><span class="opt-text">${txt}</span><span class="opt-ico"></span>`;
        b.onclick=()=>doAnswer(id,q.jawaban_benar);
        opts.appendChild(b);
    });
    opts.scrollTop=0;
}

function doAnswer(chosen,correct) {
    if(ans) return; ans=true;
    const ok=chosen===correct;
    if(ok) sc++;
    document.querySelectorAll('.opt-btn').forEach(b=>{
        b.disabled=true;
        const id=b.querySelector('.opt-lbl').textContent.trim().toLowerCase();
        const ico=b.querySelector('.opt-ico');
        if(id===correct){b.classList.add('correct');ico.textContent='✓';}
        else if(id===chosen&&!ok){b.classList.add('wrong');ico.textContent='✗';}
    });
    const fb=document.getElementById('q-fb');
    fb.style.display='flex';
    fb.className='feedback-box '+(ok?'correct':'wrong');
    if(ok){
        fb.innerHTML=`<span style="font-size:20px">🎉</span><div><div style="font-weight:700;color:var(--accent);font-size:13px">Benar! Hebat!</div><div style="font-size:11px;color:var(--accent2)">Pertahankan terus!</div></div>`;
        confetti();
    } else {
        const corTxt=qs[qi]['pilihan_'+correct];
        fb.innerHTML=`<span style="font-size:20px">😢</span><div><div style="font-weight:700;color:var(--red);font-size:13px">Salah!</div><div style="font-size:11px;color:var(--text2)">Jawaban benar: <strong>${correct.toUpperCase()}. ${corTxt}</strong></div></div>`;
    }
    setTimeout(()=>{qi++;renderQ();},2000);
}

async function lvResult() {
    tB+=sc; tS+=qs.length;
    const pct=qs.length ? Math.round(sc/qs.length*100) : 0;
    document.getElementById('res-ttl').textContent=`${lvLabels[lv]} Selesai!`;
    document.getElementById('res-pct').textContent=pct+'%';
    document.getElementById('res-stars').textContent=[1,2,3,4,5].map(i=>pct>=i*20?'⭐':'☆').join('');
    document.getElementById('res-det').textContent=`${sc} benar dari ${qs.length} soal`;
    const nb=document.getElementById('btn-nxt');
    const nt=document.getElementById('btn-nxt-txt');

    try {
        await fetch('/kuis/simpan',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({level:lv,benar:sc,total_soal:qs.length})});
    } catch(e) {}

    if(lv<3){
        nt.textContent=`Lanjut ${lvLabels[lv+1]} →`;
        nb.style.display='flex';
        nb.style.opacity='1';
        nb.disabled=false;
    } else {
        nb.style.display='none';
        setTimeout(showFinal,400);
        return;
    }
    show('sc-res'); confetti(); confetti();
}

function showFinal() {
    const pct=tS ? Math.round(tB/tS*100) : 0;
    document.getElementById('fin-pct').textContent=pct+'%';
    document.getElementById('fin-det').textContent=`${tB} benar dari ${tS} soal`;
    show('sc-fin');
    for(let i=0;i<4;i++) setTimeout(confetti,i*250);
}

function nextLevel(){startLevel(lv+1,lv+1===2?'#D68910':'#B03A2E');}
function backToLevels(){tB=0;tS=0;show('sc-lv');}
function restartAll(){tB=0;tS=0;show('sc-lv');}

function confetti(){
    const e=['🎉','⭐','✨','🌟','🏆','🎊','💚','🔥','🎈'];
    for(let i=0;i<14;i++){
        const el=document.createElement('div');
        el.className='conf';el.textContent=e[Math.floor(Math.random()*e.length)];
        el.style.left=(Math.random()*100)+'vw';
        el.style.animationDelay=(Math.random()*.8)+'s';
        el.style.fontSize=(16+Math.random()*14)+'px';
        document.body.appendChild(el);setTimeout(()=>el.remove(),2800);
    }
}

function demoQs(){return[
    {pertanyaan:'Tunjukkan angka 1!',gif_soal:'',pilihan_a:'1',pilihan_b:'2',pilihan_c:'3',pilihan_d:'4',jawaban_benar:'a'},
    {pertanyaan:'Siapa ini?',gif_soal:'',pilihan_a:'Ibu',pilihan_b:'Ayah',pilihan_c:'Kakak',pilihan_d:'Adik',jawaban_benar:'b'},
    {pertanyaan:'Nama benda ini?',gif_soal:'',pilihan_a:'Buku',pilihan_b:'Pensil',pilihan_c:'Pulpen',pilihan_d:'Penghapus',jawaban_benar:'b'},
];}
</script>
@endpush