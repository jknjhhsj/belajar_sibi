@extends('layouts.admin')
@section('title','Detail — '.$user->name)
@section('page-title','Detail Siswa')
@section('page-subtitle','Perkembangan belajar '.$user->name)

@push('styles')
<style>
.chart-wrap { position:relative; width:100%; height:240px; }
.prog-bar-h { height:10px; background:var(--border); border-radius:99px; overflow:hidden; margin-top:5px; }
.prog-fill-h { height:100%; border-radius:99px; transition:width 1s cubic-bezier(.34,1,.64,1); }
.badge-level { display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; border-radius:8px; font-family:'Outfit',sans-serif; font-size:13px; font-weight:800; }
</style>
@endpush

@section('content')

{{-- PROFIL --}}
<div class="adm-card fu" style="margin-bottom:20px">
  <div style="padding:24px;display:flex;align-items:center;gap:20px;flex-wrap:wrap">
    <div style="width:72px;height:72px;border-radius:18px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:var(--accent);flex-shrink:0">
      {{ strtoupper(substr($user->name,0,1)) }}
    </div>
    <div style="flex:1;min-width:200px">
      <div style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:var(--text);margin-bottom:4px">{{ $user->name }}</div>
      <div style="font-size:13px;color:var(--text3);margin-bottom:8px">{{ $user->email }}</div>
      <div style="display:flex;gap:8px;flex-wrap:wrap">
        @if($user->kelas)
        <span style="background:var(--accent-light);color:var(--accent);font-size:11px;font-weight:700;padding:3px 10px;border-radius:99px">Kelas {{ $user->kelas }}</span>
        @endif
        <span style="background:{{ $user->status==='aktif'?'#DCFCE7':'#FEE2E2' }};color:{{ $user->status==='aktif'?'#16A34A':'#DC2626' }};font-size:11px;font-weight:700;padding:3px 10px;border-radius:99px">{{ ucfirst($user->status) }}</span>
        <span style="background:var(--bg);color:var(--text3);font-size:11px;font-weight:600;padding:3px 10px;border-radius:99px">Bergabung {{ $user->created_at->format('d M Y') }}</span>
      </div>
    </div>
  </div>
</div>

