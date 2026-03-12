@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; border: 1px solid #bbf7d0; margin: 30px 30px 0 30px;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
@endif

<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Data - Analisis Evaluasi</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola daftar dokumen analisis dan evaluasi hukum.</p>
        </div>
        <a href="{{ route('analisis-evaluasi.create') }}" class="btn" style="background: #10b981; color: white; border-radius: 10px; padding: 10px 20px; font-weight: 600; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Analisis Evaluasi
        </a>
    </div>

    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
        <table class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
            <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                <tr>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600; width: 50px;">No.</th>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600;">Type Dokumen</th>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600;">Judul</th>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600;">T.E.U Pengarang/Badan</th>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600;">Tahun</th>
                    <th style="padding: 15px; text-align: left; color: #475569; font-size: 13px; font-weight: 600;">Views</th>
                    <th style="padding: 15px; text-align: center; color: #475569; font-size: 13px; font-weight: 600; width: 120px;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px; font-size: 14px; color: #64748b;">{{ $index + 1 }}.</td>
                    <td style="padding: 15px; font-size: 14px; color: #1e293b;">{{ $item->type_dokumen }}</td>
                    <td style="padding: 15px; font-size: 14px; color: #1e293b; font-weight: 500;">
                        {{ $item->judul }}
                        <div style="font-size: 11px; color: #94a3b8; margin-top: 3px;">
                            <i class="fa-solid fa-link" style="margin-right: 4px;"></i>{{ $item->slug ?? '-' }}
                        </div>
                    </td>
                    <td style="padding: 15px; font-size: 14px; color: #64748b;">{{ $item->teu_pengarang }}</td>
                    <td style="padding: 15px; font-size: 14px; color: #64748b;">{{ $item->tahun }}</td>
                    <td style="padding: 15px; font-size: 14px; color: #64748b;">{{ $item->views }}</td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            {{-- Edit menggunakan encrypted_id --}}
                            <a href="{{ route('analisis-evaluasi.edit', $item->encrypted_id) }}" style="color: #3b82f6; background: #eff6ff; padding: 8px; border-radius: 8px; transition: 0.3s; text-decoration: none;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{-- Hapus menggunakan encrypted_id --}}
                            <form action="{{ route('analisis-evaluasi.destroy', $item->encrypted_id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="color: #ef4444; background: #fef2f2; padding: 8px; border: none; border-radius: 8px; cursor: pointer;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 30px; text-align: center; color: #94a3b8;">Belum ada data analisis evaluasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection