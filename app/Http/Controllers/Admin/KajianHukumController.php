<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KajianHukum;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class KajianHukumController extends Controller
{
    // =========================================================================
    // ADMIN: Tampilkan semua data
    // URL: /admin/kajian-hukum
    // =========================================================================
    public function index()
    {
        try {
            $data = KajianHukum::latest()->get();
            return view('admin.kajian_hukum.index', compact('data'));
        } catch (\Exception $e) {
            return "Error pada database atau view: " . $e->getMessage();
        }
    }

    // =========================================================================
    // ADMIN: Form tambah data baru
    // URL: /admin/kajian-hukum/create
    // =========================================================================
    public function create()
    {
        return view('admin.kajian_hukum.create');
    }

    // =========================================================================
    // ADMIN: Simpan data baru ke database
    // POST: /admin/kajian-hukum
    // =========================================================================
    public function store(Request $request)
    {
        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/kajian-hukum', 'public');
        }

        // Slug otomatis di-generate oleh HasSlug dari field 'judul'
        $item = KajianHukum::create($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'description' => 'Menambahkan Kajian Hukum: ' . $item->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('kajian-hukum.index')->with('success', 'Data berhasil disimpan!');
    }

    // =========================================================================
    // ADMIN: Form edit data — ID terenkripsi di URL
    // URL: /admin/kajian-hukum/edit/{encryptedId}
    // =========================================================================
    public function edit($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = KajianHukum::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.kajian_hukum.edit', compact('item', 'encryptedId'));
    }

    // =========================================================================
    // ADMIN: Update data — ID terenkripsi di URL
    // PUT: /admin/kajian-hukum/update/{encryptedId}
    // =========================================================================
    public function update(Request $request, $encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = KajianHukum::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            // Hapus file lama jika ada
            if ($item->file_pdf) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/kajian-hukum', 'public');
        }

        // Slug akan otomatis diperbarui jika judul berubah (karena tidak pakai doNotGenerateSlugsOnUpdate)
        $item->update($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'description' => 'Memperbarui Kajian Hukum: ' . $item->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('kajian-hukum.index')->with('success', 'Data berhasil diperbarui!');
    }

    // =========================================================================
    // ADMIN: Hapus data — ID terenkripsi di URL
    // DELETE: /admin/kajian-hukum/delete/{encryptedId}
    // =========================================================================
    public function destroy($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = KajianHukum::findOrFail($id);
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
            'description' => 'Menghapus Kajian Hukum: ' . $judul,
            'type'        => 'danger',
        ]);

        return redirect()->route('kajian-hukum.index')->with('success', 'Data berhasil dihapus!');
    }

    // =========================================================================
    // PUBLIK: Tampilkan detail dokumen — menggunakan SLUG di URL
    // URL: /kajian-hukum/{slug}
    // =========================================================================
    public function show($slug)
    {
        $item = KajianHukum::where('slug', $slug)->firstOrFail();

        // Tambah jumlah views setiap kali halaman dikunjungi
        $item->increment('views');

        return view('kajian_hukum.show', compact('item'));
    }
}