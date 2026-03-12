@extends('layouts.public')

@section('title', $item->judul ?? 'Infografis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
<li class="breadcrumb-item"><a href="{{ url('/daftar/infografis') }}"><i class="bi bi-image"></i> Infografis</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <div class="detail-badge"><i class="bi bi-image"></i> Infografis</div>
        <h1 class="detail-title">{{ $item->judul ?? 'Infografis' }}</h1>
        <div class="detail-meta" style="margin-top:8px;font-size:.8rem;color:#6b7280;">
            <i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}
            @if($item->views)
            &nbsp;·&nbsp; <i class="bi bi-eye"></i> {{ $item->views }} kali dilihat
            @endif
        </div>
    </div>
    <div class="detail-body">

        @if($item->file_infografis)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $item->file_infografis) }}"
                 alt="{{ $item->judul ?? 'Infografis' }}"
                 class="img-fluid rounded"
                 style="max-height:600px;">
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-image" style="font-size:4rem;"></i>
            <p class="mt-2">Gambar tidak tersedia</p>
        </div>
        @endif

        <div class="text-center mt-3">
            <a href="{{ url('/daftar/infografis') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Infografis
            </a>
        </div>

    </div>
</div>
@endsection