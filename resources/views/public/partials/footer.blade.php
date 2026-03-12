{{--
    ╔══════════════════════════════════════════════╗
    ║  PARTIAL: footer.blade.php                   ║
    ║  Isi: Footer + Back-to-top + Semua JS        ║
    ╚══════════════════════════════════════════════╝
    Cara pakai:
    @include('public.partials.footer')
--}}

{{-- ════ FOOTER ════ --}}
<footer>
    <div class="container">
        <div class="row gy-5">

            {{-- Brand --}}
            <div class="col-lg-4">
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                    <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(145deg,#0a1a45,#1a3a8f);display:flex;align-items:center;justify-content:center;border:1px solid rgba(240,180,41,.2);overflow:hidden;flex-shrink:0;">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:32px;height:32px;object-fit:contain;padding:4px;"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                        <span style="display:none;font-family:'Playfair Display',serif;font-size:.9rem;font-weight:700;color:var(--gold-light)">JD</span>
                    </div>
                    <div class="footer-logo">JDIH <em>Tanah Datar</em><br></div>
                </div>
                <p class="footer-desc">Jaringan Dokumentasi dan Informasi Hukum Kabupaten Tanah Datar. Menyediakan akses terbuka terhadap seluruh produk hukum daerah. Development by Zacky Alvarezy.</p>
                <div class="footer-socs">
                    <a href="" class="footer-soc"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/jdihtanahdatar/" class="footer-soc"><i class="bi bi-instagram"></i></a>
                    <a href="" class="footer-soc"><i class="bi bi-youtube"></i></a>
                    <a href="https://twitter.com/jdihtanahdatar/" class="footer-soc"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            {{-- Regulasi --}}
            <div class="col-sm-4 col-lg-2 footer-col">
                <h6>Regulasi</h6>
                <ul>
                    <li><a href="{{ url('/daftar/perda') }}"><i class="bi bi-chevron-right"></i> Peraturan Daerah</a></li>
                    <li><a href="{{ url('/daftar/perbupati') }}"><i class="bi bi-chevron-right"></i> Peraturan Bupati</a></li>
                    <li><a href="{{ url('/daftar/kepbupati') }}"><i class="bi bi-chevron-right"></i> Keputusan Bupati</a></li>
                    <li><a href="{{ url('/daftar/insbupati') }}"><i class="bi bi-chevron-right"></i> Instruksi Bupati</a></li>
                    <li><a href="{{ url('/daftar/propemda') }}"><i class="bi bi-chevron-right"></i> Propemda</a></li>
                    <li><a href="{{ url('/daftar/kerjasama') }}"><i class="bi bi-chevron-right"></i> Kerjasama</a></li>
                    <li><a href="{{ url('/daftar/perterjemah') }}"><i class="bi bi-chevron-right"></i> Peraturan Terjemah</a></li>
                    <li><a href="{{ url('/daftar/ranpuu') }}"><i class="bi bi-chevron-right"></i> Rancangan PUU</a></li>
                </ul>
            </div>

            {{-- Dokumen Hukum --}}
            <div class="col-sm-4 col-lg-3 footer-col">
                <h6>Dokumen Hukum</h6>
                <ul>
                    <li><a href="{{ url('/daftar/kajian') }}"><i class="bi bi-chevron-right"></i> Kajian Hukum</a></li>
                    <li><a href="{{ url('/daftar/naskah') }}"><i class="bi bi-chevron-right"></i> Naskah Akademik</a></li>
                    <li><a href="{{ url('/daftar/analisis') }}"><i class="bi bi-chevron-right"></i> Analisis Evaluasi</a></li>
                    <li><a href="{{ url('/daftar/risalah') }}"><i class="bi bi-chevron-right"></i> Risalah Hukum</a></li>
                    <li><a href="{{ url('/daftar/relaas') }}"><i class="bi bi-chevron-right"></i> Relaas Pengadilan</a></li>
                </ul>
            </div>

            {{-- Konten & Akses --}}
            <div class="col-sm-4 col-lg-3 footer-col">
                <h6>Konten &amp; Berita</h6>
                <ul>
                    <li><a href="{{ url('/daftar/artikel') }}"><i class="bi bi-chevron-right"></i> Artikel</a></li>
                    <li><a href="{{ url('/daftar/infografis') }}"><i class="bi bi-chevron-right"></i> Infografis</a></li>
                    <li><a href="{{ url('/daftar/buku') }}"><i class="bi bi-chevron-right"></i> Perpustakaan Buku</a></li>
                    <li><a href="{{ url('/daftar/berita') }}"><i class="bi bi-chevron-right"></i> Berita Terkini</a></li>
                </ul>
                <h6 class="mt-4">Akses Admin</h6>
                <ul>
                    <li><a href="{{ route('login') }}"><i class="bi bi-lock"></i> Login Admin</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} JDIH Tanah Datar. Hak cipta dilindungi undang-undang.</span>
            <span>v2.1 · Laravel · Bootstrap 5</span>
        </div>
    </div>
</footer>

{{-- Back to top --}}
<button id="btt" aria-label="Kembali ke atas"><i class="bi bi-chevron-up"></i></button>

{{-- ════ SCRIPTS ════ --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ════ CATATAN: Welcome Splash dihandle di navbar.blade.php (pakai sessionStorage) ════

// ════ MOBILE MENU ════
function toggleMenu(){
    const m = document.getElementById('mobMenu'), i = document.getElementById('hamIcon');
    const o = m.style.display === 'block';
    m.style.display = o ? 'none' : 'block';
    i.className = o ? 'bi bi-list' : 'bi bi-x-lg';
}

// ════ REGULASI TAB SWITCH ════
function switchReg(id, btn){
    document.querySelectorAll('.reg-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.reg-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    btn.classList.add('active');
}

// ════ PRODUK TERBARU TAB SWITCH ════
function switchTab(id, btn){
    document.querySelectorAll('.pt-panel').forEach(p=>p.classList.remove('active'));
    document.querySelectorAll('.pt-tab').forEach(t=>t.classList.remove('active'));
    const panel = document.getElementById(id);
    if(panel) panel.classList.add('active');
    btn.classList.add('active');
}

// ════ SCROLL SPY untuk cat-tabs ════
const spySecs = ['terbaru','regulasi','dokumen','media','berita'];
window.addEventListener('scroll', ()=>{
    let cur = spySecs[0];
    spySecs.forEach(id=>{ const el=document.getElementById(id); if(el && window.scrollY >= el.offsetTop - 160) cur=id; });
    document.querySelectorAll('.cat-tab').forEach(t=>t.classList.toggle('active', t.getAttribute('href')==='#'+cur));
}, {passive:true});

// ════ SCROLL REVEAL ════
const revObs = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
        if(e.isIntersecting){
            const el=e.target;
            setTimeout(()=>el.classList.add('on'), parseInt(el.dataset.delay)||0);
            revObs.unobserve(el);
        }
    });
}, {threshold:.06, rootMargin:'0px 0px -40px 0px'});
document.querySelectorAll('.row').forEach(row=>{
    row.querySelectorAll('.reveal').forEach((c,i)=>c.dataset.delay = i*85);
});
document.querySelectorAll('.reveal,.reveal-left,.reveal-scale').forEach(el=>revObs.observe(el));

// ════ COUNTER ANIMASI ════
function animCounter(el){
    const target = parseInt(el.dataset.target)||0;
    if(!target){ el.textContent='0'; return; }
    const dur=1600, start=performance.now();
    const ease = t => 1 - Math.pow(1-t,3);
    (function tick(now){
        const p = Math.min((now-start)/dur, 1);
        el.textContent = Math.round(ease(p)*target);
        if(p<1) requestAnimationFrame(tick); else el.textContent = target;
    })(start);
}
const ctrObs = new IntersectionObserver(entries=>{
    entries.forEach(e=>{ if(e.isIntersecting){ animCounter(e.target); ctrObs.unobserve(e.target); } });
}, {threshold:.5});
document.querySelectorAll('.counter').forEach(el=>ctrObs.observe(el));

// ════ SMOOTH ANCHOR ════
document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener('click', e=>{
        const t = document.querySelector(a.getAttribute('href'));
        if(t){ e.preventDefault(); t.scrollIntoView({behavior:'smooth',block:'start'}); }
    });
});

