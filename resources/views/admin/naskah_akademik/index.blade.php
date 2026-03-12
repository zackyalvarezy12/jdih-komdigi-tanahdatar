@extends('layouts.admin')

@section('content')
<div style="padding: 40px; background-color: #f8fafc; min-height: 100vh;">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-weight: 700; color: #1e293b; margin: 0;">Data Naskah Akademik</h2>
            <p style="color: #64748b; margin-top: 5px;">Kelola daftar dokumen naskah akademik terbaru.</p>
        </div>
        <a href="{{ route('naskah-akademik.create') }}"
           style="background: #10b981; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); transition: 0.3s;">
            <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Naskah
        </a>
    </div>

    @if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
    @endif

    <div style="background: white; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">NO.</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">TIPE DOKUMEN</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">JUDUL</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">PENGARANG</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">TAHUN</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase;">DILIHAT</th>
                    <th style="padding: 20px; color: #64748b; font-weight: 700; font-size: 13px; text-transform: uppercase; text-align: center;">OPSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $key => $item)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.3s;"
                    onmouseover="this.style.background='#f8fafc'"
                    onmouseout="this.style.background='white'">

                    <td style="padding: 20px; color: #1e293b; font-weight: 500;">{{ $key + 1 }}</td>

                    <td style="padding: 20px;">
                        <span style="background: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">
                            {{ $item->type_dokumen }}
                        </span>
                    </td>

                    <td style="padding: 20px; color: #1e293b; font-weight: 500; max-width: 300px; line-height: 1.5;">
                        {{ $item->judul }}
                        {{-- Info slug --}}
                        @if($item->slug)
                        <br><small style="font-weight: 400; color: #94a3b8; font-size: 11px;">
                            <i class="fa-solid fa-link" style="margin-right: 3px;"></i>{{ $item->slug }}
                        </small>
                        @endif
                    </td>

                    <td style="padding: 20px; color: #64748b;">{{ $item->teu_pengarang }}</td>

                    <td style="padding: 20px; color: #64748b;">{{ $item->tahun }}</td>

                    <td style="padding: 20px; color: #64748b; font-size: 14px;">
                        <i class="fa-regular fa-eye" style="margin-right: 5px; font-size: 12px;"></i>
                        {{ $item->views ?? 0 }}
                    </td>

                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 10px;">

                            {{-- ✅ Tombol Edit: ID terenkripsi di URL --}}
                            <a href="{{ route('naskah-akademik.edit', Crypt::encryptString($item->id)) }}"
                               style="color: #64748b; background: #f1f5f9; width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.3s;"
                               title="Edit Data">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            {{-- ✅ Tombol Delete: ID terenkripsi di URL --}}
                            <form action="{{ route('naskah-akademik.destroy', Crypt::encryptString($item->id)) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus data ini?')"
                                  style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="border: none; color: #ef4444; background: #fef2f2; width: 36px; height: 36px; border-radius: 10px; cursor: pointer; transition: 0.3s;"
                                        title="Hapus Data">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 50px; text-align: center;">
                        <img src="https://illustrations.popsy.co/gray/empty-folder.svg" alt="empty"
                             style="width: 120px; margin-bottom: 15px; opacity: 0.5;">
                        <p style="color: #94a3b8; font-weight: 500;">Belum ada data naskah akademik.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection