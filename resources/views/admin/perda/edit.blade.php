@extends('layouts.admin')

@section('content')
<style>
    .is-invalid { border: 1.5px solid #ef4444 !important; background: #fff1f2 !important; }
    .error-feedback {
        display: flex; align-items: center; gap: 7px;
        margin-top: 7px; background: #fef2f2;
        border-left: 3px solid #ef4444; border-radius: 6px;
        padding: 7px 11px;
    }
    .error-feedback i { color: #ef4444; font-size: 12px; flex-shrink: 0; }
    .error-feedback span { color: #dc2626; font-size: 12px; font-weight: 600; }
    .req { color: #ef4444; font-size: 15px; line-height: 1; }
</style>

<div class="container-fluid" style="padding: 30px;">
    {{--
        Form action menggunakan $encryptedId dari controller.
        ID asli tidak pernah muncul di URL maupun HTML.
    --}}
    <form action="{{ route('perda.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Edit Peraturan Daerah</h2>
                <p style="color: #64748b; margin: 0;">Memperbarui data: <strong>{{ $perda->nomor }}</strong></p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('perda.index') }}" style="background: #f1f5f9; color: #475569; border-radius: 12px; padding: 12px 25px; text-decoration: none; font-weight: 600; display: flex; align-items: center;">Batal</a>
                <button type="submit" class="btn" style="background: #3b82f6; color: white; border-radius: 12px; padding: 12px 30px; border: none; font-weight: 600; cursor: pointer;">
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">

            {{-- KOLOM KIRI --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                    {{-- Nomor --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Nomor Perda <span class="req">*</span></label>
                        <input type="text" name="nomor" value="{{ old('nomor', $perda->nomor) }}"
                            class="{{ $errors->has('nomor') ? 'is-invalid' : '' }}"
                            style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; box-sizing:border-box;">
                        @error('nomor')
                            <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    {{-- Judul --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Judul Perda <span class="req">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $perda->judul) }}"
                            class="{{ $errors->has('judul') ? 'is-invalid' : '' }}"
                            style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; box-sizing:border-box;">
                        @error('judul')
                            <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    {{-- File PDF --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Update File PDF <span style="font-weight:400; color:#94a3b8; font-size:12px;">(kosongkan jika tidak ingin mengganti)</span></label>
                        @if($perda->file_pdf)
                            <div style="margin-bottom: 10px; padding: 10px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 13px; display:flex; align-items:center; gap:8px;">
                                <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i>
                                <span style="color:#166534; font-weight:600;">File saat ini: {{ basename($perda->file_pdf) }}</span>
                            </div>
                        @endif
                        <div style="padding: 15px; border: 2px dashed {{ $errors->has('file') ? '#ef4444' : '#cbd5e1' }}; border-radius: 10px; background: {{ $errors->has('file') ? '#fff1f2' : '#f8fafc' }};">
                            <input type="file" name="file" style="width: 100%;" accept=".pdf">
                        </div>
                        @error('file')
                            <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Keterangan</label>
                        <textarea name="keterangan" id="editor">{{ old('keterangan', $perda->keterangan) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (Meta) --}}
            <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; height: fit-content; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tahun <span class="req">*</span></label>
                    <input type="number" name="tahun" value="{{ old('tahun', $perda->tahun) }}"
                        class="{{ $errors->has('tahun') ? 'is-invalid' : '' }}"
                        style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;">
                    @error('tahun')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                    @enderror
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Status <span class="req">*</span></label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;"
                        class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="BERLAKU" {{ old('status', $perda->status) == 'BERLAKU' ? 'selected' : '' }}>BERLAKU</option>
                        <option value="TIDAK BERLAKU" {{ old('status', $perda->status) == 'TIDAK BERLAKU' ? 'selected' : '' }}>TIDAK BERLAKU</option>
                    </select>
                    @error('status')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                    @enderror
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tempat Penetapan</label>
                    <input type="text" name="tempat_penetapan" value="{{ old('tempat_penetapan', $perda->tempat_penetapan) }}" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tanggal Penetapan <span class="req">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $perda->tanggal) }}"
                        class="{{ $errors->has('tanggal') ? 'is-invalid' : '' }}"
                        style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;">
                    @error('tanggal')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                    @enderror
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Sumber</label>
                    <input type="text" name="sumber" value="{{ old('sumber', $perda->sumber) }}" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;">
                </div>

                <div style="margin-bottom: 5px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" value="{{ old('bidang_hukum', $perda->bidang_hukum) }}" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing:border-box;">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', { height: 250 });
</script>
@endsection