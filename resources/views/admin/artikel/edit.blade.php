@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; text-transform: lowercase;">edit artikel</h2>
            <p style="color: #64748b; margin-top: 5px;">Perbarui data artikel dan informasi meta secara detail.</p>
        </div>
        <a href="{{ route('artikel.index') }}" class="btn" style="background: #f1f5f9; color: #64748b; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
        </a>
    </div>

    {{-- novalidate: matikan validasi bawaan browser, serahkan ke Laravel --}}
    {{-- Form action menggunakan encryptedId (ID tidak terlihat di URL) --}}
    <form action="{{ route('artikel.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; margin-bottom: 30px;">

            {{-- Judul --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Judul <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('judul') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('judul')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Isi / Konten --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Isi <span style="color: #ef4444;">*</span>
                </label>
                <textarea name="konten" id="editor" style="width: 100%;">{{ old('konten', $artikel->konten) }}</textarea>
                @error('konten')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Gambar --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    File Dokumen / Gambar Sampul :
                    <span style="font-weight: 400; color: #94a3b8; font-size: 12px;">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input type="file" name="gambar" style="font-size: 14px; color: #64748b;">
                @if($artikel->gambar)
                    <p style="margin-top: 10px; font-size: 12px; color: #64748b;">File saat ini: <span style="color: #10b981;">{{ $artikel->gambar }}</span></p>
                @endif
                @error('gambar')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>

        <h3 style="font-weight: 700; color: #1e293b; margin-bottom: 20px;">Meta Data</h3>
        <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                {{-- Kolom Kiri --}}
                <div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Jenis Artikel <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="jenis_artikel" value="{{ old('jenis_artikel', $artikel->jenis_artikel) }}" placeholder="Jenis artikel.."
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('jenis_artikel') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('jenis_artikel')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Tempat Terbit <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="tempat_terbit" value="{{ old('tempat_terbit', $artikel->tempat_terbit) }}" placeholder="ex : Jakarta"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('tempat_terbit') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('tempat_terbit')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Tahun <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="tahun" value="{{ old('tahun', $artikel->tahun) }}" placeholder="ex : 2010"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('tahun') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('tahun')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Bahasa <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="bahasa" value="{{ old('bahasa', $artikel->bahasa) }}" placeholder="ex : Indonesia"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('bahasa') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('bahasa')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Sumber <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="sumber" value="{{ old('sumber', $artikel->sumber) }}" placeholder="ex : Majalah X Media"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('sumber') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('sumber')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Bidang Hukum <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="bidang_hukum" value="{{ old('bidang_hukum', $artikel->bidang_hukum) }}" placeholder="ex : Hukum Umum"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('bidang_hukum') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('bidang_hukum')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Lokasi <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $artikel->lokasi) }}" placeholder="ex : Biro Hukum Kementerian Ketenagakerjaan"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('lokasi') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('lokasi')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            TEU Orang/Badan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="teu" value="{{ old('teu', $artikel->teu) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('teu') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('teu')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Subjek <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="subjek" value="{{ old('subjek', $artikel->subjek) }}" placeholder="ex : PERLINDUNGAN KERJA"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('subjek') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('subjek')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <button type="submit" style="background: #10b981; color: white; border: none; border-radius: 12px; padding: 12px 30px; font-weight: 600; cursor: pointer;">
                    Update & Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });
</script>
@endsection