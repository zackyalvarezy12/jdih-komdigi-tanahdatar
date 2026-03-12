@extends('layouts.public')

@section('title', $artikel->judul)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"><i class="bi bi-newspaper"></i> Konten & Media</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <div class="detail-badge"><i class="bi bi-newspaper"></i> Artikel</div>
        <h1 class="detail-title">{{ $artikel->judul }}</h1>
        
    </div>
    <div class="detail-body">
        <div class="meta-grid">
            <div class="meta-item">
                <div class="lbl">Jenis Artikel</div>
                <div class="val">{{ $artikel->jenis_artikel ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Tahun</div>
                <div class="val">{{ $artikel->tahun ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Tempat Terbit</div>
                <div class="val">{{ $artikel->tempat_terbit ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Bahasa</div>
                <div class="val">{{ $artikel->bahasa ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Bidang Hukum</div>
                <div class="val">{{ $artikel->bidang_hukum ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Sumber</div>
                <div class="val">{{ $artikel->sumber ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">TEU</div>
                <div class="val">{{ $artikel->teu ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Subjek</div>
                <div class="val">{{ $artikel->subjek ?? '<span class=\"text-muted fst-italic\">-</span>' }}</div>
            </div>
        </div>
        @if($artikel->gambar)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded" style="max-height:400px;">
        </div>
        @endif
        @if($artikel->konten)
        <div class="mb-4">
            <div class="section-label">Konten Artikel</div>
            <div class="content-text">{!! nl2br(e($artikel->konten)) !!}</div>
        </div>
        @endif

    </div>
</div>
@endsection
