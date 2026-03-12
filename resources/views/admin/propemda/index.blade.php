@extends('layouts.admin')

@section('content')
@php use Illuminate\Support\Facades\Crypt; @endphp

@if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #bbf7d0; display:flex; align-items:center; gap:10px; font-size:14px; font-weight:600;">
        <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i> {{ session('success') }}
    </div>
@endif

<div class="container-fluid" style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Propemda</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola data propemda secara sistematis.</p>
        </div>
        <a href="{{ route('propemda.create') }}" class="btn" style="background: #10b981; color: white; border-radius: 12px; padding: 12px 24px; font-weight: 600; text-decoration: none;">
            <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Propemda
        </a>
    </div>

    <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 2px solid #f8fafc;">
                    <th style="text-align: left; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">No.</th>
                    <th style="text-align: left; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase; width: 35%;">Judul</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Nomor/Tahun</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Status</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">File</th>
                    <th style="text-align: center; padding: 15px 20px; color: #94a3b8; font-size: 12px; text-transform: uppercase;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($propemdas as $index => $propemda)
                @php $encId = Crypt::encrypt($propemda->id); @endphp
                <tr style="border-bottom: 1px solid #f8fafc; transition: 0.3s;" onmouseover="this.style.backgroundColor='#fcfdfe'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 20px; color: #64748b; font-size: 14px;">{{ $index + 1 }}</td>
                    <td style="padding: 20px;">
                        <div style="font-weight: 600; color: #334155; line-height: 1.5; font-size: 14px;">{{ $propemda->judul }}</div>
                        @if($propemda->slug)
                        <div style="margin-top:4px; font-size:11px; color:#94a3b8;">
                            <i class="fa-solid fa-link" style="font-size:10px;"></i> /propemda/{{ $propemda->slug }}
                        </div>
                        @endif
                    </td>
                    <td style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">
                        {{ $propemda->nomor }} <span style="color: #cbd5e1;">/</span> {{ $propemda->tahun }}
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <span style="background: {{ $propemda->status == 'BERLAKU' ? '#ecfdf5' : '#fef2f2' }}; color: {{ $propemda->status == 'BERLAKU' ? '#10b981' : '#ef4444' }}; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; display: inline-block;">
                            {{ $propemda->status }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        @if($propemda->file_pdf)
                            <a href="{{ asset('storage/' . $propemda->file_pdf) }}" target="_blank" style="color: #6366f1; font-size: 20px;">
                                <i class="fa-solid fa-file-pdf"></i>
                            </a>
                        @else
                            <i class="fa-solid fa-file-circle-xmark" style="color: #cbd5e1; font-size: 20px;"></i>
                        @endif
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="{{ route('propemda.edit', $encId) }}"
                               style="background: #f1f5f9; color: #64748b; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;"
                               onmouseover="this.style.background='#e2e8f0'; this.style.color='#10b981'"
                               onmouseout="this.style.background='#f1f5f9'; this.style.color='#64748b'">
                                <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i>
                            </a>
                            <form action="{{ route('propemda.destroy', $encId) }}" method="POST" onsubmit="return confirm('Hapus data \'{{ addslashes($propemda->judul) }}\'?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #fff1f2; color: #fb7185; width: 35px; height: 35px; border-radius: 8px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                        onmouseover="this.style.background='#ffe4e6'"
                                        onmouseout="this.style.background='#fff1f2'">
                                    <i class="fa-solid fa-trash" style="font-size: 14px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 50px; text-align: center; color: #94a3b8;">
                        <i class="fa-solid fa-scroll" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        Belum ada data. <a href="{{ route('propemda.create') }}" style="color: #10b981; font-weight: 700;">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection