{{--
    ╔══════════════════════════════════════════════╗
    ║  PARTIAL: navbar.blade.php  (v4 — mobile fix)║
    ╚══════════════════════════════════════════════╝
--}}

{{-- ════ WELCOME SPLASH ════ --}}
<div id="welcomeSplash">
    <div class="ws-bg"></div>
    <div class="ws-inner">
        <div class="ws-logo">
            <img src="{{ asset('images/logo.png') }}" alt="JDIH Logo" onerror="this.style.display='none'">
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
<script>
(function(){
    var splash = document.getElementById('welcomeSplash');
    if(!splash) return;
    if(sessionStorage.getItem('jdih_splash_shown')){ splash.style.display='none'; return; }
    sessionStorage.setItem('jdih_splash_shown','1');
    function hideSplash(){ splash.classList.add('ws-hide'); setTimeout(function(){ splash.style.display='none'; },700); }
    setTimeout(hideSplash,2400);
    splash.addEventListener('click',hideSplash);
})();
</script>

<style>
/* ══════════════════════════════════════════════
   CAT-TABS — scrollable di mobile
══════════════════════════════════════════════ */
.cat-tabs {
    position: sticky;
    top: 68px;
    z-index: 900;
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    box-shadow: 0 2px 12px rgba(11,31,74,.06);
}
.cat-tabs-inner {
    display: flex;
    gap: 0;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    scroll-snap-type: x mandatory;
    padding: 0 4px;
}
.cat-tabs-inner::-webkit-scrollbar { display: none; }
.cat-tab {
    flex-shrink: 0;
    scroll-snap-align: start;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 13px 16px;
    font-size: .78rem;
    font-weight: 700;
    color: var(--gray-500);
    text-decoration: none;
    border-bottom: 2.5px solid transparent;
    white-space: nowrap;
    transition: color .2s, border-color .2s;
}
.cat-tab:hover, .cat-tab.active {
    color: var(--navy);
    border-bottom-color: var(--gold);
}

/* ══════════════════════════════════════════════
   MOBILE MENU — drawer style dengan accordion
══════════════════════════════════════════════ */
@media (max-width: 991px) {
    /* Sembunyikan desktop nav dropdown saat mobile */
    .nav-dd-menu { display: none !important; }

    /* Mob-menu full drawer */
    .mob-menu {
        display: none;
        position: fixed;
        top: 0; right: 0; bottom: 0;
        width: min(320px, 88vw);
        background: var(--white);
        z-index: 1200;
        overflow-y: auto;
        box-shadow: -8px 0 40px rgba(11,31,74,.18);
        transform: translateX(100%);
        transition: transform .35s cubic-bezier(.4,0,.2,1);
        padding-bottom: 40px;
    }
    .mob-menu.open {
        display: block;
        transform: translateX(0);
    }

    /* Overlay backdrop */
    #mobOverlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(6,15,35,.55);
        z-index: 1100;
        backdrop-filter: blur(2px);
        opacity: 0;
        transition: opacity .35s;
    }
    #mobOverlay.open { display: block; opacity: 1; }

    /* Mob-menu header */
    .mob-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px 14px;
        border-bottom: 1px solid var(--gray-100);
        background: var(--navy);
    }
    .mob-header-brand {
        display: flex; align-items: center; gap: 10px;
    }
    .mob-header-logo {
        width: 40px; height: 40px;
        border-radius: 10px;               /* sudut rounded, bukan lingkaran */
        background: rgba(255,255,255,.15);
        border: 1.5px solid rgba(240,180,41,.4);
        overflow: hidden;
        display: flex; align-items: center; justify-content: center;
        padding: 3px;                      /* ruang napas logo perisai */
    }
    .mob-header-logo img {
        width: auto; height: 100%;
        object-fit: contain;               /* jaga rasio asli */
        border-radius: 0;
    }
    .mob-header-name {
        font-family: 'Playfair Display', serif;
        font-size: .88rem; font-weight: 700;
        color: var(--white); line-height: 1.2;
    }
    .mob-header-name em { color: var(--gold-light); font-style: normal; }
    .mob-close {
        width: 34px; height: 34px; border-radius: 9px;
        background: rgba(255,255,255,.12);
        border: none; color: rgba(255,255,255,.7);
        font-size: 1rem; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: .2s;
    }
    .mob-close:hover { background: rgba(255,255,255,.22); color: var(--white); }

    /* Beranda link */
    .mob-home-link {
        display: flex; align-items: center; gap: 10px;
        padding: 14px 20px;
        color: var(--text); text-decoration: none;
        font-size: .88rem; font-weight: 700;
        border-bottom: 1px solid var(--gray-100);
        transition: .15s;
    }
    .mob-home-link:hover { background: var(--gray-50); color: var(--navy); }
    .mob-home-link i { color: var(--gold); font-size: 1rem; }

    /* Accordion group */
    .mob-group { border-bottom: 1px solid var(--gray-100); }
    .mob-group-btn {
        width: 100%;
        display: flex; align-items: center; justify-content: space-between;
        padding: 13px 20px;
        background: none; border: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: .84rem; font-weight: 700;
        color: var(--text-soft);
        cursor: pointer;
        transition: .15s;
    }
    .mob-group-btn:hover { background: var(--gray-50); color: var(--navy); }
    .mob-group-btn .mob-group-left {
        display: flex; align-items: center; gap: 10px;
    }
    .mob-group-btn i.gicon {
        width: 28px; height: 28px; border-radius: 8px;
        background: var(--gray-100);
        display: flex; align-items: center; justify-content: center;
        font-size: .82rem; color: var(--navy);
        flex-shrink: 0; transition: .2s;
    }
    .mob-group-btn.active i.gicon { background: var(--navy); color: var(--white); }
    .mob-group-btn .mob-chevron {
        font-size: .65rem; color: var(--gray-400);
        transition: transform .25s; flex-shrink: 0;
    }
    .mob-group-btn.active .mob-chevron { transform: rotate(180deg); }

    /* Sub items dalam accordion */
    .mob-sub-list {
        display: none;
        background: var(--gray-50);
        padding: 4px 0 8px;
    }
    .mob-sub-list.open { display: block; }
    .mob-sub-list a {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 20px 10px 28px;
        color: var(--text-soft);
        text-decoration: none;
        font-size: .82rem; font-weight: 600;
        transition: .15s;
    }
    .mob-sub-list a:hover { color: var(--navy); padding-left: 32px; }
    .mob-sub-list a i {
        width: 20px; text-align: center;
        color: var(--gray-400); font-size: .78rem;
    }
    .mob-sub-list a:hover i { color: var(--navy); }
    .mob-sub-divider {
        height: 1px; background: var(--gray-200);
        margin: 4px 20px;
    }

    /* Direct links (Berita, Admin) */
    .mob-direct-link {
        display: flex; align-items: center; gap: 10px;
        padding: 13px 20px;
        color: var(--text); text-decoration: none;
        font-size: .84rem; font-weight: 700;
        border-bottom: 1px solid var(--gray-100);
        transition: .15s;
    }
    .mob-direct-link:hover { background: var(--gray-50); color: var(--navy); }
    .mob-direct-link i { width: 28px; height: 28px; border-radius: 8px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; font-size: .82rem; color: var(--navy); }

    /* Admin link khusus */
    .mob-admin-link {
        display: flex; align-items: center; gap: 10px;
        margin: 16px 20px 0;
        padding: 12px 18px;
        background: var(--navy);
        color: var(--white) !important;
        text-decoration: none;
        font-size: .84rem; font-weight: 700;
        border-radius: 12px;
        transition: .2s;
    }
    .mob-admin-link:hover { background: var(--navy-light); }
    .mob-admin-link i { color: var(--gold-light); }
}
</style>

{{-- ════ SITE HEADER ════ --}}
<header class="site-header" id="siteHeader">

    {{-- Topbar --}}
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

                {{-- Brand --}}
                <a href="{{ url('/') }}" class="brand">
                    <div class="brand-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="JDIH Logo"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                        <span class="brand-logo-fallback" style="display:none">JD</span>
                    </div>
                    <div class="brand-text">
                        <div class="brand-name">JDIH <em>Tanah Datar</em></div>
                        <div class="brand-sub">Jaringan Dokumentasi &amp; Informasi Hukum</div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="nav-links">
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        <i class="bi bi-house"></i> Beranda
                    </a>
                    <a href="{{ route('publik.statistik') }}" class="{{ request()->is('statistik*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-fill"></i> Statistik
                    </a>
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-book"></i> Regulasi <i class="bi bi-chevron-down" style="font-size:.5rem;margin-left:1px;"></i></button>
                        <div class="nav-dd-menu">
                            <span class="dd-lbl">Jenis Peraturan</span>
                            <a href="{{ url('/daftar/perda') }}" class="{{ request()->is('daftar/perda*')?'active':'' }}"><i class="bi bi-file-earmark-ruled"></i> Peraturan Daerah</a>
                            <a href="{{ url('/daftar/perbupati') }}" class="{{ request()->is('daftar/perbupati*')?'active':'' }}"><i class="bi bi-file-earmark-check"></i> Peraturan Bupati</a>
                            <a href="{{ url('/daftar/kepbupati') }}" class="{{ request()->is('daftar/kepbupati*')?'active':'' }}"><i class="bi bi-file-earmark-lock"></i> Keputusan Bupati</a>
                            <a href="{{ url('/daftar/insbupati') }}" class="{{ request()->is('daftar/insbupati*')?'active':'' }}"><i class="bi bi-file-earmark-arrow-down"></i> Instruksi Bupati</a>
                            <div class="dd-div"></div>
                            <a href="{{ url('/daftar/kerjasama') }}" class="{{ request()->is('daftar/kerjasama*')?'active':'' }}"><i class="bi bi-handshake"></i> Kerjasama Daerah</a>
                            <a href="{{ url('/daftar/perterjemah') }}" class="{{ request()->is('daftar/perterjemah*')?'active':'' }}"><i class="bi bi-translate"></i> Peraturan Terjemah</a>
                        </div>
                    </div>
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-file-text"></i> Dok. Hukum <i class="bi bi-chevron-down" style="font-size:.5rem;margin-left:1px;"></i></button>
                        <div class="nav-dd-menu">
                            <a href="{{ url('/daftar/kajian') }}" class="{{ request()->is('daftar/kajian*')?'active':'' }}"><i class="bi bi-journal-bookmark"></i> Kajian Hukum</a>
                            <a href="{{ url('/daftar/naskah') }}" class="{{ request()->is('daftar/naskah*')?'active':'' }}"><i class="bi bi-file-earmark-text"></i> Naskah Akademik</a>
                            <a href="{{ url('/daftar/analisis') }}" class="{{ request()->is('daftar/analisis*')?'active':'' }}"><i class="bi bi-clipboard-data"></i> Analisis Evaluasi</a>
                            <a href="{{ url('/daftar/risalah') }}" class="{{ request()->is('daftar/risalah*')?'active':'' }}"><i class="bi bi-journal-richtext"></i> Risalah Hukum</a>
                            <a href="{{ url('/daftar/relaas') }}" class="{{ request()->is('daftar/relaas*')?'active':'' }}"><i class="bi bi-bank"></i> Relaas Pengadilan</a>
                            <div class="dd-div"></div>
                            <a href="{{ url('/daftar/artikel') }}" class="{{ request()->is('daftar/artikel*')?'active':'' }}"><i class="bi bi-newspaper"></i> Artikel Hukum</a>
                        </div>
                    </div>
                    <div class="nav-dd">
                        <button class="nav-btn"><i class="bi bi-collection"></i> Dok. Lainnya <i class="bi bi-chevron-down" style="font-size:.5rem;margin-left:1px;"></i></button>
                        <div class="nav-dd-menu">
                            <a href="{{ url('/daftar/propemda') }}" class="{{ request()->is('daftar/propemda*')?'active':'' }}"><i class="bi bi-list-task"></i> Propemperda</a>
                            <a href="{{ url('/daftar/ranpuu') }}" class="{{ request()->is('daftar/ranpuu*')?'active':'' }}"><i class="bi bi-file-earmark-diff"></i> Rancangan PUU</a>
                            <div class="dd-div"></div>
                            <a href="{{ url('/daftar/buku') }}" class="{{ request()->is('daftar/buku*')?'active':'' }}"><i class="bi bi-book"></i> Perpustakaan Buku</a>
                            <a href="{{ url('/daftar/infografis') }}" class="{{ request()->is('daftar/infografis*')?'active':'' }}"><i class="bi bi-image"></i> Infografis</a>
                        </div>
                    </div>
                    <a href="{{ url('/daftar/berita') }}" class="{{ request()->is('daftar/berita*')?'active':'' }}">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                    <a href="{{ route('login') }}" class="btn-adm"><i class="bi bi-lock"></i> Admin</a>
                </div>

                {{-- Hamburger --}}
                <button class="ham" id="hamBtn" aria-label="Menu">
                    <i class="bi bi-list" id="hamIcon"></i>
                </button>
            </div>
        </div>
    </nav>
</header>

{{-- ════ MOBILE OVERLAY ════ --}}
<div id="mobOverlay"></div>

{{-- ════ MOBILE DRAWER MENU ════ --}}
<div class="mob-menu" id="mobMenu">

    {{-- Header drawer --}}
    <div class="mob-header">
        <div class="mob-header-brand">
            <div class="mob-header-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            </div>
            <div class="mob-header-name">JDIH <em>Tanah Datar</em></div>
        </div>
        <button class="mob-close" id="mobClose" aria-label="Tutup menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    {{-- Beranda --}}
    <a href="{{ url('/') }}" class="mob-home-link">
        <i class="bi bi-house-fill"></i> Beranda
    </a>
    <a href="{{ route('publik.statistik') }}" class="mob-home-link">
        <i class="bi bi-bar-chart-fill"></i> Statistik
    </a>

    {{-- Regulasi accordion --}}
    <div class="mob-group">
        <button class="mob-group-btn" onclick="toggleMobGroup(this)">
            <span class="mob-group-left">
                <i class="bi bi-book gicon"></i> Regulasi
            </span>
            <i class="bi bi-chevron-down mob-chevron"></i>
        </button>
        <div class="mob-sub-list">
            <a href="{{ url('/daftar/perda') }}"><i class="bi bi-file-earmark-ruled"></i> Peraturan Daerah</a>
            <a href="{{ url('/daftar/perbupati') }}"><i class="bi bi-file-earmark-check"></i> Peraturan Bupati</a>
            <a href="{{ url('/daftar/kepbupati') }}"><i class="bi bi-file-earmark-lock"></i> Keputusan Bupati</a>
            <a href="{{ url('/daftar/insbupati') }}"><i class="bi bi-file-earmark-arrow-down"></i> Instruksi Bupati</a>
            <div class="mob-sub-divider"></div>
            <a href="{{ url('/daftar/kerjasama') }}"><i class="bi bi-handshake"></i> Kerjasama Daerah</a>
            <a href="{{ url('/daftar/perterjemah') }}"><i class="bi bi-translate"></i> Peraturan Terjemah</a>
        </div>
    </div>

    {{-- Dokumen Hukum accordion --}}
    <div class="mob-group">
        <button class="mob-group-btn" onclick="toggleMobGroup(this)">
            <span class="mob-group-left">
                <i class="bi bi-file-earmark-text gicon"></i> Dokumen Hukum
            </span>
            <i class="bi bi-chevron-down mob-chevron"></i>
        </button>
        <div class="mob-sub-list">
            <a href="{{ url('/daftar/kajian') }}"><i class="bi bi-journal-bookmark"></i> Kajian Hukum</a>
            <a href="{{ url('/daftar/naskah') }}"><i class="bi bi-file-earmark-text"></i> Naskah Akademik</a>
            <a href="{{ url('/daftar/analisis') }}"><i class="bi bi-clipboard-data"></i> Analisis Evaluasi</a>
            <a href="{{ url('/daftar/risalah') }}"><i class="bi bi-journal-richtext"></i> Risalah Hukum</a>
            <a href="{{ url('/daftar/relaas') }}"><i class="bi bi-bank"></i> Relaas Pengadilan</a>
            <div class="mob-sub-divider"></div>
            <a href="{{ url('/daftar/artikel') }}"><i class="bi bi-newspaper"></i> Artikel Hukum</a>
        </div>
    </div>

    {{-- Dok Lainnya accordion --}}
    <div class="mob-group">
        <button class="mob-group-btn" onclick="toggleMobGroup(this)">
            <span class="mob-group-left">
                <i class="bi bi-collection gicon"></i> Dok. Hukum Lainnya
            </span>
            <i class="bi bi-chevron-down mob-chevron"></i>
        </button>
        <div class="mob-sub-list">
            <a href="{{ url('/daftar/propemda') }}"><i class="bi bi-list-task"></i> Propemperda</a>
            <a href="{{ url('/daftar/ranpuu') }}"><i class="bi bi-file-earmark-diff"></i> Rancangan PUU</a>
            <div class="mob-sub-divider"></div>
            <a href="{{ url('/daftar/buku') }}"><i class="bi bi-book"></i> Perpustakaan Buku</a>
            <a href="{{ url('/daftar/infografis') }}"><i class="bi bi-image"></i> Infografis</a>
        </div>
    </div>

    {{-- Berita --}}
    <a href="{{ url('/daftar/berita') }}" class="mob-direct-link">
        <i class="bi bi-newspaper"></i> Berita
    </a>

    {{-- Admin --}}
    <a href="{{ route('login') }}" class="mob-admin-link">
        <i class="bi bi-lock-fill"></i> Login Admin
    </a>


