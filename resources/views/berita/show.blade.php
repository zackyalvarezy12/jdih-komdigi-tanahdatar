@extends('layouts.public')

@section('title', $berita->judul)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"><i class="bi bi-newspaper"></i> Berita</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <div class="detail-badge"><i class="bi bi-newspaper"></i> Berita</div>
        <h1 class="detail-title">{{ $berita->judul }}</h1>
        <div class="views-badge" style="margin-top:12px;">
            <i class="bi bi-calendar3"></i> {{ $berita->created_at->format('d F Y') }}
        </div>
    </div>
    <div class="detail-body">
        @if($berita->gambar)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $berita->gambar) }}"
                 alt="{{ $berita->judul }}"
                 class="img-fluid rounded"
                 style="width:100%; max-height:420px; object-fit:cover;">
        </div>
        @endif

        <div class="content-text">
            {!! $berita->isi !!}
        </div>
    </div>
</div>
@endsection