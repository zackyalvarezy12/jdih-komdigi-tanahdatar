@extends('layouts.admin')

@section('content')
<style>
    .form-wrapper{max-width:950px;margin:0 auto;font-family:'Inter',sans-serif;}
    .card-form{background:white;border-radius:28px;padding:45px;border:1px solid #f1f5f9;box-shadow:0 15px 35px -5px rgba(0,0,0,0.05);}
    .form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:25px 40px;}
    .full-width{grid-column:span 2;}
    .field-group{display:flex;flex-direction:column;width:100%;}
    label{font-size:13px;font-weight:700;color:#475569;margin-bottom:10px;display:block;}
    .form-control{width:100%;padding:14px 18px;background:#f8fafc;border:2px solid #e2e8f0;border-radius:14px;font-size:14px;transition:all 0.3s ease;box-sizing:border-box;}
    .form-control:focus{border-color:#7f1d1d;background:#fff;box-shadow:0 0 0 4px rgba(127,29,29,0.08);outline:none;}
    .is-invalid{border-color:#f43f5e!important;}
    .error-msg{color:#f43f5e;font-size:11px;margin-top:5px;display:block;font-weight:600;}
    .section-header{grid-column:span 2;margin:15px 0 5px;padding-bottom:12px;border-bottom:2px solid #f8fafc;color:#1e293b;font-weight:800;font-size:16px;display:flex;align-items:center;gap:12px;}
    .btn-save{background:#7f1d1d;color:white;padding:15px 45px;border-radius:14px;font-weight:700;border:none;cursor:pointer;transition:0.3s;box-shadow:0 8px 15px rgba(127,29,29,0.2);}
    .btn-save:hover{background:#991b1b;transform:translateY(-2px);}
    .slug-preview{background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;padding:10px 14px;font-size:12px;color:#64748b;margin-top:8px;display:none;align-items:center;font-family:monospace;}
</style>

<div class="form-wrapper">
    <div style="margin-bottom:35px;">
        <h1 style="font-size:30px;font-weight:800;color:#1e293b;margin:0;letter-spacing:-1px;">Tambah Berita Baru</h1>
        <p style="color:#64748b;margin-top:5px;">Slug URL publik dibuat otomatis dari judul. ID admin akan dienkripsi.</p>
    </div>

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-form">
            <div class="form-grid">

                <div class="section-header" style="margin-top:0;">
                    <i class="fa-solid fa-newspaper" style="color:#7f1d1d;"></i> Informasi Berita
                </div>

                <div class="field-group full-width">
                    <label>Judul Berita</label>
                    <input type="text" name="judul" id="judul-input"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul berita..."
                        oninput="previewSlug(this.value)">
                    @error('judul')<span class="error-msg">{{ $message }}</span>@enderror
                    {{-- Preview slug realtime --}}
                    <div class="slug-preview" id="slug-preview">
                        <i class="fa-solid fa-globe" style="color:#94a3b8;margin-right:6px;"></i>
                        <span style="color:#94a3b8;">URL Publik: /berita/</span>
                        <span id="slug-text" style="color:#475569;font-weight:700;"></span>
                        <span style="margin-left:8px;background:#dcfce7;color:#15803d;font-size:10px;padding:1px 8px;border-radius:4px;font-family:sans-serif;">otomatis</span>
                    </div>
                </div>

                <div class="field-group full-width">
                    <label>Isi Berita</label>
                    <textarea name="isi" rows="8"
                        class="form-control @error('isi') is-invalid @enderror"
                        placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
                    @error('isi')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="field-group">
                    <label>Gambar Berita <span style="color:#94a3b8;font-weight:400;">(opsional, maks. 2MB)</span></label>
                    <input type="file" name="gambar"
                        class="form-control @error('gambar') is-invalid @enderror"
                        style="padding:10px;" accept="image/*">
                    @error('gambar')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="field-group">
                    <label>Tampilkan di Website</label>
                    <select name="tampilkan" class="form-control @error('tampilkan') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Ya" {{ old('tampilkan')=='Ya'?'selected':'' }}>Ya — Tampilkan</option>
                        <option value="Tidak" {{ old('tampilkan')=='Tidak'?'selected':'' }}>Tidak — Sembunyikan</option>
                    </select>
                    @error('tampilkan')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="full-width" style="margin-top:20px;display:flex;align-items:center;gap:20px;">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-paper-plane" style="margin-right:8px;"></i> Terbitkan Berita
                    </button>
                    <a href="{{ route('berita.index') }}" style="color:#94a3b8;font-weight:700;text-decoration:none;font-size:14px;">Batalkan</a>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
function previewSlug(value) {
    const slug = value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    const preview = document.getElementById('slug-preview');
    const slugText = document.getElementById('slug-text');
    if (slug) {
        slugText.textContent = slug;
        preview.style.display = 'flex';
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endsection