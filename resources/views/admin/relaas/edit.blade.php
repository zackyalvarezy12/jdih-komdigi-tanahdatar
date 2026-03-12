@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; text-transform: lowercase;">ubah relaas pengadilan</h2>
            <p style="color: #64748b; margin-top: 5px;">Perbarui informasi lengkap relaas dan meta data terkait.</p>
        </div>
        <a href="{{ route('relaas.index') }}" class="btn" style="background: #f1f5f9; color: #64748b; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
        </a>
    </div>

    {{-- Form action menggunakan encryptedId (ID tidak terlihat di URL) --}}
    <form action="{{ route('relaas.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; margin-bottom: 30px;">

            {{-- Nomor --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Nomor <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" name="nomor" value="{{ old('nomor', $relaas->nomor) }}"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('nomor') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('nomor')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Tanggal <span style="color: #ef4444;">*</span>
                </label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $relaas->tanggal) }}"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('tanggal') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">
                @error('tanggal')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Pengumuman --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    Pengumuman <span style="color: #ef4444;">*</span>
                </label>
                <textarea name="pengumuman" rows="5"
                    style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 2px solid {{ $errors->has('pengumuman') ? '#ef4444' : '#e2e8f0' }}; outline: none; font-size: 14px; box-sizing: border-box;">{{ old('pengumuman', $relaas->pengumuman) }}</textarea>
                @error('pengumuman')
                    <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                        <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                        <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- File PDF --}}
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 10px; font-size: 14px;">
                    File PDF :
                    <span style="font-weight: 400; color: #94a3b8; font-size: 12px;">(kosongkan jika tidak ingin mengubah)</span>
                </label>
                @if($relaas->file_pdf)
                    <p style="font-size: 12px; color: #64748b; margin-bottom: 8px;">File saat ini: <span style="color: #3b82f6;">{{ $relaas->file_pdf }}</span></p>
                @endif
                <input type="file" name="file_pdf" style="font-size: 14px; color: #64748b;">
                @error('file_pdf')
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
                            Jenis Putusan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="jenis_putusan" value="{{ old('jenis_putusan', $relaas->jenis_putusan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('jenis_putusan') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('jenis_putusan')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Jenis Peradilan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="jenis_peradilan" value="{{ old('jenis_peradilan', $relaas->jenis_peradilan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('jenis_peradilan') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('jenis_peradilan')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Singkatan Jenis Peradilan
                        </label>
                        <input type="text" name="singkatan_jenis_peradilan" value="{{ old('singkatan_jenis_peradilan', $relaas->singkatan_jenis_peradilan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; box-sizing: border-box;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Status Putusan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="status_putusan" value="{{ old('status_putusan', $relaas->status_putusan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('status_putusan') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('status_putusan')
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
                        <input type="text" name="bahasa" value="{{ old('bahasa', $relaas->bahasa) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('bahasa') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('bahasa')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Sumber
                        </label>
                        <input type="text" name="sumber" value="{{ old('sumber', $relaas->sumber) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; box-sizing: border-box;">
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Bidang Hukum / Jenis Perkara <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="bidang_hukum" value="{{ old('bidang_hukum', $relaas->bidang_hukum) }}"
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
                            Tempat Peradilan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="tempat_peradilan" value="{{ old('tempat_peradilan', $relaas->tempat_peradilan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('tempat_peradilan') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('tempat_peradilan')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Amar
                        </label>
                        <input type="text" name="amar" value="{{ old('amar', $relaas->amar) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; box-sizing: border-box;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Tanggal Dibacakan <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="date" name="tanggal_dibacakan" value="{{ old('tanggal_dibacakan', $relaas->tanggal_dibacakan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('tanggal_dibacakan') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('tanggal_dibacakan')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            TEU Orang/Badan
                        </label>
                        <input type="text" name="teu_badan" value="{{ old('teu_badan', $relaas->teu_badan) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; box-sizing: border-box;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Subjek <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="subjek" value="{{ old('subjek', $relaas->subjek) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid {{ $errors->has('subjek') ? '#ef4444' : '#e2e8f0' }}; font-size: 13px; box-sizing: border-box;">
                        @error('subjek')
                            <div style="display:flex; align-items:center; gap:6px; margin-top:8px; background:#fef2f2; border-left:4px solid #ef4444; border-radius:6px; padding:8px 12px;">
                                <i class="fa-solid fa-circle-exclamation" style="color:#ef4444;"></i>
                                <span style="color:#dc2626; font-size:13px; font-weight:600;">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px; font-size: 13px;">
                            Lampiran
                        </label>
                        <input type="text" name="lampiran" value="{{ old('lampiran', $relaas->lampiran) }}"
                            style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; box-sizing: border-box;">
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <button type="submit" style="background: #3b82f6; color: white; border: none; border-radius: 12px; padding: 12px 45px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
@endsection