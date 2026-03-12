{{--
    ╔══════════════════════════════════════════════╗
    ║  PARTIAL: navbar.blade.php  (FIXED)          ║
    ║  Isi: Welcome Splash + Topbar + Navbar       ║
    ╚══════════════════════════════════════════════╝
    Cara pakai:
    @include('public.partials.navbar')
--}}

{{--
    WELCOME SPLASH — hanya muncul SEKALI per sesi browser.
    Saat balik dari halaman lain, TIDAK muncul lagi.
    (menggunakan sessionStorage)
--}}
<div id="welcomeSplash">
    <div class="ws-bg"></div>
    <div class="ws-inner">
        <div class="ws-logo">
            <img src="{{ asset('images/logoku.png') }}" alt="JDIH Logo"
                 onerror="this.style.display='none'">
        </div>
        <div class="ws-text">
            <div class="ws-selamat">Selamat Datang di</div>     
            <div class="ws-title">JDIH <em>Tanah Datar</em></div>
            <div class="ws-sub">Kabupaten Tanah Datar</div>
            <div class="ws-divider"></div>
            <div class="ws-tagline">Jaringan Dokumentasi &amp; Informasi Hukum</div>
        </div>
    </div>
</div>

{{-- Script splash — diletakkan langsung di sini agar langsung
     menyembunyikan splash SEBELUM render jika sudah pernah tampil,
     sehingga tidak ada efek "kedip" --}}
<script>
(function(){
    var splash = document.getElementById('welcomeSplash');
    if (!splash) return;

    // Sudah pernah tampil di sesi ini? Sembunyikan langsung tanpa animasi
    if (sessionStorage.getItem('jdih_splash_shown')) {
        splash.style.display = 'none';
        return;
    }

    // Pertama kali: catat di sessionStorage, tampil 2.4 detik lalu fade out
    sessionStorage.setItem('jdih_splash_shown', '1');

    function hideSplash() {
        splash.classList.add('ws-hide');
        setTimeout(function(){ splash.style.display = 'none'; }, 700);
    }

    setTimeout(hideSplash, 2400);

    // Klik untuk tutup lebih cepat
    splash.addEventListener('click', hideSplash);
})();
</script>

