{{-- ════════════════════ SEKSI KONTAK PUBLIK ════════════════════ --}}
@if(isset($kontaks) && $kontaks->count())
<section class="kontak-publik-section" id="kontak">
    <div class="container">

        <div class="sec-head reveal">
            <div class="sec-badge"><i class="bi bi-envelope-paper"></i> Pesan Masuk</div>
            <h2>Kontak &amp; <em>Pesan</em></h2>
            <p>Daftar pesan yang diterima dari masyarakat Kabupaten Tanah Datar</p>
        </div>

        <div class="row g-3">
            @foreach($kontaks as $kontak)
            <div class="col-sm-6 col-lg-4 reveal">
                <div class="kontak-card">
                    <div class="kontak-card-header">
                        <div class="kontak-avatar">
                            {{ strtoupper(substr($kontak->nama, 0, 1)) }}
                        </div>
                        <div class="kontak-info">
                            <div class="kontak-nama">{{ $kontak->nama }}</div>
                            <div class="kontak-email">
                                <i class="bi bi-envelope"></i> {{ $kontak->email }}
                            </div>
                        </div>
                    </div>
                    <div class="kontak-subjek">
                        <i class="bi bi-chat-square-text" style="color:var(--gold)"></i>
                        {{ $kontak->subjek }}
                    </div>
                    <div class="kontak-pesan">{{ Str::limit($kontak->pesan, 120) }}</div>
                    <div class="kontak-date">
                        <i class="bi bi-calendar3"></i>
                        {{ $kontak->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif