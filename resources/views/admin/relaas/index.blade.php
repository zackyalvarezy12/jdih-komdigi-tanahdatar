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
            <h2 style="font-weight: 700; color: #1e293b; margin: 0; text-transform: lowercase;">data - relaas pengadilan</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola daftar pengumuman relaas pengadilan di sini.</p>
        </div>
        <a href="{{ route('relaas.create') }}" class="btn" style="background: #10b981; color: white; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
            <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Relaas
        </a>
    </div>

    <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr style="color: #64748b; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
                        <th style="border: none; padding: 15px;">No.</th>
                        <th style="border: none; padding: 15px;">Nomor/Tanggal</th>
                        <th style="border: none; padding: 15px;">Pengumuman</th>
                        <th style="border: none; padding: 15px; text-align: center;">File</th>
                        <th style="border: none; padding: 15px; text-align: center;">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($relaas as $key => $item)
                    <tr style="background: #fcfcfd; border-radius: 12px;">
                        <td style="padding: 20px; border: none; border-top-left-radius: 12px; border-bottom-left-radius: 12px; font-weight: 600; color: #64748b;">{{ $key + 1 }}</td>
                        <td style="padding: 20px; border: none;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $item->nomor }}</div>
                            <div style="color: #94a3b8; font-size: 12px; margin-top: 4px;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                        </td>
                        <td style="padding: 20px; border: none; color: #475569; font-size: 14px; max-width: 400px; line-height: 1.5;">
                            {{ Str::limit($item->pengumuman, 150) }}
                        </td>
                        <td style="padding: 20px; border: none; text-align: center;">
                            @if($item->file_pdf)
                                <a href="{{ asset('storage/'.$item->file_pdf) }}" target="_blank" style="display: inline-flex; align-items: center; background: #eff6ff; color: #3b82f6; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none;">
                                    <i class="fa-solid fa-file-pdf" style="margin-right: 6px;"></i> File
                                </a>
                            @else
                                <span style="color: #cbd5e1; font-size: 13px;">Tidak ada file</span>
                            @endif
                        </td>
                        <td style="padding: 20px; border: none; border-top-right-radius: 12px; border-bottom-right-radius: 12px; text-align: center;">
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                {{-- Edit menggunakan encrypted_id --}}
                                <a href="{{ route('relaas.edit', $item->encrypted_id) }}" class="btn-action" style="color: #3b82f6; background: #eff6ff; padding: 10px; border-radius: 10px; text-decoration: none;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- Hapus menggunakan encrypted_id --}}
                                <form action="{{ route('relaas.destroy', $item->encrypted_id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" style="color: #ef4444; background: #fef2f2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection