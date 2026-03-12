<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propemda;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PropemdaController extends Controller
{
    public function index()
    {
        $propemdas = Propemda::latest()->get();
        return view('admin.propemda.index', compact('propemdas'));
    }

    public function create()
    {
        return view('admin.propemda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'            => 'required|unique:propemdas,nomor',
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'required|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bahasa'           => 'required',
            'lokasi'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor Propemda wajib diisi.',
            'nomor.unique'              => 'Nomor Propemda sudah terdaftar.',
            'judul.required'            => 'Judul Propemda wajib diisi.',
            'judul.min'                 => 'Judul Propemda minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.required'             => 'File PDF wajib diunggah.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'tanggal.date'              => 'Format tanggal tidak valid.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bahasa.required'           => 'Bahasa wajib diisi.',
            'lokasi.required'           => 'Lokasi wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token']);

        if ($request->hasFile('file')) {
            $data['file_pdf'] = $request->file('file')->store('assets/propemda', 'public');
        }

        Propemda::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Propemda: ' . $request->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('propemda.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $encryptedId)
    {
        $propemda = $this->findByEncryptedId($encryptedId);
        return view('admin.propemda.edit', compact('propemda', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $propemda = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'            => 'required|unique:propemdas,nomor,' . $propemda->id,
            'judul'            => 'required|min:5',
            'tahun'            => 'required|numeric',
            'status'           => 'required',
            'file'             => 'nullable|mimes:pdf|max:10000',
            'tempat_penetapan' => 'required',
            'tanggal'          => 'required|date',
            'sumber'           => 'required',
            'subjek'           => 'required',
            'bahasa'           => 'required',
            'lokasi'           => 'required',
            'bidang_hukum'     => 'required',
        ], [
            'nomor.required'            => 'Nomor Propemda wajib diisi.',
            'nomor.unique'              => 'Nomor Propemda sudah terdaftar.',
            'judul.required'            => 'Judul Propemda wajib diisi.',
            'judul.min'                 => 'Judul Propemda minimal 5 karakter.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.numeric'             => 'Tahun harus berupa angka.',
            'status.required'           => 'Status wajib dipilih.',
            'file.mimes'                => 'File harus berformat PDF.',
            'file.max'                  => 'Ukuran file maksimal 10MB.',
            'tempat_penetapan.required' => 'Tempat Penetapan wajib diisi.',
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'tanggal.date'              => 'Format tanggal tidak valid.',
            'sumber.required'           => 'Sumber wajib diisi.',
            'subjek.required'           => 'Subjek wajib diisi.',
            'bahasa.required'           => 'Bahasa wajib diisi.',
            'lokasi.required'           => 'Lokasi wajib diisi.',
            'bidang_hukum.required'     => 'Bidang Hukum wajib diisi.',
        ]);

        $data = $request->except(['file', '_token', '_method']);

        if ($request->hasFile('file')) {
            if ($propemda->file_pdf && Storage::disk('public')->exists($propemda->file_pdf)) {
                Storage::disk('public')->delete($propemda->file_pdf);
            }
            $data['file_pdf'] = $request->file('file')->store('assets/propemda', 'public');
        }

        $propemda->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Propemda: ' . $propemda->judul,
            'type'        => 'warning',
        ]);

        return redirect()->route('propemda.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $propemda = $this->findByEncryptedId($encryptedId);

        if ($propemda->file_pdf) {
            Storage::disk('public')->delete($propemda->file_pdf);
        }

        $judulLama = $propemda->judul;
        $propemda->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Propemda: ' . $judulLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('propemda.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail berdasarkan slug.
     * URL: /propemda/{slug}
     */
    public function show(string $slug)
    {
        $propemda = Propemda::where('slug', $slug)->firstOrFail();
        return view('propemda.show', compact('propemda'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): Propemda
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return Propemda::findOrFail($id);
    }
}