{{-- ════ SITE HEADER (topbar + navbar sebagai satu unit sticky) ════ --}}
<header class="site-header" id="siteHeader">

    {{-- Topbar marquee --}}
    <div class="topbar">
        <div class="topbar-marquee">
            <span class="topbar-item"><i class="bi bi-shield-check"></i>Pemerintah Daerah Kabupaten Tanah Datar<span class="topbar-dot">◆</span></span>
            <span class="topbar-item"><i class="bi bi-file-earmark-text"></i>Jaringan Dokumentasi &amp; Informasi Hukum<span class="topbar-dot">◆</span></span>
            <span class="topbar-item"><i class="bi bi-award"></i>Portal Resmi Produk Hukum Daerah<span class="topbar-dot">◆</span></span>
            <span class="topbar-item"><i class="bi bi-shield-check"></i>Pemerintah Daerah Kabupaten Tanah Datar<span class="topbar-dot">◆</span></span>
            <span class="topbar-item"><i class="bi bi-file-earmark-text"></i>Jaringan Dokumentasi &amp; Informasi Hukum<span class="topbar-dot">◆</span></span>
            <span class="topbar-item"><i class="bi bi-award"></i>Portal Resmi Produk Hukum Daerah<span class="topbar-dot">◆</span></span>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar-main">
        <div class="container">
            <div class="navbar-inner">

                {{-- Brand / Logo --}}
                <a href="{{ url('/') }}" class="brand">
                    <div class="brand-logo">
                        <img src="{{ asset('images/logoku.png') }}"
                             alt="JDIH Logo"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                        <span class="brand-logo-fallback" style="display:none">JD</span>
                    </div>
                    <div class="brand-text">
                        <div class="brand-name">JDIH <em>Tanah Datar</em> </div>
                        <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                    </div>
                </a>

                {{-- Desktop nav --}}
                <div class="nav-links">
                    <a href="{{ url('/') }}" class="active"><i class="bi bi-house"></i> Beranda</a>

                    {{-- Regulasi dropdown --}}
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-book"></i> Regulasi <i class="bi bi-chevron-down" style="font-size:.56rem"></i></button>
                        <div class="nav-dd-menu">
                            <div class="dd-lbl">Jenis Peraturan</div>
                            <a href="{{ url('/daftar/perda') }}"><i class="bi bi-file-earmark-ruled"></i> Peraturan Daerah</a>
                            <a href="{{ url('/daftar/perbupati') }}"><i class="bi bi-file-earmark-check"></i> Peraturan Bupati</a>
                            <a href="{{ url('/daftar/kepbupati') }}"><i class="bi bi-file-earmark-lock"></i> Keputusan Bupati</a>
                            <a href="{{ url('/daftar/insbupati') }}"><i class="bi bi-file-earmark-arrow-down"></i> Instruksi Bupati</a>
                            <a href="{{ url('/daftar/propemda') }}"><i class="bi bi-list-task"></i> Propemda</a>
                            <div class="dd-div"></div>
                            <a href="{{ url('/daftar/kerjasama') }}"><i class="bi bi-handshake"></i> Kerjasama Daerah</a>
                            <a href="{{ url('/daftar/perterjemah') }}"><i class="bi bi-translate"></i> Peraturan Terjemah</a>
                            <a href="{{ url('/daftar/ranpuu') }}"><i class="bi bi-file-earmark-diff"></i> Rancangan PUU</a>
                        </div>
                    </div>

                    {{-- Dok Hukum dropdown --}}
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-file-text"></i> Dok. Hukum <i class="bi bi-chevron-down" style="font-size:.56rem"></i></button>
                        <div class="nav-dd-menu">
                            <a href="{{ url('/daftar/kajian') }}"><i class="bi bi-journal-bookmark"></i> Kajian Hukum</a>
                            <a href="{{ url('/daftar/naskah') }}"><i class="bi bi-file-earmark-text"></i> Naskah Akademik</a>
                            <a href="{{ url('/daftar/analisis') }}"><i class="bi bi-clipboard-data"></i> Analisis Evaluasi</a>
                            <a href="{{ url('/daftar/risalah') }}"><i class="bi bi-journal-richtext"></i> Risalah Hukum</a>
                            <a href="{{ url('/daftar/relaas') }}"><i class="bi bi-bank"></i> Relaas Pengadilan</a>
                        </div>
                    </div>

                    {{-- Media dropdown --}}
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-grid"></i> Media <i class="bi bi-chevron-down" style="font-size:.56rem"></i></button>
                        <div class="nav-dd-menu">
                            <a href="{{ url('/daftar/artikel') }}"><i class="bi bi-newspaper"></i> Artikel</a>
                            <a href="{{ url('/daftar/infografis') }}"><i class="bi bi-image"></i> Infografis</a>
                            <a href="{{ url('/daftar/buku') }}"><i class="bi bi-book"></i> Perpustakaan Buku</a>
                        </div>
                    </div>

                    <a href="{{ url('/daftar/berita') }}"><i class="bi bi-newspaper"></i> Berita</a>
                    <a href="{{ route('login') }}" class="btn-adm"><i class="bi bi-lock"></i> Admin</a>
                </div>

                {{-- Hamburger --}}
                <button class="ham" onclick="toggleMenu()" aria-label="Menu">
                    <i class="bi bi-list" id="hamIcon"></i>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div class="mob-menu" id="mobMenu">
                <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
                <div class="mob-lbl">Regulasi</div>
                <a href="{{ url('/daftar/perda') }}" class="sub"><i class="bi bi-file-earmark-ruled"></i> Peraturan Daerah</a>
                <a href="{{ url('/daftar/perbupati') }}" class="sub"><i class="bi bi-file-earmark-check"></i> Peraturan Bupati</a>
                <a href="{{ url('/daftar/kepbupati') }}" class="sub"><i class="bi bi-file-earmark-lock"></i> Keputusan Bupati</a>
                <a href="{{ url('/daftar/insbupati') }}" class="sub"><i class="bi bi-file-earmark-arrow-down"></i> Instruksi Bupati</a>
                <a href="{{ url('/daftar/propemda') }}" class="sub"><i class="bi bi-list-task"></i> Propemda</a>
                <a href="{{ url('/daftar/kerjasama') }}" class="sub"><i class="bi bi-handshake"></i> Kerjasama Daerah</a>
                <a href="{{ url('/daftar/perterjemah') }}" class="sub"><i class="bi bi-translate"></i> Peraturan Terjemah</a>
                <a href="{{ url('/daftar/ranpuu') }}" class="sub"><i class="bi bi-file-earmark-diff"></i> Rancangan PUU</a>
                <div class="mob-lbl">Dokumen Hukum</div>
                <a href="{{ url('/daftar/kajian') }}" class="sub"><i class="bi bi-journal-bookmark"></i> Kajian Hukum</a>
                <a href="{{ url('/daftar/naskah') }}" class="sub"><i class="bi bi-file-earmark-text"></i> Naskah Akademik</a>
                <a href="{{ url('/daftar/analisis') }}" class="sub"><i class="bi bi-clipboard-data"></i> Analisis Evaluasi</a>
                <a href="{{ url('/daftar/risalah') }}" class="sub"><i class="bi bi-journal-richtext"></i> Risalah Hukum</a>
                <a href="{{ url('/daftar/relaas') }}" class="sub"><i class="bi bi-bank"></i> Relaas Pengadilan</a>
                <div class="mob-lbl">Konten &amp; Media</div>
                <a href="{{ url('/daftar/artikel') }}" class="sub"><i class="bi bi-newspaper"></i> Artikel</a>
                <a href="{{ url('/daftar/infografis') }}" class="sub"><i class="bi bi-image"></i> Infografis</a>
                <a href="{{ url('/daftar/buku') }}" class="sub"><i class="bi bi-book"></i> Perpustakaan Buku</a>
                <a href="{{ url('/daftar/berita') }}"><i class="bi bi-newspaper"></i> Berita</a>
                <a href="{{ route('login') }}"><i class="bi bi-lock"></i> Login Admin</a>
            </div>
        </div>
    </nav>
</header>