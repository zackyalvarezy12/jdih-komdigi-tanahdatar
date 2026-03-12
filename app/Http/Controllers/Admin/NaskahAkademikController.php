<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NaskahAkademik;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class NaskahAkademikController extends Controller
{
    // =========================================================================
    // ADMIN: Tampilkan semua data
    // URL: /admin/naskah-akademik
    // =========================================================================
    public function index()
    {
        $data = NaskahAkademik::latest()->get();
        return view('admin.naskah_akademik.index', compact('data'));
    }

    // =========================================================================
    // ADMIN: Form tambah data baru
    // URL: /admin/naskah-akademik/create
    // =========================================================================
    public function create()
    {
        return view('admin.naskah_akademik.create');
    }

    // =========================================================================
    // ADMIN: Simpan data baru ke database
    // POST: /admin/naskah-akademik
    // =========================================================================
    public function store(Request $request)
    {
        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'required|mimes:pdf|max:10240',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/naskah-akademik', 'public');
        }

        // Slug otomatis di-generate oleh HasSlug dari field 'judul'
        $item = NaskahAkademik::create($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'description' => 'Menambahkan Naskah Akademik: ' . $item->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('naskah-akademik.index')->with('success', 'Naskah Akademik berhasil ditambahkan!');
    }

    // =========================================================================
    // ADMIN: Form edit data — ID terenkripsi di URL
    // URL: /admin/naskah-akademik/edit/{encryptedId}
    // =========================================================================
    public function edit($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = NaskahAkademik::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.naskah_akademik.edit', compact('item', 'encryptedId'));
    }

    // =========================================================================
    // ADMIN: Update data — ID terenkripsi di URL
    // PUT: /admin/naskah-akademik/update/{encryptedId}
    // =========================================================================
    public function update(Request $request, $encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = NaskahAkademik::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            // Hapus file lama jika ada
            if ($item->file_pdf) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/naskah-akademik', 'public');
        }

        // Slug otomatis diperbarui jika judul berubah
        $item->update($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'description' => 'Memperbarui Naskah Akademik: ' . $item->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('naskah-akademik.index')->with('success', 'Naskah Akademik berhasil diperbarui!');
    }

    // =========================================================================
    // ADMIN: Hapus data — ID terenkripsi di URL
    // DELETE: /admin/naskah-akademik/delete/{encryptedId}
    // =========================================================================
    public function destroy($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = NaskahAkademik::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }

        $judul = $item->judul;
        $item->delete();

        Activity::create([
            'user_id'     => Auth::id(),
            'description' => 'Menghapus Naskah Akademik: ' . $judul,
            'type'        => 'danger',
        ]);

        return redirect()->route('naskah-akademik.index')->with('success', 'Naskah Akademik berhasil dihapus!');
    }

    // =========================================================================
    // PUBLIK: Tampilkan detail — menggunakan SLUG di URL
    // URL: /naskah-akademik/{slug}
    // =========================================================================
    public function show($slug)
    {
        $item = NaskahAkademik::where('slug', $slug)->firstOrFail();

        // Tambah jumlah views setiap kali halaman dikunjungi
        $item->increment('views');

        return view('naskah_akademik.show', compact('item'));
    }
}