@extends('layouts.public')

@section('title', $kepbupati->judul)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"><i class="bi bi-file-earmark-lock"></i> Regulasi</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <div class="detail-badge"><i class="bi bi-file-earmark-lock"></i> Keputusan Bupati</div>
        <h1 class="detail-title">{{ $kepbupati->judul }}</h1>
    </div>
    <div class="detail-body">
        <div class="meta-grid">
            <div class="meta-item"><div class="lbl">Nomor</div><div class="val">{{ $kepbupati->nomor ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Tahun</div><div class="val">{{ $kepbupati->tahun ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Tanggal</div><div class="val">{{ $kepbupati->tanggal ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Tempat Penetapan</div><div class="val">{{ $kepbupati->tempat_penetapan ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Sumber</div><div class="val">{{ $kepbupati->sumber ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Bidang Hukum</div><div class="val">{{ $kepbupati->bidang_hukum ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Bahasa</div><div class="val">{{ $kepbupati->bahasa ?: '-' }}</div></div>
            <div class="meta-item"><div class="lbl">Subjek</div><div class="val">{{ $kepbupati->subjek ?: '-' }}</div></div>
        </div>

        @if($kepbupati->keterangan)
        <div class="mb-4">
            <div class="section-label">Keterangan</div>
            <div class="content-text">{!! $kepbupati->keterangan !!}</div>
        </div>
        @endif

        <div class="pdf-section">
            <div class="section-label"><i class="bi bi-file-earmark-pdf me-1"></i>Dokumen PDF</div>
            @if($kepbupati->file_pdf)
            <div class="pdf-actions" style="display:flex;align-items:center;gap:10px;margin-bottom:14px;flex-wrap:wrap;">
                <button id="btnTogglePdf" class="btn-pdf btn-view" onclick="togglePdf()" style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    <span id="toggleLabel">Sembunyikan PDF</span>
                </button>
                <a href="{{ asset('storage/' . $kepbupati->file_pdf) }}" target="_blank" download class="btn-pdf btn-download" style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-download"></i> Unduh PDF
                </a>
                <a href="{{ asset('storage/' . $kepbupati->file_pdf) }}" target="_blank" style="display:inline-flex;align-items:center;gap:6px;background:#f1f5f9;color:#334155;border:1.5px solid #e2e8f0;padding:8px 16px;border-radius:8px;font-size:.82rem;font-weight:600;text-decoration:none;">
                    <i class="bi bi-box-arrow-up-right"></i> Buka di Tab Baru
                </a>
            </div>
            <div id="pdfWrap" style="width:100%;border-radius:10px;overflow:hidden;border:1.5px solid #e2e8f0;background:#f8fafc;">
                <iframe
                    src="{{ route('pdf.view', ['path' => base64_encode($kepbupati->file_pdf)]) }}"
                    style="width:100%;height:780px;border:none;display:block;"
                    loading="lazy">
                </iframe>
            </div>
            @else
            <div style="padding:32px;text-align:center;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0;">
                <i class="bi bi-file-earmark-x" style="font-size:2rem;color:#d1d5db;display:block;margin-bottom:10px;"></i>
                <p class="text-muted fst-italic" style="margin:0;">Dokumen PDF belum tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@if($kepbupati->file_pdf)
<script>
function togglePdf() {
    const wrap  = document.getElementById('pdfWrap');
    const icon  = document.getElementById('toggleIcon');
    const label = document.getElementById('toggleLabel');
    const shown = wrap.style.display !== 'none';
    wrap.style.display = shown ? 'none' : 'block';
    icon.className     = shown ? 'bi bi-eye' : 'bi bi-eye-slash';
    label.textContent  = shown ? 'Tampilkan PDF' : 'Sembunyikan PDF';
}
</script>
@endif

@endsection