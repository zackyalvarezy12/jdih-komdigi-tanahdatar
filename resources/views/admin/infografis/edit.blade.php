@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <a href="{{ route('infografis.index') }}"
               style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; width: fit-content;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
            </a>
            <h2 style="font-weight: 700; color: #1e293b; margin-top: 15px;">Ubah Infografis</h2>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);">

            {{-- ✅ Action form pakai $encryptedId, bukan $item->id --}}
            <form id="mainForm"
                  action="{{ route('infografis.update', $encryptedId) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px;">
                        Judul Infografis <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="judul" id="judul"
                           value="{{ old('judul', $item->judul) }}"
                           placeholder="Masukkan judul infografis..."
                           style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e2e8f0; outline: none; font-size: 14px; box-sizing: border-box; transition: 0.2s;"
                           onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)'"
                           onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                    <small id="err_judul" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Judul wajib diisi.
                    </small>
                    {{-- Info slug saat ini --}}
                    @if($item->slug)
                    <small style="color: #94a3b8; display: block; margin-top: 5px; font-size: 11px;">
                        <i class="fa-solid fa-link"></i> Slug saat ini: <strong>{{ $item->slug }}</strong>
                        &nbsp;(akan otomatis berubah jika judul diedit)
                    </small>
                    @endif
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">

                    {{-- Gambar saat ini --}}
                    <div>
                        <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 12px;">Gambar Saat Ini</label>
                        <div style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; background: #f1f5f9; height: 260px;">
                            <img id="image-preview"
                                 src="{{ asset('storage/'.$item->file_infografis) }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>

                    {{-- Upload gambar baru --}}
                    <div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 12px;">
                                Pilih Gambar Baru
                                <span style="color:#94a3b8; font-weight: 400; font-size: 13px;">(opsional)</span>
                            </label>
                            <div style="border: 2px dashed #cbd5e1; border-radius: 16px; padding: 20px; text-align: center; position: relative; transition: 0.3s;" id="drop-area">
                                <input type="file" name="file_infografis" id="file_infografis" accept="image/*"
                                       style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;">
                                <i class="fa-solid fa-camera-rotate" style="font-size: 24px; color: #94a3b8; margin-bottom: 10px; display: block;"></i>
                                <p style="color: #64748b; font-size: 13px; margin: 0; font-weight: 600;">Klik untuk ganti gambar</p>
                                <small style="color: #94a3b8;">Format: JPG, PNG (Maks. 5MB)</small>
                            </div>
                            <small id="err_file_infografis" style="display:none; color:#ef4444; font-size:12px; margin-top:8px;">
                                <i class="fa-solid fa-circle-exclamation"></i> <span id="err_msg"></span>
                            </small>
                        </div>

                        <div style="background: #fff9db; padding: 14px; border-radius: 12px; border: 1px solid #ffec99; margin-bottom: 24px;">
                            <p style="color: #92400e; font-size: 13px; margin: 0; line-height: 1.5;">
                                <i class="fa-solid fa-circle-info"></i>
                                Kosongkan jika tidak ingin mengubah gambar yang sudah ada.
                            </p>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('infografis.index') }}"
                               style="flex: 1; background: #f1f5f9; color: #475569; padding: 14px; border-radius: 12px; font-weight: 700; font-size: 14px; text-decoration: none; text-align: center; transition: 0.2s;">
                                Batal
                            </a>
                            <button type="submit"
                                    style="flex: 2; background: #10b981; color: white; padding: 14px; border-radius: 12px; border: none; font-weight: 700; font-size: 14px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(16,185,129,0.2);">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('file_infografis');
    const dropArea  = document.getElementById('drop-area');
    const imgPreview = document.getElementById('image-preview');
    const errFile   = document.getElementById('err_file_infografis');
    const errMsg    = document.getElementById('err_msg');
    const errJudul  = document.getElementById('err_judul');

    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            if (!allowedTypes.includes(file.type)) {
                errMsg.textContent = 'Format file harus JPG, JPEG, atau PNG.';
                errFile.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                return;
            }
            if (file.size / 1024 / 1024 > 5) {
                errMsg.textContent = 'Ukuran file tidak boleh melebihi 5MB.';
                errFile.style.display = 'block';
                dropArea.style.borderColor = '#ef4444';
                dropArea.style.background  = '#fff5f5';
                return;
            }
            errFile.style.display      = 'none';
            dropArea.style.borderColor = '#10b981';
            dropArea.style.background  = '#f0fdf4';

            const reader = new FileReader();
            reader.onload = function(e) { imgPreview.src = e.target.result; };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('mainForm').addEventListener('submit', function(e) {
        const judul = document.getElementById('judul');
        if (!judul.value.trim()) {
            errJudul.style.display = 'block';
            judul.style.borderColor = '#ef4444';
            e.preventDefault();
        } else {
            errJudul.style.display = 'none';
        }
    });
</script>
@endsection