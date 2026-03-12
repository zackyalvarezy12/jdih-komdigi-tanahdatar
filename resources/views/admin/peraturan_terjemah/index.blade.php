@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Peraturan Terjemah</h2>
            <p style="color: #64748b;">Daftar dokumen peraturan yang telah diterjemahkan.</p>
        </div>
        <a href="{{ route('peraturan-terjemah.create') }}" style="background: #10b981; color: white; border-radius: 10px; padding: 12px 20px; font-weight: 600; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Terjemahan
        </a>
    </div>

    <div style="background: white; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8fafc; border-bottom: 2px solid #f1f5f9;">
                <tr>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px;">No.</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px;">Tipe Dokumen</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px;">Judul</th>
                    <th style="padding: 20px; text-align: left; color: #475569; font-size: 13px;">Tahun</th>
                    <th style="padding: 20px; text-align: center; color: #475569; font-size: 13px;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 20px; font-size: 14px; color: #64748b;">{{ $index + 1 }}.</td>
                    <td style="padding: 20px; font-size: 14px;"><span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px;">{{ $item->type_dokumen }}</span></td>
                    <td style="padding: 20px; font-size: 14px; font-weight: 600;">{{ $item->judul }}</td>
                    <td style="padding: 20px; font-size: 14px;">{{ $item->tahun }}</td>
                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 8px;">
                            <a href="{{ route('peraturan-terjemah.edit', $item->id) }}" style="color: #3b82f6; background: #eff6ff; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('peraturan-terjemah.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data ini?')" style="color: #ef4444; background: #fef2f2; width: 35px; height: 35px; border-radius: 8px; border: none; cursor: pointer;">
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
@endsection