@extends('layouts.guru')
@section('title','Tambah Soal Kuis')
@section('page-title','Tambah Soal Kuis')
@section('page-subtitle','Buat soal baru untuk bank kuis')

@push('styles')
<style>
.flbl{display:block;font-size:11px;font-weight:700;color:var(--text2);text-transform:uppercase;letter-spacing:.6px;margin-bottom:6px}
.ferr{color:var(--red);font-size:12px;font-weight:600;margin-top:5px;display:flex;align-items:center;gap:5px}
</style>
@endpush

@section('content')
<div style="max-width:720px">

    {{-- BREADCRUMB --}}
    <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text3);margin-bottom:20px">
        <a href="{{ route('guru.kuis.index') }}" style="color:var(--accent);font-weight:600;text-decoration:none">Soal Kuis</a>
        <i class="fas fa-chevron-right" style="font-size:9px"></i>
        <span>Tambah Baru</span>
    </div>

    <div class="adm-card">
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px">
            <div style="width:36px;height:36px;background:var(--yellow-light);border-radius:10px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-plus" style="color:var(--yellow);font-size:14px"></i>
            </div>
            <div>
                <div style="font-family:'Outfit',sans-serif;font-size:14px;font-weight:700;color:var(--text)">Form Tambah Soal</div>
                <div style="font-size:11px;color:var(--text3)">Isi semua kolom yang bertanda * (wajib diisi)</div>
            </div>
        </div>

        <div style="padding:24px">
            <form method="POST" action="{{ route('guru.kuis.store') }}">
                @csrf
                @include('guru.kuis._form', ['soal' => null])
                <div style="display:flex;gap:10px;margin-top:26px;padding-top:20px;border-top:1px solid var(--border)">
                    <button type="submit" class="btn-p">
                        <i class="fas fa-save"></i> Simpan Soal
                    </button>
                    <a href="{{ route('guru.kuis.index') }}" class="btn-s">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
