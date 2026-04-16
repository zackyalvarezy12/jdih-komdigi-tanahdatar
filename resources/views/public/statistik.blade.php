@extends('public.layouts.app')

@section('content')
<div class="container py-5" style="margin-top: 100px;">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #0b1f4a;">Statistik Produk Hukum</h2>
        <p class="text-muted">Data jumlah dokumentasi hukum Kabupaten Tanah Datar</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="row g-4 mb-5">
        @foreach($stats as $s)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 20px;">
                <div class="mb-3" style="font-size: 2.5rem; color: #c8960c;">
                    <i class="bi {{ $s['icon'] }}"></i>
                </div>
                <h3 class="fw-bold">{{ number_format($s['total'], 0, ',', '.') }}</h3>
                <span class="text-uppercase fw-bold text-muted small">{{ $s['label'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Statistik Pengunjung --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Total Pengunjung</div>
                <h3 class="fw-bold">{{ number_format($visitorSummary['total'] ?? 0, 0, ',', '.') }}</h3>
                <p class="text-muted small mb-0">Total kunjungan halaman publik</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Hari Ini</div>
                <h3 class="fw-bold">{{ number_format($visitorSummary['today'] ?? 0, 0, ',', '.') }}</h3>
                <p class="text-muted small mb-0">Kunjungan publik hari ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Bulan Ini</div>
                <h3 class="fw-bold">{{ number_format($visitorSummary['month'] ?? 0, 0, ',', '.') }}</h3>
                <p class="text-muted small mb-0">Total kunjungan bulan ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 text-center h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Tahun Ini</div>
                <h3 class="fw-bold">{{ number_format($visitorSummary['year'] ?? 0, 0, ',', '.') }}</h3>
                <p class="text-muted small mb-0">Total kunjungan tahun ini</p>
            </div>
        </div>
    </div>

    {{-- Ringkasan Dokumen Baru --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Dokumen Baru Hari Ini</div>
                <h3 class="fw-bold">{{ number_format($newDocumentCounts['today'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Dokumen Baru Bulan Ini</div>
                <h3 class="fw-bold">{{ number_format($newDocumentCounts['month'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                <div class="text-muted small text-uppercase mb-2">Dokumen Baru Tahun Ini</div>
                <h3 class="fw-bold">{{ number_format($newDocumentCounts['year'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    {{-- Grafik Dokumen --}}
    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
        <h5 class="fw-bold mb-4"><i class="bi bi-bar-chart-fill me-2"></i>Grafik Perbandingan Produk Hukum</h5>
        <canvas id="chartProdukHukum" height="100"></canvas>
    </div>

    {{-- Grafik Pengunjung --}}
    <div class="card border-0 shadow-sm p-4 mt-4" style="border-radius: 20px;">
        <h5 class="fw-bold mb-4"><i class="bi bi-graph-up-arrow me-2"></i>Grafik Pengunjung 30 Hari Terakhir</h5>
        @if(count($visitorTrendLabels ?? []))
            <canvas id="chartVisitorTrend" height="100"></canvas>
        @else
            <div class="text-center py-5 text-muted">
                Data pengunjung belum tersedia. Kunjungi beberapa halaman publik untuk mulai merekam data.
            </div>
        @endif
    </div>
</div>

{{-- Tambahkan Chart.js via CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartProdukHukum').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Dokumen',
                data: @json($counts),
                backgroundColor: '#0b1f4a',
                borderRadius: 10,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    @if(count($visitorTrendLabels ?? []))
    const ctx2 = document.getElementById('chartVisitorTrend').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: @json($visitorTrendLabels),
            datasets: [{
                label: 'Kunjungan',
                data: @json($visitorTrendCounts),
                borderColor: '#0b1f4a',
                backgroundColor: 'rgba(11,31,74,0.12)',
                tension: 0.35,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#0b1f4a',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    @endif
</script>
@endsection