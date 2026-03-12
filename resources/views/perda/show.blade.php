@extends('layouts.public')

@section('title', $perda->judul)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"><i class="bi bi-file-earmark-ruled"></i> Regulasi</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <div class="detail-badge"><i class="bi bi-file-earmark-ruled"></i> Peraturan Daerah</div>
        <h1 class="detail-title">{{ $perda->judul }}</h1>
    </div>

    <div class="detail-body">

        {{-- META GRID --}}
        <div class="meta-grid">
            <div class="meta-item">
                <div class="lbl">Nomor</div>
                <div class="val">{{ $perda->nomor ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Tahun</div>
                <div class="val">{{ $perda->tahun ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Tanggal</div>
                <div class="val">{{ $perda->tanggal ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Tempat Penetapan</div>
                <div class="val">{{ $perda->tempat_penetapan ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Sumber</div>
                <div class="val">{{ $perda->sumber ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Bidang Hukum</div>
                <div class="val">{{ $perda->bidang_hukum ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Bahasa</div>
                <div class="val">{{ $perda->bahasa ?: '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="lbl">Subjek</div>
                <div class="val">{{ $perda->subjek ?: '-' }}</div>
            </div>
        </div>

        {{-- KETERANGAN — render HTML dari rich text editor --}}
        @if($perda->keterangan)
        <div class="mb-4">
            <div class="section-label">Keterangan</div>
            <div class="content-text">{!! $perda->keterangan !!}</div>
        </div>
        @endif

        {{-- PDF SECTION --}}
        <div class="pdf-section">
            <div class="section-label">
                <i class="bi bi-file-earmark-pdf me-1"></i>Dokumen PDF
            </div>

            @if($perda->file_pdf)

            {{-- Tombol aksi --}}
            <div class="pdf-actions" style="display:flex;align-items:center;gap:10px;margin-bottom:14px;flex-wrap:wrap;">
                <button id="btnTogglePdf"
                        class="btn-pdf btn-view"
                        onclick="togglePdf()"
                        style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    <span id="toggleLabel">Sembunyikan PDF</span>
                </button>
                <a href="{{ asset('storage/' . $perda->file_pdf) }}"
                   target="_blank" download
                   class="btn-pdf btn-download"
                   style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-download"></i> Unduh PDF
                </a>
                <a href="{{ asset('storage/' . $perda->file_pdf) }}"
                   target="_blank"
                   style="display:inline-flex;align-items:center;gap:6px;background:#f1f5f9;color:#334155;border:1.5px solid #e2e8f0;padding:8px 16px;border-radius:8px;font-size:.82rem;font-weight:600;text-decoration:none;">
                    <i class="bi bi-box-arrow-up-right"></i> Buka di Tab Baru
                </a>
            </div>

            {{-- PDF Viewer pakai PDF.js CDN --}}
            <div id="pdfWrap" style="width:100%;border-radius:10px;overflow:hidden;border:1.5px solid #e2e8f0;background:#1e1e2e;">
                <canvas id="pdfCanvas" style="width:100%;display:block;"></canvas>
                <div id="pdfNav" style="display:flex;align-items:center;justify-content:center;gap:12px;padding:10px;background:#2a2a3e;">
                    <button onclick="prevPage()" style="background:#3b3b52;color:white;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;font-size:13px;">‹ Prev</button>
                    <span id="pdfPageInfo" style="color:white;font-size:13px;">Halaman <span id="pageNum">1</span> / <span id="pageCount">-</span></span>
                    <button onclick="nextPage()" style="background:#3b3b52;color:white;border:none;padding:6px 14px;border-radius:6px;cursor:pointer;font-size:13px;">Next ›</button>
                    <select id="zoomSelect" onchange="setZoom(this.value)" style="background:#3b3b52;color:white;border:none;padding:6px 10px;border-radius:6px;font-size:13px;cursor:pointer;">
                        <option value="0.75">75%</option>
                        <option value="1" selected>100%</option>
                        <option value="1.25">125%</option>
                        <option value="1.5">150%</option>
                        <option value="2">200%</option>
                    </select>
                </div>
            </div>

            {{-- Fallback jika iframe gagal --}}
            <div id="pdfFallback" style="display:none;padding:40px;text-align:center;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0;margin-top:10px;">
                <i class="bi bi-file-earmark-pdf" style="font-size:2.8rem;color:#dc2626;display:block;margin-bottom:12px;"></i>
                <p style="color:#64748b;font-size:.88rem;margin-bottom:16px;">
                    Browser Anda tidak dapat menampilkan PDF secara langsung.
                </p>
                <div style="display:flex;justify-content:center;gap:10px;flex-wrap:wrap;">
                    <a href="{{ asset('storage/' . $perda->file_pdf) }}" target="_blank" download
                       class="btn-pdf btn-download" style="display:inline-flex;align-items:center;gap:6px;">
                        <i class="bi bi-download"></i> Unduh PDF
                    </a>
                    <a href="{{ asset('storage/' . $perda->file_pdf) }}" target="_blank"
                       class="btn-pdf btn-view" style="display:inline-flex;align-items:center;gap:6px;">
                        <i class="bi bi-box-arrow-up-right"></i> Buka di Tab Baru
                    </a>
                </div>
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

@if($perda->file_pdf)
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
// ── Setup PDF.js ──────────────────────────────────────
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

const PDF_URL = "{{ route('pdf.view', ['path' => base64_encode($perda->file_pdf)]) }}";
const directUrl = PDF_URL;
let pdfDoc = null, currentPage = 1, currentZoom = 1;

// Fetch PDF sebagai blob dulu supaya bypass CORS/download trigger
fetch(PDF_URL, { headers: { 'Accept': 'application/pdf' } })
    .then(res => res.arrayBuffer())
    .then(buffer => pdfjsLib.getDocument({ data: buffer }).promise)
    .then(function(pdf) {
        pdfDoc = pdf;
        document.getElementById('pageCount').textContent = pdf.numPages;
        renderPage(currentPage);
    }).catch(function(err) {
        document.getElementById('pdfWrap').innerHTML =
            '<div style="padding:40px;text-align:center;color:#94a3b8;">' +
            '<i class="bi bi-file-earmark-x" style="font-size:2rem;display:block;margin-bottom:10px;"></i>' +
            'Gagal memuat PDF. <a href="' + directUrl + '" target="_blank" style="color:#60a5fa;">Buka langsung</a></div>';
    });

function renderPage(num) {
    pdfDoc.getPage(num).then(function(page) {
        const canvas  = document.getElementById('pdfCanvas');
        const ctx     = canvas.getContext('2d');
        const wrap    = document.getElementById('pdfWrap');
        const vp      = page.getViewport({ scale: currentZoom });

        // Sesuaikan lebar canvas dengan lebar container
        const containerWidth = wrap.clientWidth || 800;
        const autoScale      = containerWidth / vp.width;
        const finalVp        = page.getViewport({ scale: currentZoom * autoScale });

        canvas.height = finalVp.height;
        canvas.width  = finalVp.width;
        canvas.style.width  = '100%';

        page.render({ canvasContext: ctx, viewport: finalVp });
        document.getElementById('pageNum').textContent = num;
    });
}

function prevPage() {
    if (currentPage <= 1) return;
    currentPage--;
    renderPage(currentPage);
}

function nextPage() {
    if (!pdfDoc || currentPage >= pdfDoc.numPages) return;
    currentPage++;
    renderPage(currentPage);
}

function setZoom(val) {
    currentZoom = parseFloat(val);
    renderPage(currentPage);
}

// Toggle show/hide
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