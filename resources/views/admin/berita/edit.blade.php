@extends('layouts.admin')

@section('content')
<style>
    .form-wrapper{max-width:1000px;margin:0 auto;font-family:'Inter',sans-serif;}
    .card-edit{background:white;border-radius:24px;padding:40px;border:1px solid #f1f5f9;box-shadow:0 10px 15px -3px rgba(0,0,0,0.05);}
    .edit-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:30px 45px;}
    .full-width{grid-column:span 2;}
    label{font-size:13px;font-weight:700;color:#475569;margin-bottom:10px;display:block;}
    .form-control{width:100%;padding:12px 16px;background:#f8fafc;border:2px solid #e2e8f0;border-radius:12px;font-size:14px;transition:all 0.3s ease;box-sizing:border-box;}
    .form-control:focus{border-color:#7f1d1d;background:#fff;box-shadow:0 0 0 4px rgba(127,29,29,0.08);outline:none;}
    .is-invalid{border-color:#f43f5e!important;}
    .error-msg{color:#f43f5e;font-size:11px;margin-top:6px;font-weight:600;display:block;}
    .section-title{grid-column:span 2;margin-top:10px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;color:#1e293b;font-weight:800;font-size:15px;display:flex;align-items:center;gap:10px;}
    .btn-update{background:#7f1d1d;color:white;padding:14px 40px;border-radius:12px;font-weight:700;border:none;cursor:pointer;transition:0.3s;box-shadow:0 4px 12px rgba(127,29,29,0.2);}
    .btn-update:hover{background:#991b1b;transform:translateY(-2px);}
</style>

<div class="form-wrapper">
    <div style="margin-bottom:30px;border-bottom:2px solid #f1f5f9;padding-bottom:20px;">
        <h1 style="font-size:28px;font-weight:800;color:#1e293b;margin:0;">Edit Berita</h1>
        <p style="color:#64748b;margin-top:5px;">Memperbarui: <strong style="color:#7f1d1d;">{{ $berita->judul }}</strong></p>

        {{-- Info URL: tunjukkan keduanya --}}
        <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:14px;">
            {{-- URL Publik (slug) --}}
            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:8px 14px;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-globe" style="color:#3b82f6;font-size:12px;"></i>
                <span style="font-size:11px;color:#1d4ed8;font-weight:600;">URL PUBLIK</span>
                <code style="font-size:11px;color:#1e40af;font-family:monospace;">/berita/{{ $berita->slug }}</code>
            </div>
            {{-- ID Admin (terenkripsi) --}}
            <div style="background:#fef9c3;border:1px solid #fde68a;border-radius:10px;padding:8px 14px;display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-lock" style="color:#ca8a04;font-size:12px;"></i>
                <span style="font-size:11px;color:#92400e;font-weight:600;">ID ADMIN</span>
                <code style="font-size:11px;color:#78350f;font-family:monospace;">{{ Str::limit($encryptedId, 20) }}...</code>
                <span style="font-size:10px;color:#92400e;background:#fef3c7;padding:1px 6px;border-radius:4px;">🔒 terenkripsi</span>
            </div>
        </div>

        @if($berita->isDirty('judul') === false)
        <p style="font-size:12px;color:#94a3b8;margin-top:8px;">
            <i class="fa-solid fa-triangle-exclamation" style="color:#fbbf24;"></i>
            Jika judul diubah, slug URL publik akan berubah otomatis.
        </p>
        @endif
    </div>

    {{-- Form update: action pakai encryptedId --}}
    <form action="{{ route('berita.update', $encryptedId) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-edit">
            <div class="edit-grid">

                <div class="section-title" style="margin-top:0;">
                    <i class="fa-solid fa-pen-to-square" style="color:#7f1d1d;"></i> Informasi Berita
                </div>

                <div class="field-group full-width">
                    <label>Judul Berita</label>
                    <input type="text" name="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $berita->judul) }}">
                    @error('judul')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="field-group full-width">
                    <label>Isi Berita</label>
                    <textarea name="isi" rows="10"
                        class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="section-title">
                    <i class="fa-solid fa-image" style="color:#7f1d1d;"></i> Gambar & Pengaturan
                </div>

                <div class="field-group full-width">
                    <label>Gambar Saat Ini</label>
                    <div style="display:flex;gap:20px;align-items:center;background:#f8fafc;padding:20px;border-radius:16px;border:2px dashed #e2e8f0;">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}"
                                style="width:120px;height:80px;object-fit:cover;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1);">
                        @else
                            <div style="width:120px;height:80px;background:#e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-image" style="color:#94a3b8;font-size:24px;"></i>
                            </div>
                        @endif
                        <div style="flex:1;">
                            <input type="file" name="gambar"
                                class="form-control @error('gambar') is-invalid @enderror"
                                style="padding:10px;background:white;" accept="image/*">
                            <small style="color:#94a3b8;margin-top:8px;display:block;">*Abaikan jika tidak ingin mengganti gambar</small>
                            @error('gambar')<span class="error-msg">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label>Tampilkan di Website</label>
                    <select name="tampilkan" class="form-control @error('tampilkan') is-invalid @enderror">
                        <option value="Ya" {{ old('tampilkan', $berita->tampilkan)=='Ya'?'selected':'' }}>Ya — Tampilkan</option>
                        <option value="Tidak" {{ old('tampilkan', $berita->tampilkan)=='Tidak'?'selected':'' }}>Tidak — Sembunyikan</option>
                    </select>
                    @error('tampilkan')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="full-width" style="margin-top:20px;padding-top:30px;border-top:1px solid #f1f5f9;display:flex;gap:15px;align-items:center;">
                    <button type="submit" class="btn-update">
                        <i class="fa-solid fa-check-double" style="margin-right:8px;"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('berita.index') }}" style="color:#64748b;font-weight:700;text-decoration:none;font-size:14px;">Kembali</a>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection