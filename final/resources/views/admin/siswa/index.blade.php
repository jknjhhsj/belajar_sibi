@extends('layouts.admin')
@section('title','Data Siswa')
@section('page-title','Data Siswa')
@section('page-subtitle','Pantau perkembangan siswa tunarungu')

@section('content')

{{-- ── STAT CARDS: hanya Total Siswa, Aktif, Nonaktif ── --}}
<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px">

    <div style="background:var(--surf);border:1px solid var(--border);border-radius:var(--r);padding:14px 18px;display:flex;align-items:center;gap:12px">
        <div style="width:38px;height:38px;background:var(--accent-light);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px">👥</div>
        <div>
            <div style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:var(--text);line-height:1">{{ $siswa->total() }}</div>
            <div style="font-size:11px;font-weight:600;color:var(--text3);margin-top:1px">Total Siswa</div>
        </div>
    </div>

    <div style="background:var(--surf);border:1px solid var(--border);border-radius:var(--r);padding:14px 18px;display:flex;align-items:center;gap:12px">
        <div style="width:38px;height:38px;background:#DCFCE7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px">✅</div>
        <div>
            <div style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:var(--text);line-height:1">{{ $siswa->where('status','aktif')->count() }}</div>
            <div style="font-size:11px;font-weight:600;color:var(--text3);margin-top:1px">Aktif</div>
        </div>
    </div>

    <div style="background:var(--surf);border:1px solid var(--border);border-radius:var(--r);padding:14px 18px;display:flex;align-items:center;gap:12px">
        <div style="width:38px;height:38px;background:#FEE2E2;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px">🚫</div>
        <div>
            <div style="font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:var(--text);line-height:1">{{ $siswa->where('status','nonaktif')->count() }}</div>
            <div style="font-size:11px;font-weight:600;color:var(--text3);margin-top:1px">Nonaktif</div>
        </div>
    </div>

</div>

{{-- ── TABEL SISWA ── --}}
<div class="adm-card">
    <div style="padding:14px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:34px;height:34px;background:var(--accent-light);border-radius:9px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-user-group" style="color:var(--accent);font-size:13px"></i>
            </div>
            <div>
                <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text)">Daftar Siswa / Pengguna</div>
                <div style="font-size:11px;color:var(--text3)">Klik nama siswa untuk melihat detail perkembangan</div>
            </div>
        </div>
    </div>
    <div style="overflow-x:auto">
        <table class="tbl" style="min-width:600px">
            <thead><tr>
                @foreach(['Siswa','Kelas','Skor Total','Kuis Selesai','Status','Bergabung','Aksi'] as $h)
                <th>{{ $h }}</th>
                @endforeach
            </tr></thead>
            <tbody>
            @forelse($siswa as $s)
            <tr>
                <td>
                    <a href="{{ route('admin.siswa.show',$s) }}" style="display:flex;align-items:center;gap:11px;text-decoration:none">
                        <div style="width:38px;height:38px;border-radius:11px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-family:'Outfit',sans-serif;font-size:16px;font-weight:800;flex-shrink:0">
                            {{ strtoupper(substr($s->name,0,1)) }}
                        </div>
                        <div>
                            <div style="font-weight:700;color:var(--text);font-size:13px;line-height:1.2">{{ $s->name }}</div>
                            <div style="font-size:11px;color:var(--text3)">{{ $s->email }}</div>
                        </div>
                    </a>
                </td>
                <td style="font-size:13px;color:var(--text2)">{{ $s->kelas ?? '—' }}</td>
                <td>
                    <span style="font-family:'Outfit',sans-serif;font-weight:800;font-size:15px;color:{{ ($s->total_skor??0)>0?'var(--accent)':'var(--text3)' }}">
                        {{ $s->total_skor ?? 0 }}
                    </span>
                    <span style="font-size:10px;color:var(--text3)"> pts</span>
                </td>
                <td style="font-size:13px;font-weight:600;color:var(--text2)">{{ $s->total_kuis ?? 0 }}x</td>
                <td>
                    @if($s->status === 'aktif')
                    <span class="badge" style="background:#DCFCE7;color:#16A34A;border:1px solid #BBF7D0"><i class="fas fa-circle" style="font-size:6px"></i> Aktif</span>
                    @else
                    <span class="badge" style="background:var(--red-light);color:var(--red);border:1px solid #FECACA"><i class="fas fa-circle" style="font-size:6px"></i> Nonaktif</span>
                    @endif
                </td>
                <td style="font-size:12px;color:var(--text3)">{{ $s->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:6px;align-items:center">
                        <a href="{{ route('admin.siswa.show',$s) }}" class="btn-s" style="font-size:11px;padding:6px 11px;color:var(--accent);border-color:var(--accent-light2);background:var(--accent-light)">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="padding:60px;text-align:center">
                <div style="font-size:36px;margin-bottom:12px">👤</div>
                <div style="font-family:'Outfit',sans-serif;font-size:16px;font-weight:700;color:var(--text);margin-bottom:5px">Belum Ada Siswa</div>
                <div style="font-size:13px;color:var(--text3)">Siswa yang mendaftar akan muncul di sini.</div>
            </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($siswa->hasPages())
    @if(method_exists($siswa, 'hasPages') && $siswa->hasPages())
    <div style="padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;gap:8px;flex-wrap:wrap">
        @if($siswa->onFirstPage())
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">← Prev</span>
        @else
            <a href="{{ $siswa->previousPageUrl() }}" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">← Prev</a>
        @endif
        @foreach($siswa->getUrlRange(1, $siswa->lastPage()) as $page => $url)
            @if($page == $siswa->currentPage())
                <span style="padding:7px 12px;border-radius:8px;background:var(--accent);color:#fff;font-size:13px;font-weight:700">{{ $page }}</span>
            @else
                <a href="{{ $url }}" style="padding:7px 12px;border-radius:8px;background:var(--surface);color:var(--text);font-size:13px;border:1px solid var(--border);text-decoration:none">{{ $page }}</a>
            @endif
        @endforeach
        @if($siswa->hasMorePages())
            <a href="{{ $siswa->nextPageUrl() }}" style="padding:7px 14px;border-radius:8px;background:var(--surface);color:var(--accent);font-size:13px;font-weight:600;border:1px solid var(--border);text-decoration:none">Next →</a>
        @else
            <span style="padding:7px 14px;border-radius:8px;background:var(--bg);color:var(--text3);font-size:13px;border:1px solid var(--border)">Next →</span>
        @endif
    </div>
    @endif
    @endif
</div>
@endsection