{{-- STAT CARDS --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px">
  <div class="adm-card fu d1" style="padding:18px 20px">
    <div style="font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Total Skor</div>
    <div style="font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:var(--accent)">{{ $totalSkor }}</div>
    <div style="font-size:12px;color:var(--text3);margin-top:2px">poin terkumpul</div>
  </div>
  <div class="adm-card fu d2" style="padding:18px 20px">
    <div style="font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Level Tertinggi</div>
    <div style="font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:var(--yellow)">{{ $levelTercapai }}</div>
    <div style="font-size:12px;color:var(--text3);margin-top:2px">dari 3 tingkat</div>
  </div>
  <div class="adm-card fu d3" style="padding:18px 20px">
    <div style="font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Kuis Selesai</div>
    <div style="font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:var(--blue)">{{ $hasilKuis->count() }}</div>
    <div style="font-size:12px;color:var(--text3);margin-top:2px">sesi pengerjaan</div>
  </div>
  <div class="adm-card fu d1" style="padding:18px 20px">
    <div style="font-size:11px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">Total Aktivitas</div>
    <div style="font-family:'Outfit',sans-serif;font-size:28px;font-weight:900;color:var(--accent)">{{ $activityLogs->count() }}</div>
    <div style="font-size:12px;color:var(--text3);margin-top:2px">interaksi tercatat</div>
  </div>
</div>

{{-- DIAGRAM PERKEMBANGAN BULANAN --}}
<div class="adm-card fu" style="margin-bottom:20px">
  <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
    <div>
      <div style="font-family:'Outfit',sans-serif;font-size:15px;font-weight:800;color:var(--text)">📈 Diagram Perkembangan Bulanan</div>
      <div style="font-size:12px;color:var(--text3);margin-top:2px">Skor rata-rata & jumlah kuis per bulan (12 bulan terakhir)</div>
    </div>
    <div style="display:flex;gap:16px;font-size:12px">
      <span style="display:flex;align-items:center;gap:6px"><span style="width:12px;height:12px;border-radius:3px;background:#2563B0;display:inline-block"></span>Skor Rata-rata (%)</span>
      <span style="display:flex;align-items:center;gap:6px"><span style="width:12px;height:12px;border-radius:3px;background:#10B981;display:inline-block"></span>Jumlah Kuis</span>
      <span style="display:flex;align-items:center;gap:6px"><span style="width:12px;height:12px;border-radius:3px;background:#F59E0B;display:inline-block"></span>Aktivitas</span>
    </div>
  </div>
  <div style="padding:20px">
    <div class="chart-wrap">
      <canvas id="chartPerkembangan"></canvas>
    </div>
  </div>
</div>

{{-- PROGRESS MODUL + HASIL KUIS --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px">

  {{-- PROGRESS MODUL --}}
  <div class="adm-card fu d1">
    <div style="padding:14px 18px;border-bottom:1px solid var(--border);font-family:'Outfit',sans-serif;font-size:14px;font-weight:700">📚 Progress Modul</div>
    <div style="padding:16px 18px;display:flex;flex-direction:column;gap:14px">
      @foreach(['angka'=>['🔢','#2563B0'],'keluarga'=>['👪','#7C3AED'],'benda'=>['📚','#D97706'],'sapaan'=>['👋','#059669']] as $kat=>[$ico,$color])
      @php $p = $kategoriProgress[$kat] ?? ['seen'=>0,'total'=>0,'pct'=>0]; @endphp
      <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:5px">
          <span style="font-size:13px;font-weight:600;color:var(--text)">{{ $ico }} {{ ucfirst($kat) }}</span>
          <span style="font-family:'Outfit',sans-serif;font-size:13px;font-weight:700;color:{{ $color }}">{{ $p['seen'] }}/{{ $p['total'] }} konten</span>
        </div>
        <div class="prog-bar-h">
          <div class="prog-fill-h" style="width:{{ $p['pct'] }}%;background:{{ $color }}"></div>
        </div>
        <div style="font-size:11px;color:var(--text3);margin-top:3px">{{ $p['pct'] }}% selesai</div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- HASIL KUIS PER LEVEL --}}
  <div class="adm-card fu d2">
    <div style="padding:14px 18px;border-bottom:1px solid var(--border);font-family:'Outfit',sans-serif;font-size:14px;font-weight:700">🏆 Hasil Kuis per Level</div>
    @if($hasilKuis->isEmpty())
    <div style="padding:40px;text-align:center;color:var(--text3);font-size:13px">
      <div style="font-size:32px;margin-bottom:8px">📋</div>
      Belum ada kuis yang dikerjakan.
    </div>
    @else
    <div style="overflow-x:auto">
      <table class="tbl">
        <thead><tr><th>Level</th><th>Skor</th><th>Benar</th><th>Tanggal</th></tr></thead>
        <tbody>
        @foreach($hasilKuis->sortByDesc('created_at') as $h)
        <tr>
          <td>
            <span class="badge-level" style="background:{{ ['','#DBEAFE','#FEF3C7','#D1FAE5','#FEE2E2','#EDE9FE'][$h->level] ?? '#F1F5F9' }};color:{{ ['','#1D4ED8','#D97706','#059669','#DC2626','#7C3AED'][$h->level] ?? '#64748B' }}">
              L{{ $h->level }}
            </span>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:8px">
              <div style="width:40px;height:5px;background:var(--border);border-radius:99px;overflow:hidden">
                <div style="height:100%;width:{{ $h->skor }}%;background:{{ $h->skor >= 80 ? '#10B981' : ($h->skor >= 60 ? '#F59E0B' : '#EF4444') }};border-radius:99px"></div>
              </div>
              <span style="font-family:'Outfit',sans-serif;font-weight:800;font-size:15px;color:{{ $h->skor >= 80 ? '#10B981' : ($h->skor >= 60 ? '#D97706' : '#DC2626') }}">{{ $h->skor }}%</span>
            </div>
          </td>
          <td style="font-weight:600">{{ $h->benar }}/{{ $h->total_soal }}</td>
          <td style="font-size:12px;color:var(--text3)">{{ $h->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>

</div>

{{-- AKTIVITAS TERAKHIR --}}
<div class="adm-card fu d3">
  <div style="padding:14px 18px;border-bottom:1px solid var(--border);font-family:'Outfit',sans-serif;font-size:14px;font-weight:700">📋 Aktivitas Terakhir</div>
  @if($activityLogs->isEmpty())
  <div style="padding:40px;text-align:center;color:var(--text3);font-size:13px">
    <div style="font-size:32px;margin-bottom:8px">📭</div>
    Belum ada aktivitas tercatat.
  </div>
  @else
  <div style="padding:12px 16px;display:grid;grid-template-columns:1fr 1fr;gap:8px">
    @foreach($activityLogs as $log)
    <div style="display:flex;gap:10px;align-items:flex-start;padding:10px 12px;background:var(--bg);border-radius:10px">
      <div style="width:8px;height:8px;border-radius:50%;background:{{ $log->tipe==='kuis'?'var(--yellow)':($log->tipe==='modul'?'var(--accent)':'#10B981') }};flex-shrink:0;margin-top:4px"></div>
      <div style="flex:1;min-width:0">
        <div style="font-size:12px;font-weight:600;color:var(--text);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $log->deskripsi }}</div>
        <div style="font-size:11px;color:var(--text3);margin-top:2px">{{ $log->created_at->diffForHumans() }}</div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
const labels = @json($bulanLabels);
const skorData = @json($skorBulanan);
const kuisData = @json($kuisBulanan);
const aktData  = @json($aktivitasBulanan);

const ctx = document.getElementById('chartPerkembangan').getContext('2d');
new Chart(ctx, {
  data: {
    labels: labels,
    datasets: [
      {
        type: 'line',
        label: 'Skor Rata-rata (%)',
        data: skorData,
        borderColor: '#2563B0',
        backgroundColor: 'rgba(37,99,176,.08)',
        borderWidth: 2.5,
        pointBackgroundColor: '#2563B0',
        pointRadius: 4,
        pointHoverRadius: 6,
        fill: true,
        tension: 0.4,
        yAxisID: 'y',
      },
      {
        type: 'bar',
        label: 'Jumlah Kuis',
        data: kuisData,
        backgroundColor: 'rgba(16,185,129,.25)',
        borderColor: '#10B981',
        borderWidth: 1.5,
        borderRadius: 6,
        yAxisID: 'y2',
      },
      {
        type: 'bar',
        label: 'Aktivitas',
        data: aktData,
        backgroundColor: 'rgba(245,158,11,.2)',
        borderColor: '#F59E0B',
        borderWidth: 1.5,
        borderRadius: 6,
        yAxisID: 'y2',
      },
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1E293B',
        titleColor: '#F1F5F9',
        bodyColor: '#CBD5E1',
        padding: 12,
        cornerRadius: 10,
        callbacks: {
          label: ctx => {
            if (ctx.dataset.label === 'Skor Rata-rata (%)') return ` Skor: ${Math.round(ctx.raw)}%`;
            if (ctx.dataset.label === 'Jumlah Kuis') return ` Kuis: ${ctx.raw}x`;
            return ` Aktivitas: ${ctx.raw}x`;
          }
        }
      }
    },
    scales: {
      x: {
        grid: { color: 'rgba(0,0,0,.04)' },
        ticks: { font: { size: 11 }, color: '#94A3B8' }
      },
      y: {
        type: 'linear',
        position: 'left',
        min: 0, max: 100,
        grid: { color: 'rgba(0,0,0,.04)' },
        ticks: {
          font: { size: 11 }, color: '#2563B0',
          callback: v => v + '%'
        },
        title: { display: true, text: 'Skor (%)', color: '#2563B0', font: { size: 11 } }
      },
      y2: {
        type: 'linear',
        position: 'right',
        min: 0,
        grid: { drawOnChartArea: false },
        ticks: { font: { size: 11 }, color: '#10B981' },
        title: { display: true, text: 'Jumlah', color: '#10B981', font: { size: 11 } }
      }
    }
  }
});
</script>
@endpush