// ════ SEARCH AUTOCOMPLETE ════
(function(){
    const input   = document.getElementById('searchInput');
    const box     = document.getElementById('searchSuggest');
    if(!input || !box) return;

    let timer = null;
    let currentQ = '';

    window.fetchSuggestions = function(q){
        q = q.trim();
        if(q === currentQ) return;
        currentQ = q;
        clearTimeout(timer);

        if(q.length < 2){ box.style.display='none'; return; }

        timer = setTimeout(async ()=>{
            try{
                const res  = await fetch(`/api/search-suggestions?q=${encodeURIComponent(q)}`);
                const data = await res.json();
                renderSuggestions(data, q);
            } catch(e){ box.style.display='none'; }
        }, 250);
    };

    window.closeSuggestions = function(){ box.style.display='none'; };

    function renderSuggestions(items, q){
        if(!items.length){
            box.innerHTML = `<div class="suggest-empty"><i class="bi bi-search" style="margin-right:6px"></i>Tidak ada saran untuk "<strong>${escHtml(q)}</strong>"</div>`;
            box.style.display='block';
            return;
        }
        const icons = {
            'Perda':'bi-file-earmark-ruled','Perbupati':'bi-file-earmark-check',
            'SK Bupati':'bi-file-earmark-lock','Instruksi':'bi-file-earmark-arrow-down',
            'Propemda':'bi-list-task','Terjemah':'bi-translate','Kajian':'bi-journal-bookmark',
            'Naskah':'bi-file-earmark-text','Artikel':'bi-newspaper','Berita':'bi-newspaper',
            'Buku':'bi-book'
        };
        const rows = items.map(item=>{
            const icon = icons[item.label] || 'bi-file-earmark';
            const highlighted = highlightMatch(escHtml(item.judul), q);
            return `<a href="${item.url}" class="suggest-item">
                <div class="suggest-icon"><i class="bi ${icon}"></i></div>
                <div class="suggest-text">
                    <div class="suggest-judul">${highlighted}</div>
                    <div class="suggest-label">${escHtml(item.label)}</div>
                </div>
            </a>`;
        }).join('');

        box.innerHTML = rows +
            `<div class="suggest-footer" onclick="document.querySelector('form').submit()">
                <i class="bi bi-search"></i> Lihat semua hasil untuk "<strong>${escHtml(q)}</strong>"
            </div>`;
        box.style.display = 'block';
    }

    function highlightMatch(text, q){
        const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')})`, 'gi');
        return text.replace(re, '<mark style="background:#fef9c3;border-radius:3px;padding:0 2px">$1</mark>');
    }

    function escHtml(s){ return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

    // Tutup saat klik di luar
    document.addEventListener('click', e=>{
        if(!e.target.closest('#searchWrap')) box.style.display='none';
    });

    // Navigasi keyboard
    input.addEventListener('keydown', e=>{
        const items = box.querySelectorAll('.suggest-item');
        const active = box.querySelector('.suggest-item.kb-active');
        if(e.key==='Escape'){ box.style.display='none'; return; }
        if(e.key==='ArrowDown'){
            e.preventDefault();
            if(!active) items[0]?.classList.add('kb-active');
            else{ active.classList.remove('kb-active'); (active.nextElementSibling||items[0])?.classList.add('kb-active'); }
        }
        if(e.key==='ArrowUp'){
            e.preventDefault();
            if(!active) items[items.length-1]?.classList.add('kb-active');
            else{ active.classList.remove('kb-active'); (active.previousElementSibling||items[items.length-1])?.classList.add('kb-active'); }
        }
        if(e.key==='Enter' && active){ e.preventDefault(); window.location.href = active.href; }
    });
})();

// ════ BUKU CAROUSEL ════
(function(){
    const wrap = document.getElementById('bukuCarousel');
    const btnP = document.querySelector('.buku-nav-prev');
    const btnN = document.querySelector('.buku-nav-next');
    if(!wrap) return;

    function cardWidth(){
        const c = wrap.querySelector('.buku-card');
        return c ? c.offsetWidth + 14 : 160;
    }

    window.scrollBuku = function(dir){
        wrap.scrollBy({ left: dir * cardWidth(), behavior: 'smooth' });
    };

    function updateBtns(){
        if(btnP) btnP.style.opacity = wrap.scrollLeft <= 4 ? '.35' : '1';
        if(btnN) btnN.style.opacity = wrap.scrollLeft >= wrap.scrollWidth - wrap.clientWidth - 4 ? '.35' : '1';
    }
    wrap.addEventListener('scroll', updateBtns, {passive:true});
    updateBtns();
})();
</script>
</body>
</html>