@extends('layouts.admin')

@section('content')
<style>
    .err-box { display:flex; align-items:center; gap:7px; margin-top:7px; background:#fef2f2; border-left:3px solid #ef4444; border-radius:6px; padding:7px 11px; }
    .err-box i { color:#ef4444; font-size:12px; flex-shrink:0; }
    .err-box span { color:#dc2626; font-size:12px; font-weight:600; }
    .is-err { border: 1.5px solid #ef4444 !important; background: #fff1f2 !important; }
    .req { color:#ef4444; font-size:15px; line-height:1; }
</style>

<div class="container-fluid" style="padding: 30px;">
    <form action="{{ route('perbupati.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Tambah Peraturan Bupati</h2>
                <p style="color: #64748b; margin-top: 5px;">Input data hukum dengan teliti untuk arsip JDIH.</p>
            </div>
            <div style="display:flex; gap:10px;">
                <a href="{{ route('perbupati.index') }}" style="background:#f1f5f9; color:#475569; border-radius:12px; padding:12px 25px; text-decoration:none; font-weight:600; display:flex; align-items:center;">Batal</a>
                <button type="submit" class="btn" style="background: #10b981; color: white; border-radius: 12px; padding: 12px 30px; border: none; font-weight: 600; cursor: pointer;">
                    <i class="fa-solid fa-floppy-disk" style="margin-right:8px;"></i> Simpan
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px; align-items: start;">

            {{-- KOLOM KIRI --}}
            <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                <div style="margin-bottom: 20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Nomor <span class="req">*</span></label>
                    <input type="text" name="nomor" value="{{ old('nomor') }}"
                        class="{{ $errors->has('nomor') ? 'is-err' : '' }}"
                        style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;"
                        placeholder="Contoh: 01/2026">
                    @error('nomor') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Judul <span class="req">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="{{ $errors->has('judul') ? 'is-err' : '' }}"
                        style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;"
                        placeholder="Masukkan Judul Peraturan...">
                    @error('judul') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
                    <div>
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Tahun <span class="req">*</span></label>
                        <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}"
                            class="{{ $errors->has('tahun') ? 'is-err' : '' }}"
                            style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;">
                        @error('tahun') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                    </div>
                    <div>
                        <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Status <span class="req">*</span></label>
                        <select name="status" class="{{ $errors->has('status') ? 'is-err' : '' }}"
                            style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;">
                            <option value="">Pilih Status</option>
                            <option value="BERLAKU" {{ old('status') == 'BERLAKU' ? 'selected' : '' }}>BERLAKU</option>
                            <option value="TIDAK BERLAKU" {{ old('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>TIDAK BERLAKU</option>
                        </select>
                        @error('status') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">File PDF <span class="req">*</span></label>
                    <div style="padding:15px; border:2px dashed {{ $errors->has('file') ? '#ef4444' : '#cbd5e1' }}; border-radius:12px; background:{{ $errors->has('file') ? '#fff1f2' : '#f8fafc' }};">
                        <input type="file" name="file" style="width:100%;" accept=".pdf">
                    </div>
                    @error('file') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Keterangan</label>
                    <textarea name="keterangan" id="editor">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Tempat Penetapan <span class="req">*</span></label>
                    <input type="text" name="tempat_penetapan" value="{{ old('tempat_penetapan') }}"
                        class="{{ $errors->has('tempat_penetapan') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('tempat_penetapan') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Tanggal Penetapan <span class="req">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                        class="{{ $errors->has('tanggal') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('tanggal') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Sumber <span class="req">*</span></label>
                    <input type="text" name="sumber" value="{{ old('sumber') }}"
                        class="{{ $errors->has('sumber') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('sumber') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Subjek <span class="req">*</span></label>
                    <input type="text" name="subjek" value="{{ old('subjek') }}"
                        class="{{ $errors->has('subjek') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('subjek') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Bahasa <span class="req">*</span></label>
                    <input type="text" name="bahasa" value="{{ old('bahasa', 'Indonesia') }}"
                        class="{{ $errors->has('bahasa') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('bahasa') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Lokasi <span class="req">*</span></label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                        class="{{ $errors->has('lokasi') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('lokasi') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569;">Bidang Hukum <span class="req">*</span></label>
                    <input type="text" name="bidang_hukum" value="{{ old('bidang_hukum') }}"
                        class="{{ $errors->has('bidang_hukum') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('bidang_hukum') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-top:10px; padding:12px; background:#fffbeb; border:1px solid #fde68a; border-radius:10px; font-size:12px; color:#92400e; display:flex; gap:8px; align-items:flex-start;">
                    <i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b; margin-top:1px; flex-shrink:0;"></i>
                    <span>Kolom bertanda <strong style="color:#ef4444;">*</strong> wajib diisi.</span>
                </div>
            </div>

        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('editor', { height: 300, removeButtons: 'PasteFromWord' });</script>
@endsection