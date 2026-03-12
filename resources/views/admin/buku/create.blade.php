@extends('layouts.admin')

@section('content')
<style>
    /* 1. Reset & Wrapper */
    .form-wrapper { max-width: 950px; margin: 0 auto; font-family: 'Inter', sans-serif; }
    
    /* 2. Card Styling */
    .card-form {
        background: white; border-radius: 28px; padding: 45px;
        border: 1px solid #f1f5f9; box-shadow: 0 15px 35px -5px rgba(0,0,0,0.05);
    }

    /* 3. Grid Logic (Kunci Kepresisian) */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 Kolom Presisi */
        gap: 25px 40px; /* Gap Vertikal 25px, Horizontal 40px */
    }

    /* Utilitas untuk elemen yang mau lebar penuh di dalam grid */
    .full-width { grid-column: span 2; }

    /* 4. Input Styling */
    .field-group { display: flex; flex-direction: column; width: 100%; }
    
    label {
        font-size: 13px; font-weight: 700; color: #475569;
        margin-bottom: 10px; display: block;
    }

    .form-control {
        width: 100%; padding: 14px 18px; background: #f8fafc;
        border: 2px solid #e2e8f0; border-radius: 14px; font-size: 14px;
        transition: all 0.3s ease; box-sizing: border-box; /* Presisi ukuran */
    }

    .form-control:focus {
        border-color: #10b981; background: #fff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); outline: none;
    }

    /* 5. Dekorasi & Button */
    .section-header {
        grid-column: span 2; margin: 15px 0 5px; padding-bottom: 12px;
        border-bottom: 2px solid #f8fafc; color: #1e293b;
        font-weight: 800; font-size: 16px; display: flex; align-items: center; gap: 12px;
    }

    .btn-save {
        background: #10b981; color: white; padding: 15px 45px;
        border-radius: 14px; font-weight: 700; border: none; cursor: pointer;
        transition: 0.3s; box-shadow: 0 8px 15px rgba(16, 185, 129, 0.2);
    }
    
    .btn-save:hover { background: #059669; transform: translateY(-2px); }
</style>

<div class="form-wrapper">
    <div style="margin-bottom: 35px;">
        <h1 style="font-size: 30px; font-weight: 800; color: #1e293b; margin: 0; letter-spacing: -1px;">Tambah Koleksi Buku</h1>
        <p style="color: #64748b; margin-top: 5px;">Pastikan data literatur diisi sesuai dengan standar katalog perpustakaan.</p>
    </div>

    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-form">
            <div class="form-grid">
                <div class="section-header" style="margin-top:0;">
                    <i class="fa-solid fa-book-open text-emerald-500"></i> Informasi Utama
                </div>
                
                <div class="field-group full-width">
                    <label>Judul Lengkap Buku</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Masukkan judul buku">
                    @error('judul')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Penulis / Pengarang</label>
                    <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" placeholder="Nama Lengkap">
                    @error('penulis')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Unggah Cover (JPG/PNG)</label>
                    <input type="file" name="cover" class="form-control" style="padding: 10px;">
                    @error('cover')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Posisi Rak</label>
                    <input type="text" name="rak" class="form-control" value="{{ old('rak') }}" placeholder="Contoh: R-01">
                    @error('rak')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Posisi Baris</label>
                    <input type="text" name="baris" class="form-control" value="{{ old('baris') }}" placeholder="Contoh: B-05">
                    @error('baris')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="section-header">
                    <i class="fa-solid fa-fingerprint text-emerald-500"></i> Metadata & Detail Fisik
                </div>

                <div class="field-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
                    @error('penerbit')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Nomor ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" placeholder="978-xxx-xxx">
                    @error('isbn')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" placeholder="2024">
                    @error('tahun')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label>Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" class="form-control" value="{{ old('bidang_hukum') }}">
                    @error('bidang_hukum')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group full-width">
                    <label>Deskripsi Fisik</label>
                    <input type="text" name="deskripsi_fisik" class="form-control" value="{{ old('deskripsi_fisik') }}" placeholder="Contoh: xii, 210 hlm.; 21 cm">
                    @error('deskripsi_fisik')
                        <small style="color: #f43f5e; font-size: 11px; margin-top: 5px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="full-width" style="margin-top: 20px; display: flex; align-items: center; gap: 20px;">
                    <button type="submit" class="btn-save">Simpan Koleksi</button>
                    <a href="{{ route('buku.index') }}" style="color: #94a3b8; font-weight: 700; text-decoration: none; font-size: 14px;">Batalkan</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection