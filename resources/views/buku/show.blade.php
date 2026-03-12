@extends('layouts.public')

@section('title', $buku->judul)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/daftar/buku') }}"><i class="bi bi-book"></i> Perpustakaan</a></li>
<li class="breadcrumb-item active">Detail Buku</li>
@endsection

@section('content')

<style>
/* ══ BUKU DETAIL ══ */
.buku-detail-wrap{max-width:900px;margin:0 auto;padding:0 0 60px;}

/* Hero card dengan cover + info utama */
.buku-hero{background:#fff;border:1.5px solid #e5e7eb;border-radius:20px;overflow:hidden;margin-bottom:20px;box-shadow:0 4px 24px rgba(10,22,40,.07);}
.buku-hero-inner{display:flex;min-height:260px;}

/* Cover panel kiri */
.buku-cover-panel{width:200px;flex-shrink:0;background:linear-gradient(155deg,#0a1628,#1e3d70);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:28px 20px;gap:16px;position:relative;overflow:hidden;}
.buku-cover-panel::before{content:'';position:absolute;inset:0;background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:18px 18px;}
.buku-cover-panel::after{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(240,180,41,.06);}
.buku-cover-img{width:130px;height:175px;border-radius:8px;object-fit:cover;box-shadow:0 12px 36px rgba(0,0,0,.45);position:relative;z-index:1;border:2px solid rgba(255,255,255,.15);}
.buku-cover-ph{width:130px;height:175px;border-radius:8px;background:rgba(255,255,255,.07);border:2px dashed rgba(255,255,255,.18);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;position:relative;z-index:1;}
.buku-cover-ph i{font-size:2.4rem;color:rgba(255,255,255,.2);}
.buku-cover-ph span{font-size:.62rem;color:rgba(255,255,255,.25);text-align:center;line-height:1.4;}
.buku-badge-wrap{display:flex;gap:6px;flex-wrap:wrap;justify-content:center;position:relative;z-index:1;}
.buku-badge{font-size:.58rem;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;letter-spacing:.06em;}
.bb-type{background:rgba(240,180,41,.18);color:#f0b429;border:1px solid rgba(240,180,41,.25);}

/* Info panel kanan */
.buku-info-panel{flex:1;padding:28px 30px;display:flex;flex-direction:column;justify-content:center;gap:12px;border-left:1px solid #f3f4f6;}
.buku-sub-label{font-size:.6rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.12em;margin-bottom:4px;}
.buku-judul{font-family:'Playfair Display','Cormorant Garamond',Georgia,serif;font-size:1.55rem;font-weight:700;color:#0a1628;line-height:1.28;letter-spacing:-.01em;}
.buku-penulis{font-size:.92rem;color:#4b5563;font-weight:500;display:flex;align-items:center;gap:7px;}
.buku-penulis i{color:#b8860b;}
.buku-meta-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;}
.buku-pill{display:inline-flex;align-items:center;gap:5px;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:8px;padding:5px 12px;font-size:.72rem;font-weight:600;color:#374151;}
.buku-pill i{font-size:.7rem;color:#6b7280;}
.buku-rak-row{display:flex;gap:10px;flex-wrap:wrap;margin-top:4px;}
.buku-rak-badge{display:flex;align-items:center;gap:6px;background:#dbeafe;border:1px solid #bfdbfe;border-radius:8px;padding:7px 14px;font-size:.74rem;font-weight:700;color:#1e3a8a;}

/* Detail section cards */
.buku-detail-sections{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
.buku-section-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(10,22,40,.05);}
.bsc-head{display:flex;align-items:center;gap:10px;padding:14px 18px;border-bottom:1px solid #f3f4f6;background:#fafafa;}
.bsc-head-ico{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.82rem;flex-shrink:0;}
.bsc-head-title{font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#6b7280;}
.bsc-body{padding:4px 18px 8px;}
.bsc-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #f9fafb;gap:12px;}
.bsc-row:last-child{border-bottom:none;}
.bsc-lbl{font-size:.68rem;font-weight:600;color:#9ca3af;white-space:nowrap;}
.bsc-val{font-size:.83rem;font-weight:600;color:#111827;text-align:right;}
.bsc-val.empty{color:#d1d5db;font-style:italic;font-weight:400;font-size:.78rem;}

/* Deskripsi fisik full width */
.buku-desc-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(10,22,40,.05);}
.buku-desc-body{padding:16px 20px;font-size:.86rem;color:#374151;line-height:1.85;}

@media(max-width:767px){
  .buku-hero-inner{flex-direction:column;}
  .buku-cover-panel{width:100%;flex-direction:row;justify-content:flex-start;padding:20px;gap:20px;}
  .buku-cover-img,.buku-cover-ph{width:90px;height:120px;}
  .buku-detail-sections{grid-template-columns:1fr;}
  .buku-info-panel{padding:20px;}
}
</style>

<div class="buku-detail-wrap">

    {{-- ── HERO: Cover + Info Utama ── --}}
    <div class="buku-hero">
        <div class="buku-hero-inner">

            {{-- Cover panel kiri --}}
            <div class="buku-cover-panel">
                @if($buku->cover)
                    <img src="{{ asset('storage/' . $buku->cover) }}"
                         alt="{{ $buku->judul }}"
                         class="buku-cover-img"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="buku-cover-ph" style="display:none">
                        <i class="bi bi-book"></i>
                        <span>Cover tidak<br>ditemukan</span>
                    </div>
                @else
                    <div class="buku-cover-ph">
                        <i class="bi bi-book"></i>
                        <span>Belum ada<br>cover</span>
                    </div>
                @endif
                <div class="buku-badge-wrap">
                    <span class="buku-badge bb-type"><i class="bi bi-book"></i> Buku</span>
                </div>
            </div>

            {{-- Info utama panel kanan --}}
            <div class="buku-info-panel">
                <div>
                    <div class="buku-sub-label">Koleksi Perpustakaan JDIH</div>
                    <div class="buku-judul">{{ $buku->judul }}</div>
                </div>

                @if($buku->penulis)
                <div class="buku-penulis">
                    <i class="bi bi-person-fill"></i> {{ $buku->penulis }}
                </div>
                @endif

                <div class="buku-meta-pills">
                    @if($buku->penerbit)
                    <span class="buku-pill"><i class="bi bi-building"></i> {{ $buku->penerbit }}</span>
                    @endif
                    @if($buku->tahun_terbit)
                    <span class="buku-pill"><i class="bi bi-calendar3"></i> {{ $buku->tahun_terbit }}</span>
                    @endif
                    @if($buku->isbn)
                    <span class="buku-pill"><i class="bi bi-upc-scan"></i> ISBN: {{ $buku->isbn }}</span>
                    @endif
                    @if($buku->bidang_hukum)
                    <span class="buku-pill"><i class="bi bi-tag-fill"></i> {{ $buku->bidang_hukum }}</span>
                    @endif
                </div>

                @if($buku->rak || $buku->baris)
                <div class="buku-rak-row">
                    @if($buku->rak)
                    <span class="buku-rak-badge"><i class="bi bi-bookshelf"></i> Rak: {{ $buku->rak }}</span>
                    @endif
                    @if($buku->baris)
                    <span class="buku-rak-badge" style="background:#dcfce7;border-color:#bbf7d0;color:#14532d">
                        <i class="bi bi-list-ol"></i> Baris: {{ $buku->baris }}
                    </span>
                    @endif
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ── DETAIL SECTIONS ── --}}
    <div class="buku-detail-sections">

        {{-- Informasi Katalog --}}
        <div class="buku-section-card">
            <div class="bsc-head">
                <div class="bsc-head-ico" style="background:#dbeafe"><i class="bi bi-journal-bookmark" style="color:#1e3a8a"></i></div>
                <div class="bsc-head-title">Informasi Katalog</div>
            </div>
            <div class="bsc-body">
                <div class="bsc-row">
                    <span class="bsc-lbl">Penulis / Pengarang</span>
                    <span class="bsc-val {{ !$buku->penulis ? 'empty' : '' }}">{{ $buku->penulis ?? '—' }}</span>
                </div>
                <div class="bsc-row">
                    <span class="bsc-lbl">Penerbit</span>
                    <span class="bsc-val {{ !$buku->penerbit ? 'empty' : '' }}">{{ $buku->penerbit ?? '—' }}</span>
                </div>
                <div class="bsc-row">
                    <span class="bsc-lbl">Tahun Terbit</span>
                    <span class="bsc-val {{ !$buku->tahun_terbit ? 'empty' : '' }}">{{ $buku->tahun_terbit ?? '—' }}</span>
                </div>
                <div class="bsc-row">
                    <span class="bsc-lbl">ISBN</span>
                    <span class="bsc-val {{ !$buku->isbn ? 'empty' : '' }}">{{ $buku->isbn ?? '—' }}</span>
                </div>
                <div class="bsc-row">
                    <span class="bsc-lbl">Bidang Hukum</span>
                    <span class="bsc-val {{ !$buku->bidang_hukum ? 'empty' : '' }}">{{ $buku->bidang_hukum ?? '—' }}</span>
                </div>
            </div>
        </div>

        {{-- Lokasi Penyimpanan --}}
        <div class="buku-section-card">
            <div class="bsc-head">
                <div class="bsc-head-ico" style="background:#dcfce7"><i class="bi bi-bookshelf" style="color:#065f46"></i></div>
                <div class="bsc-head-title">Lokasi Penyimpanan</div>
            </div>
            <div class="bsc-body">
                <div class="bsc-row">
                    <span class="bsc-lbl">Posisi Rak</span>
                    <span class="bsc-val {{ !$buku->rak ? 'empty' : '' }}">{{ $buku->rak ?? '—' }}</span>
                </div>
                <div class="bsc-row">
                    <span class="bsc-lbl">Posisi Baris</span>
                    <span class="bsc-val {{ !$buku->baris ? 'empty' : '' }}">{{ $buku->baris ?? '—' }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ── DESKRIPSI FISIK ── --}}
    @if($buku->deskripsi_fisik)
    <div class="buku-desc-card">
        <div class="bsc-head">
            <div class="bsc-head-ico" style="background:#fef9c3"><i class="bi bi-file-text" style="color:#713f12"></i></div>
            <div class="bsc-head-title">Deskripsi Fisik</div>
        </div>
        <div class="buku-desc-body">
            {!! nl2br(e($buku->deskripsi_fisik)) !!}
        </div>
    </div>
    @endif

</div>
@endsection