
{{-- ── 1. HEAD: DOCTYPE, meta, fonts, semua CSS ── --}}
@include('public.partials.head')

{{-- ── 2. NAVBAR: Page Loader · Topbar · Navbar (satu sticky unit) ── --}}
@include('public.partials.navbar')

{{-- ── 3. SECTIONS: Hero · Search · Stats · Tabs · Produk Terbaru
              Regulasi · Dokumen Hukum · Media · Berita ── --}}
@include('public.partials.sections')

{{-- ── 4. FOOTER: Footer · Back-to-top · Semua JavaScript ── --}}
@include('public.partials.footer')