<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RancanganPuu;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class RancanganPuuController extends Controller
{
    // =========================================================================
    // ADMIN: Tampilkan semua data
    // URL: /admin/rancangan-puu
    // =========================================================================
    public function index()
    {
        $data = RancanganPuu::latest()->get();
        return view('admin.rancangan_puu.index', compact('data'));
    }

    // =========================================================================
    // ADMIN: Form tambah data baru
    // URL: /admin/rancangan-puu/create
    // =========================================================================
    public function create()
    {
        return view('admin.rancangan_puu.create');
    }

    // =========================================================================
    // ADMIN: Simpan data baru ke database
    // POST: /admin/rancangan-puu
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
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/rancangan-puu', 'public');
        }

        // Slug otomatis di-generate oleh HasSlug dari field 'judul'
        $item = RancanganPuu::create($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Menambahkan data Rancangan PUU: ' . $item->judul,
            'description' => 'Admin menambahkan draf rancangan PUU baru ke sistem.',
        ]);

        return redirect()->route('rancangan-puu.index')->with('success', 'Rancangan berhasil ditambahkan!');
    }

    // =========================================================================
    // ADMIN: Form edit data — ID terenkripsi di URL
    // URL: /admin/rancangan-puu/edit/{encryptedId}
    // =========================================================================
    public function edit($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = RancanganPuu::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.rancangan_puu.edit', compact('item', 'encryptedId'));
    }

    // =========================================================================
    // ADMIN: Update data — ID terenkripsi di URL
    // PUT: /admin/rancangan-puu/update/{encryptedId}
    // =========================================================================
    public function update(Request $request, $encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = RancanganPuu::findOrFail($id);
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
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/rancangan-puu', 'public');
        }

        // Slug otomatis diperbarui jika judul berubah
        $item->update($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Memperbarui data Rancangan PUU: ' . $item->judul,
            'description' => 'Admin mengubah rincian data rancangan peraturan.',
        ]);

        return redirect()->route('rancangan-puu.index')->with('success', 'Rancangan berhasil diperbarui!');
    }

    // =========================================================================
    // ADMIN: Hapus data — ID terenkripsi di URL
    // DELETE: /admin/rancangan-puu/delete/{encryptedId}
    // =========================================================================
    public function destroy($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = RancanganPuu::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }

        $judul = $item->judul;

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Menghapus data Rancangan PUU: ' . $judul,
            'description' => 'Admin menghapus draf rancangan PUU dari sistem.',
        ]);

        $item->delete();

        return redirect()->route('rancangan-puu.index')->with('success', 'Rancangan berhasil dihapus!');
    }

    // =========================================================================
    // PUBLIK: Tampilkan detail — menggunakan SLUG di URL
    // URL: /rancangan-puu/{slug}
    // =========================================================================
    public function show($slug)
    {
        $item = RancanganPuu::where('slug', $slug)->firstOrFail();

        // Tambah jumlah views setiap kali halaman dikunjungi
        $item->increment('views');

        return view('rancangan_puu.show', compact('item'));
    }
}