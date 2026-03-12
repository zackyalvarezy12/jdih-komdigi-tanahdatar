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
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Data - Risalah Hukum</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola daftar dokumen risalah hukum.</p>
        </div>
        <a href="{{ route('risalah-hukum.create') }}" class="btn" style="background: #10b981; color: white; border-radius: 10px; padding: 10px 20px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-plus"></i> Tambah Risalah Hukum
        </a>
    </div>

    <div style="background: white; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8fafc;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">No.</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Type Dokumen</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Judul</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">T.E.U Pengarang/Badan</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Tahun</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Views</th>
                    <th style="padding: 15px; text-align: center; font-size: 13px;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px; font-size: 14px;">{{ $index + 1 }}.</td>
                    <td style="padding: 15px; font-size: 14px;">{{ $item->type_dokumen }}</td>
                    <td style="padding: 15px; font-size: 14px; font-weight: 500;">
                        {{ $item->judul }}
                        <div style="font-size: 11px; color: #94a3b8; margin-top: 3px;">
                            <i class="fa-solid fa-link" style="margin-right: 4px;"></i>{{ $item->slug ?? '-' }}
                        </div>
                    </td>
                    <td style="padding: 15px; font-size: 14px;">{{ $item->teu_pengarang }}</td>
                    <td style="padding: 15px; font-size: 14px;">{{ $item->tahun }}</td>
                    <td style="padding: 15px; font-size: 14px;">{{ $item->views }}</td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            {{-- Edit menggunakan encrypted_id --}}
                            <a href="{{ route('risalah-hukum.edit', $item->encrypted_id) }}"
                               style="color: #3b82f6; background: #eff6ff; padding: 8px; border-radius: 8px; text-decoration: none;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{-- Hapus menggunakan encrypted_id --}}
                            <form action="{{ route('risalah-hukum.destroy', $item->encrypted_id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data?')"
                                    style="color: #ef4444; background: #fef2f2; border: none; padding: 8px; border-radius: 8px; cursor: pointer;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="padding: 20px; text-align: center; color: #94a3b8;">Data kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection