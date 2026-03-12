@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Rancangan PUU</h2>
            <p style="color: #64748b;">Kelola daftar rancangan Peraturan Perundang-undangan.</p>
        </div>
        <a href="{{ route('rancangan-puu.create') }}"
           style="background: #10b981; color: white; border-radius: 10px; padding: 12px 20px; font-weight: 600; text-decoration: none; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Rancangan
        </a>
    </div>

    @if(session('success'))
    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
    @endif

    <div style="background: white; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                <tr>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">No.</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Tipe Dokumen</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Judul Rancangan</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Tahun</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Dilihat</th>
                    <th style="padding: 20px; text-align: center; color: #475569; font-size: 13px; font-weight: 700; text-transform: uppercase;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;"
                    onmouseover="this.style.backgroundColor='#fcfcfc'"
                    onmouseout="this.style.backgroundColor='transparent'">

                    <td style="padding: 20px; font-size: 14px; color: #64748b;">{{ $index + 1 }}.</td>

                    <td style="padding: 20px; font-size: 14px;">
                        <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; color: #475569;">
                            {{ $item->type_dokumen }}
                        </span>
                    </td>

                    <td style="padding: 20px; font-size: 14px; font-weight: 600; color: #1e293b; line-height: 1.5;">
                        {{ $item->judul }}
                        {{-- Tampilkan slug sebagai info kecil --}}
                        @if($item->slug)
                        <br><small style="font-weight: 400; color: #94a3b8; font-size: 11px;">
                            <i class="fa-solid fa-link" style="margin-right: 3px;"></i>{{ $item->slug }}
                        </small>
                        @endif
                    </td>

                    <td style="padding: 20px; font-size: 14px; color: #64748b;">{{ $item->tahun }}</td>

                    <td style="padding: 20px; font-size: 14px; color: #64748b;">
                        <i class="fa-regular fa-eye" style="margin-right: 5px; font-size: 12px;"></i>
                        {{ $item->views ?? 0 }}
                    </td>

                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">

                            {{-- ✅ Tombol Edit: ID terenkripsi di URL --}}
                            <a href="{{ route('rancangan-puu.edit', Crypt::encryptString($item->id)) }}"
                               style="color: #3b82f6; background: #eff6ff; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.3s;"
                               title="Edit Data">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            {{-- ✅ Tombol Delete: ID terenkripsi di URL --}}
                            <form action="{{ route('rancangan-puu.destroy', Crypt::encryptString($item->id)) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Hapus rancangan ini?')"
                                        style="color: #ef4444; background: #fef2f2; width: 35px; height: 35px; border-radius: 8px; border: none; cursor: pointer; transition: 0.3s;"
                                        title="Hapus Data">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 50px; text-align: center;">
                        <img src="https://illustrations.popsy.co/gray/empty-folder.svg" alt="empty"
                             style="width: 120px; margin-bottom: 15px; opacity: 0.5;">
                        <p style="color: #94a3b8; font-weight: 500;">Belum ada data rancangan PUU yang tersedia.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection