@extends('layouts.siswa')
@section('title','Profil Saya – SIBI')

@push('styles')
<style>
.profil-hero{background:linear-gradient(135deg,var(--accent) 0%,var(--accent2) 100%);border-radius:var(--r-lg);padding:28px 20px 24px;color:#fff;text-align:center;position:relative;overflow:hidden;margin-bottom:16px}
.profil-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;pointer-events:none}
.avatar-ring{width:80px;height:80px;border-radius:50%;border:3px solid rgba(255,255,255,.4);background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:'Outfit',sans-serif;font-size:32px;font-weight:900;color:#fff;position:relative;z-index:1}
.profil-name{font-family:'Outfit',sans-serif;font-size:22px;font-weight:900;letter-spacing:-.5px;position:relative;z-index:1}
.profil-kelas{font-size:12px;opacity:.75;margin-top:4px;position:relative;z-index:1}
.profil-email{font-size:11px;opacity:.6;margin-top:3px;position:relative;z-index:1}

.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:16px}
.stat-box{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:14px 10px;text-align:center}
.stat-num{font-family:'Outfit',sans-serif;font-size:24px;font-weight:900;color:var(--accent)}
.stat-lbl{font-size:10px;color:var(--text3);font-weight:600;margin-top:2px;line-height:1.3}

.section-title{font-family:'Outfit',sans-serif;font-size:15px;font-weight:800;color:var(--text);margin-bottom:12px;display:flex;align-items:center;gap:7px}

.kat-row{display:flex;align-items:center;gap:10px;margin-bottom:12px}
.kat-icon{width:36px;height:36px;border-radius:10px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.kat-info{flex:1}
.kat-name{font-size:13px;font-weight:700;color:var(--text);text-transform:capitalize;margin-bottom:4px}
.kat-pct{font-size:12px;font-weight:700;color:var(--accent)}

.chart-wrap{background:var(--surface);border:1px solid var(--border);border-radius:var(--r);padding:16px;margin-bottom:16px}
.chart-canvas-wrap{position:relative;height:200px}

.biodata-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px}
.bd-item{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px}
.bd-label{font-size:10px;color:var(--text3);font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px}
.bd-value{font-size:14px;font-weight:700;color:var(--text)}

.empty-chart{text-align:center;padding:40px 20px;color:var(--text3);font-size:13px}
</style>
@endpush

@section('content')
{{-- HERO PROFIL --}}
<div class="profil-hero fu">
    <div class="avatar-ring">{{ strtoupper(substr($user->name,0,2)) }}</div>
    <div class="profil-name">{{ $user->name }}</div>
    <div class="profil-kelas">📚 Kelas {{ $user->kelas ?: '–' }}</div>
    <div class="profil-email">✉️ {{ $user->email }}</div>
</div>

{{-- STATS --}}
<div class="stats-row fu d1">
    <div class="stat-box">
        <div class="stat-num">{{ $totalKuis }}</div>
        <div class="stat-lbl">Kuis Selesai</div>
    </div>
    <div class="stat-box">
        <div class="stat-num">{{ $skorTertinggi }}</div>
        <div class="stat-lbl">Skor Tertinggi</div>
    </div>
    <div class="stat-box">
        <div class="stat-num">{{ round($totalProgress) }}%</div>
        <div class="stat-lbl">Progress Belajar</div>
    </div>
</div>

{{-- BIODATA --}}
<div class="card fu d2" style="margin-bottom:16px">
    <div class="section-title">👤 Data Diri</div>
    <div class="biodata-grid">
        <div class="bd-item">
            <div class="bd-label">Nama Lengkap</div>
            <div class="bd-value">{{ $user->name }}</div>
        </div>
        <div class="bd-item">
            <div class="bd-label">Kelas</div>
            <div class="bd-value">{{ $user->kelas ?: 'Belum diisi' }}</div>
        </div>
        <div class="bd-item">
            <div class="bd-label">Email</div>
            <div class="bd-value" style="font-size:12px;word-break:break-all">{{ $user->email }}</div>
        </div>
        <div class="bd-item">
            <div class="bd-label">Bergabung</div>
            <div class="bd-value">{{ $user->created_at->format('d M Y') }}</div>
        </div>
    </div>
    <div style="background:var(--accent-light);border-radius:var(--r-sm);padding:10px 14px;display:flex;align-items:center;gap:8px">
        <span style="font-size:16px">🏅</span>
        <span style="font-size:12px;font-weight:700;color:var(--accent)">Rata-rata skor kuis: <strong>{{ $skorRata }}</strong></span>
    </div>
