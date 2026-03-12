@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <a href="{{ route('kontak.index') }}" style="color: #64748b; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <h2 style="font-weight: 700; color: #1e293b; margin-top: 15px;">Edit Data Kontak</h2>
        </div>

        <div style="background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px rgba(0,0,0,0.05);">
            <form id="mainForm" action="{{ route('kontak.update', $item->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                
                {{-- Nama --}}
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">
                        Nama Pengirim <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $item->nama) }}"
                           style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #cbd5e1; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_nama" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Nama Pengirim wajib diisi.
                    </small>
                </div>

                {{-- Email --}}
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">
                        Email <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $item->email) }}"
                           style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #cbd5e1; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateEmail(this)">
                    <small id="err_email" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> <span id="err_email_msg">Email wajib diisi.</span>
                    </small>
                </div>

                {{-- Subjek --}}
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">
                        Subjek <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="subjek" id="subjek" value="{{ old('subjek', $item->subjek) }}"
                           style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #cbd5e1; outline: none; transition: 0.3s; box-sizing: border-box;"
                           onfocus="clearError(this)" onblur="validateField(this)">
                    <small id="err_subjek" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Subjek wajib diisi.
                    </small>
                </div>

                {{-- Pesan --}}
                <div style="margin-bottom: 35px;">
                    <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">
                        Isi Pesan <span style="color:#ef4444;">*</span>
                    </label>
                    <textarea name="pesan" id="pesan" rows="6"
                              style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #cbd5e1; outline: none; resize: vertical; transition: 0.3s; box-sizing: border-box;"
                              onfocus="clearError(this)" onblur="validateField(this)">{{ old('pesan', $item->pesan) }}</textarea>
                    <small id="err_pesan" style="display:none; color:#ef4444; font-size:12px; margin-top:6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> Isi Pesan wajib diisi.
                    </small>
                </div>

                <button type="submit" style="width: 100%; background: #f59e0b; color: white; padding: 16px; border-radius: 14px; border: none; font-weight: 700; font-size: 16px; cursor: pointer; transition: 0.3s; box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.2);">
                    Update Data Kontak
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function clearError(el) {
        el.style.borderColor = '#10b981';
        el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        const errEl = document.getElementById('err_' + el.id);
        if (errEl) errEl.style.display = 'none';
    }

    function validateField(el) {
        if (!el.value.trim()) {
            el.style.borderColor = '#ef4444';
            el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'block';
            return false;
        } else {
            el.style.borderColor = '#10b981';
            el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
            const errEl = document.getElementById('err_' + el.id);
            if (errEl) errEl.style.display = 'none';
            return true;
        }
    }

    function validateEmail(el) {
        const errEl = document.getElementById('err_email');
        const errMsg = document.getElementById('err_email_msg');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!el.value.trim()) {
            el.style.borderColor = '#ef4444';
            el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            errMsg.textContent = 'Email wajib diisi.';
            errEl.style.display = 'block';
            return false;
        } else if (!emailRegex.test(el.value.trim())) {
            el.style.borderColor = '#ef4444';
            el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            errMsg.textContent = 'Format email tidak valid.';
            errEl.style.display = 'block';
            return false;
        } else {
            el.style.borderColor = '#10b981';
            el.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
            errEl.style.display = 'none';
            return true;
        }
    }

    document.getElementById('mainForm').addEventListener('submit', function(e) {
        let valid = true;

        ['nama', 'subjek', 'pesan'].forEach(function(id) {
            const el = document.getElementById(id);
            if (!validateField(el)) valid = false;
        });

        if (!validateEmail(document.getElementById('email'))) valid = false;

        if (!valid) {
            e.preventDefault();
            const firstErr = document.querySelector('small[style*="block"]');
            if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script>
@endsection