<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Contracts\Encryption\DecryptException;

class InfografisController extends Controller
{
    // =========================================================================
    // Helper: Generate slug unik dari judul
    // =========================================================================
    private function generateSlug(string $judul, ?int $exceptId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i    = 1;

        while (
            Infografis::where('slug', $slug)
                ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    // =========================================================================
    // ADMIN: Tampilkan semua data
    // URL: /admin/infografis
    // =========================================================================
    public function index()
    {
        $data = Infografis::latest()->get();
        return view('admin.infografis.index', compact('data'));
    }

    // =========================================================================
    // ADMIN: Form tambah data baru
    // URL: /admin/infografis/create
    // =========================================================================
    public function create()
    {
        return view('admin.infografis.create');
    }

    // =========================================================================
    // ADMIN: Simpan data baru
    // POST: /admin/infografis
    // =========================================================================
    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'file_infografis' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $path = $request->file('file_infografis')->store('assets/infografis', 'public');

        $item = Infografis::create([
            'judul'           => $request->judul,
            'slug'            => $this->generateSlug($request->judul),
            'file_infografis' => $path,
        ]);

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Mengunggah Infografis: ' . $item->judul,
            'description' => 'Admin menambahkan gambar infografis baru ke sistem.',
        ]);

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil diunggah!');
    }

    // =========================================================================
    // ADMIN: Form edit — ID terenkripsi di URL
    // URL: /admin/infografis/edit/{encryptedId}
    // =========================================================================
    public function edit($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = Infografis::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.infografis.edit', compact('item', 'encryptedId'));
    }

    // =========================================================================
    // ADMIN: Update data — ID terenkripsi di URL
    // PUT: /admin/infografis/update/{encryptedId}
    // =========================================================================
    public function update(Request $request, $encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = Infografis::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        $request->validate([
            'judul'           => 'required|string|max:255',
            'file_infografis' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug'  => $this->generateSlug($request->judul, $id),
        ];

        if ($request->hasFile('file_infografis')) {
            if ($item->file_infografis) {
                Storage::disk('public')->delete($item->file_infografis);
            }
            $data['file_infografis'] = $request->file('file_infografis')->store('assets/infografis', 'public');
        }

        $item->update($data);

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Memperbarui Infografis: ' . $item->judul,
            'description' => 'Admin mengubah data infografis.',
        ]);

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil diperbarui!');
    }

    // =========================================================================
    // ADMIN: Hapus data — ID terenkripsi di URL
    // DELETE: /admin/infografis/delete/{encryptedId}
    // =========================================================================
    public function destroy($encryptedId)
    {
        try {
            $id   = Crypt::decryptString($encryptedId);
            $item = Infografis::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404, 'Data tidak ditemukan.');
        }

        if ($item->file_infografis) {
            Storage::disk('public')->delete($item->file_infografis);
        }

        $judul = $item->judul;
        $item->delete();

        Activity::create([
            'user_id'     => Auth::id(),
            'activity'    => 'Menghapus Infografis: ' . $judul,
            'description' => 'Admin menghapus gambar infografis dari sistem.',
        ]);

        return redirect()->route('infografis.index')->with('success', 'Infografis berhasil dihapus!');
    }

    // =========================================================================
    // PUBLIK: Tampilkan detail — pakai SLUG di URL
    // URL: /infografis/{slug}
    // =========================================================================
    public function show($slug)
    {
        $item = Infografis::where('slug', $slug)->firstOrFail();
        $item->increment('views');

        return view('infografis.show', compact('item'));
    }
}