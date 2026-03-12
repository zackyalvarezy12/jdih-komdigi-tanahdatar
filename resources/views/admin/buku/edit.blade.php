@extends('layouts.admin')

@section('content')
<style>
    .form-wrapper { max-width: 1000px; margin: 0 auto; font-family: 'Inter', sans-serif; }
    
    .header-section { margin-bottom: 30px; border-bottom: 2px solid #f1f5f9; padding-bottom: 20px; }
    .header-section h1 { font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; }
    .header-section p { color: #64748b; margin-top: 5px; }

    .card-edit {
        background: white; border-radius: 24px; padding: 40px;
        border: 1px solid #f1f5f9; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
    }

    .edit-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px 45px;
    }

    .full-width { grid-column: span 2; }

    label {
        font-size: 13px; font-weight: 700; color: #475569;
        margin-bottom: 10px; display: block;
    }

    .form-control {
        width: 100%; padding: 12px 16px; background: #f8fafc;
        border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px;
        transition: all 0.3s ease; box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #10b981; background: #fff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); outline: none;
    }

    .is-invalid { border-color: #f43f5e !important; box-shadow: 0 0 0 4px rgba(244,63,94,0.1) !important; }
    .error-msg { color: #f43f5e; font-size: 11px; margin-top: 6px; font-weight: 600; display: block; }

    .cover-preview-box {
        display: flex; gap: 20px; align-items: center; 
        background: #f8fafc; padding: 20px; border-radius: 16px; 
        border: 2px dashed #e2e8f0;
    }
    .cover-img {
        width: 80px; height: 110px; object-fit: cover; 
        border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .section-title {
        grid-column: span 2; margin-top: 10px; padding-bottom: 8px;
        border-bottom: 1px solid #f1f5f9; color: #1e293b;
        font-weight: 800; font-size: 15px; display: flex; align-items: center; gap: 10px;
    }

    .btn-update {
        background: #10b981; color: white; padding: 14px 40px;
        border-radius: 12px; font-weight: 700; border: none; cursor: pointer;
        transition: 0.3s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    .btn-update:hover { background: #059669; transform: translateY(-2px); }
</style>

<div class="form-wrapper">
    <div class="header-section">
        <h1>Edit Koleksi Buku</h1>
        <p>Memperbarui data: <span style="color: #10b981; font-weight: 700;">{{ $buku->judul }}</span></p>
    </div>

    {{--
        Form action menggunakan $encryptedId dari controller.
        ID asli tidak pernah tampil di URL maupun HTML.
        URL akan terlihat seperti: /admin/buku/update/eyJpdiI6Ii4uLiJ9...
    --}}
    <form action="{{ route('buku.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        
        <div class="card-edit">
            <div class="edit-grid">
                
                <div class="section-title">
                    <i class="fa-solid fa-pen-to-square" style="color: #10b981;"></i> Informasi Katalog
                </div>

                <div class="field-group full-width">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $buku->judul) }}">
                    @error('judul')
                        <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $buku->penulis) }}">
                    @error('penulis')
                        <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}" placeholder="978-xxx-xxx">
                </div>

                <div class="field-group">
                    <label>Lokasi Rak</label>
                    <input type="text" name="rak" class="form-control @error('rak') is-invalid @enderror" value="{{ old('rak', $buku->rak) }}">
                    @error('rak')
                        <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Nomor Baris</label>
                    <input type="text" name="baris" class="form-control @error('baris') is-invalid @enderror" value="{{ old('baris', $buku->baris) }}">
                    @error('baris')
                        <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="section-title">
                    <i class="fa-solid fa-image" style="color: #10b981;"></i> Media & Detail Fisik
                </div>

                <div class="field-group full-width">
                    <label>Cover Buku Saat Ini</label>
                    <div class="cover-preview-box">
                        @if($buku->cover)
                            <img src="{{ asset('storage/' . $buku->cover) }}" class="cover-img">
                        @else
                            <div style="width: 80px; height: 110px; background: #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-book" style="color: #94a3b8; font-size: 24px;"></i>
                            </div>
                        @endif
                        <div style="flex: 1;">
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" style="padding: 10px; background: white;">
                            <small style="color: #94a3b8; margin-top: 8px; display: block;">*Abaikan jika tidak ingin mengganti cover</small>
                            @error('cover')
                                <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit) }}">
                </div>

                <div class="field-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                    @error('tahun_terbit')
                        <span class="error-msg"><i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group full-width">
                    <label>Deskripsi Fisik</label>
                    <input type="text" name="deskripsi_fisik" class="form-control" value="{{ old('deskripsi_fisik', $buku->deskripsi_fisik) }}" placeholder="Contoh: xii, 210 hlm.; 21 cm">
                </div>

                <div class="full-width" style="margin-top: 20px; padding-top: 30px; border-top: 1px solid #f1f5f9; display: flex; gap: 15px; align-items: center;">
                    <button type="submit" class="btn-update">
                        <i class="fa-solid fa-check-double" style="margin-right: 8px;"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('buku.index') }}" style="color: #64748b; font-weight: 700; text-decoration: none; font-size: 14px;">Kembali</a>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection