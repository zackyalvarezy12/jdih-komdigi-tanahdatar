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
    {{-- Form action menggunakan $encryptedId — ID asli tidak terlihat di URL --}}
    <form action="{{ route('perbupati.update', $encryptedId) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Edit Peraturan Bupati</h2>
                <p style="color: #64748b; margin: 0;">Memperbarui data: <strong>{{ $item->nomor }}</strong></p>
            </div>
            <div style="display:flex; gap:10px;">
                <a href="{{ route('perbupati.index') }}" style="background:#f1f5f9; color:#475569; border-radius:12px; padding:12px 25px; text-decoration:none; font-weight:600; display:flex; align-items:center;">Batal</a>
                <button type="submit" class="btn" style="background: #3b82f6; color: white; border-radius: 12px; padding: 12px 30px; border: none; font-weight: 600; cursor: pointer;">
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">

            {{-- KOLOM KIRI --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                    <div style="margin-bottom: 20px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Nomor <span class="req">*</span></label>
                        <input type="text" name="nomor" value="{{ old('nomor', $item->nomor) }}"
                            class="{{ $errors->has('nomor') ? 'is-err' : '' }}"
                            style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;">
                        @error('nomor') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Judul <span class="req">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul', $item->judul) }}"
                            class="{{ $errors->has('judul') ? 'is-err' : '' }}"
                            style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box;">
                        @error('judul') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">
                            File PDF <span style="font-weight:400; color:#94a3b8; font-size:12px;">(kosongkan jika tidak ingin mengganti)</span>
                        </label>
                        @if($item->file_pdf)
                            <div style="margin-bottom:10px; padding:10px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; font-size:13px; display:flex; align-items:center; gap:8px;">
                                <i class="fa-solid fa-file-pdf" style="color:#ef4444;"></i>
                                <span style="color:#166534; font-weight:600;">{{ basename($item->file_pdf) }}</span>
                            </div>
                        @endif
                        <div style="padding:15px; border:2px dashed {{ $errors->has('file_pdf') ? '#ef4444' : '#cbd5e1' }}; border-radius:10px; background:{{ $errors->has('file_pdf') ? '#fff1f2' : '#f8fafc' }};">
                            <input type="file" name="file_pdf" style="width:100%;" accept=".pdf">
                        </div>
                        @error('file_pdf') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Keterangan</label>
                        <textarea name="keterangan" id="editor">{{ old('keterangan', $item->keterangan) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div style="background: white; border-radius: 20px; padding: 25px; border: 1px solid #f1f5f9; height: fit-content; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Tahun <span class="req">*</span></label>
                    <input type="number" name="tahun" value="{{ old('tahun', $item->tahun) }}"
                        class="{{ $errors->has('tahun') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('tahun') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Status <span class="req">*</span></label>
                    <select name="status" class="{{ $errors->has('status') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                        <option value="BERLAKU"       {{ old('status', $item->status) == 'BERLAKU'       ? 'selected' : '' }}>BERLAKU</option>
                        <option value="TIDAK BERLAKU" {{ old('status', $item->status) == 'TIDAK BERLAKU' ? 'selected' : '' }}>TIDAK BERLAKU</option>
                    </select>
                    @error('status') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Tempat Penetapan <span class="req">*</span></label>
                    <input type="text" name="tempat_penetapan" value="{{ old('tempat_penetapan', $item->tempat_penetapan) }}"
                        class="{{ $errors->has('tempat_penetapan') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('tempat_penetapan') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Tanggal Penetapan <span class="req">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $item->tanggal ? $item->tanggal->format('Y-m-d') : '') }}"
                        class="{{ $errors->has('tanggal') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('tanggal') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Sumber <span class="req">*</span></label>
                    <input type="text" name="sumber" value="{{ old('sumber', $item->sumber) }}"
                        class="{{ $errors->has('sumber') ? 'is-err' : '' }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                    @error('sumber') <div class="err-box"><i class="fa-solid fa-circle-exclamation"></i><span>{{ $message }}</span></div> @enderror
                </div>

                <div style="margin-bottom:5px;">
                    <label style="display:block; margin-bottom:8px; font-weight:600;">Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" value="{{ old('bidang_hukum', $item->bidang_hukum) }}"
                        style="width:100%; padding:10px; border:1px solid #e2e8f0; border-radius:8px; box-sizing:border-box;">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('editor');</script>
@endsection