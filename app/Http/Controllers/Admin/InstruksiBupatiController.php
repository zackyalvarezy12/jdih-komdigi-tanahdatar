<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstruksiBupati;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class InstruksiBupatiController extends Controller
{
    public function index()
    {
        $insbupatis = InstruksiBupati::latest()->get();
        return view('admin.insbupati.index', compact('insbupatis'));
    }

    public function create()
    {
        return view('admin.insbupati.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'            => 'required|unique:instruksi_bupatis,nomor',
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
            'nomor.required'            => 'Nomor Instruksi wajib diisi.',
            'nomor.unique'              => 'Nomor Instruksi sudah terdaftar.',
            'judul.required'            => 'Judul Instruksi wajib diisi.',
            'judul.min'                 => 'Judul Instruksi minimal 5 karakter.',
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
            $data['file_pdf'] = $request->file('file')->store('assets/insbupati', 'public');
        }

        InstruksiBupati::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Instruksi Bupati No. ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('insbupati.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $encryptedId)
    {
        $insbupati = $this->findByEncryptedId($encryptedId);
        return view('admin.insbupati.edit', compact('insbupati', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $insbupati = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'            => 'required|unique:instruksi_bupatis,nomor,' . $insbupati->id,
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
            'nomor.required'            => 'Nomor Instruksi wajib diisi.',
            'nomor.unique'              => 'Nomor Instruksi sudah terdaftar.',
            'judul.required'            => 'Judul Instruksi wajib diisi.',
            'judul.min'                 => 'Judul Instruksi minimal 5 karakter.',
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
            if ($insbupati->file_pdf && Storage::disk('public')->exists($insbupati->file_pdf)) {
                Storage::disk('public')->delete($insbupati->file_pdf);
            }
            $data['file_pdf'] = $request->file('file')->store('assets/insbupati', 'public');
        }

        $insbupati->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Instruksi Bupati No. ' . $insbupati->nomor,
            'type'        => 'warning',
        ]);

        return redirect()->route('insbupati.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $insbupati = $this->findByEncryptedId($encryptedId);

        if ($insbupati->file_pdf) {
            Storage::disk('public')->delete($insbupati->file_pdf);
        }

        $nomorLama = $insbupati->nomor;
        $insbupati->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Instruksi Bupati No. ' . $nomorLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('insbupati.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail berdasarkan slug.
     * URL: /insbupati/{slug}
     */
    public function show(string $slug)
    {
        $insbupati = InstruksiBupati::where('slug', $slug)->firstOrFail();
        return view('insbupati.show', compact('insbupati'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): InstruksiBupati
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return InstruksiBupati::findOrFail($id);
    }
}