</div>

<script>
// ════ MOBILE DRAWER ════
const hamBtn    = document.getElementById('hamBtn');
const mobMenu   = document.getElementById('mobMenu');
const mobClose  = document.getElementById('mobClose');
const mobOverlay= document.getElementById('mobOverlay');
const hamIcon   = document.getElementById('hamIcon');

function openMobMenu(){
    mobMenu.classList.add('open');
    mobOverlay.classList.add('open');
    hamIcon.className = 'bi bi-x-lg';
    document.body.style.overflow = 'hidden';
}
function closeMobMenu(){
    mobMenu.classList.remove('open');
    mobOverlay.classList.remove('open');
    hamIcon.className = 'bi bi-list';
    document.body.style.overflow = '';
}

hamBtn.addEventListener('click', function(){
    mobMenu.classList.contains('open') ? closeMobMenu() : openMobMenu();
});
mobClose.addEventListener('click', closeMobMenu);
mobOverlay.addEventListener('click', closeMobMenu);

// Tutup dengan swipe kanan
let touchStartX = 0;
mobMenu.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, {passive:true});
mobMenu.addEventListener('touchend', e => {
    if(e.changedTouches[0].screenX - touchStartX > 60) closeMobMenu();
}, {passive:true});

// Accordion sub-menu
function toggleMobGroup(btn){
    const list = btn.nextElementSibling;
    const isOpen = list.classList.contains('open');
    // Tutup semua
    document.querySelectorAll('.mob-sub-list').forEach(l => l.classList.remove('open'));
    document.querySelectorAll('.mob-group-btn').forEach(b => b.classList.remove('active'));
    // Toggle yang diklik
    if(!isOpen){
        list.classList.add('open');
        btn.classList.add('active');
    }
}

// ════ CAT-TABS: Scroll ke tab aktif saat halaman load ════
(function(){
    const activeTab = document.querySelector('.cat-tab.active');
    if(activeTab) activeTab.scrollIntoView({behavior:'auto', block:'nearest', inline:'center'});
})();

// ════ STICKY HEADER SCROLL ════
window.addEventListener('scroll', function(){
    const h = document.getElementById('siteHeader');
    if(h) h.classList.toggle('scrolled', window.scrollY > 10);
}, {passive:true});
</script>