</div>

{{-- PROGRESS MODUL --}}
<div class="card fu d3" style="margin-bottom:16px">
    <div class="section-title">📖 Progress Belajar Modul</div>
    @foreach($progress as $kat => $data)
    @php
    $icons = ['angka'=>'🔢','keluarga'=>'👨‍👩‍👧','benda'=>'📦','sapaan'=>'👋'];
    @endphp
    <div class="kat-row">
        <div class="kat-icon">{{ $icons[$kat] ?? '📘' }}</div>
        <div class="kat-info">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="kat-name">{{ ucfirst($kat) }}</div>
                <div class="kat-pct">{{ $data['persen'] }}%</div>
            </div>
            <div class="prog-bar">
                <div class="prog-fill" style="width:{{ $data['persen'] }}%"></div>
            </div>
            <div style="font-size:10px;color:var(--text3);margin-top:3px">{{ $data['seen'] }} / {{ $data['total'] }} konten</div>
        </div>
    </div>
    @endforeach
</div>

{{-- CHART PROGRES KUIS --}}
<div class="chart-wrap fu d4">
    <div class="section-title">📈 Grafik Skor Kuis</div>
    @if($chartData->count() > 0)
    <div class="chart-canvas-wrap">
        <canvas id="progressChart"></canvas>
    </div>
    @else
    <div class="empty-chart">
        <div style="font-size:40px;margin-bottom:10px">🏆</div>
        <div style="font-weight:700;color:var(--text);margin-bottom:4px">Belum ada data kuis</div>
        <div>Selesaikan kuis pertamamu untuk melihat grafik progresmu!</div>
    </div>
    @endif
</div>

{{-- AKTIVITAS TERAKHIR --}}
@if(isset($activityLogs) && $activityLogs->count() > 0)
<div class="card fu" style="margin-bottom:16px">
    <div class="section-title">📋 Aktivitas Terakhir</div>
    <div style="display:flex;flex-direction:column;gap:8px">
        @foreach($activityLogs as $log)
        <div style="display:flex;gap:10px;align-items:flex-start;padding:10px 12px;background:var(--surface);border-radius:10px;border:1px solid var(--border)">
            <div style="width:8px;height:8px;border-radius:50%;background:{{ $log->tipe==='kuis'?'#F59E0B':($log->tipe==='modul'?'#1A4F8B':'#10B981') }};flex-shrink:0;margin-top:5px"></div>
            <div style="flex:1">
                <div style="font-size:13px;font-weight:600;color:var(--text)">{{ $log->deskripsi }}</div>
                <div style="font-size:11px;color:var(--text3);margin-top:2px">{{ $log->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('scripts')
@if($chartData->count() > 0)
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
const labels = {!! json_encode($chartLabels->values()->toArray()) !!};
const scores = {!! json_encode($chartData->values()->toArray()) !!};

const ctx = document.getElementById('progressChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Skor Kuis',
            data: scores,
            borderColor: '#1A4F8B',
            backgroundColor: 'rgba(26,79,139,0.08)',
            borderWidth: 2.5,
            pointBackgroundColor: '#1A4F8B',
            pointRadius: 5,
            pointHoverRadius: 7,
            tension: 0.35,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#0D1B2E',
                bodyColor: '#1A4F8B',
                borderColor: '#D1E3F8',
                borderWidth: 1,
                padding: 10,
                callbacks: {
                    label: ctx => ' Skor: ' + ctx.parsed.y
                }
            }
        },
        scales: {
            x: {
                grid: { color: '#EEF4FB' },
                ticks: { font: { size: 10 }, color: '#4A637E', maxRotation: 30 }
            },
            y: {
                min: 0, max: 100,
                grid: { color: '#EEF4FB' },
                ticks: { font: { size: 10 }, color: '#4A637E',
                    callback: v => v + ' pts'
                }
            }
        }
    }
});
</script>
@endif
@endpush
