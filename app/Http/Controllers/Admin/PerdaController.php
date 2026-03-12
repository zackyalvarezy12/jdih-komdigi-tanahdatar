<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Activity;
use App\Models\Perda;

class PerdaController extends Controller
{
    public function index()
    {
        $perdas = Perda::latest()->get();
        return view('admin.perda.index', compact('perdas'));
    }

    public function create()
    {
        return view('admin.perda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor'   => 'required|unique:perdas,nomor',
            'judul'   => 'required|min:10',
            'tahun'   => 'required|numeric|digits:4',
            'status'  => 'required',
            'file'    => 'required|mimes:pdf|max:10000',
            'tanggal' => 'required|date',
        ], [
            'nomor.required'   => 'Nomor Perda wajib diisi.',
            'nomor.unique'     => 'Nomor Perda ini sudah terdaftar di sistem.',
            'judul.required'   => 'Judul Perda tidak boleh kosong.',
            'judul.min'        => 'Judul Perda terlalu singkat (min. 10 karakter).',
            'tahun.required'   => 'Tahun penetapan wajib diisi.',
            'tahun.digits'     => 'Tahun harus terdiri dari 4 digit.',
            'status.required'  => 'Status wajib dipilih.',
            'file.required'    => 'File dokumen PDF wajib diunggah.',
            'file.mimes'       => 'Dokumen harus berupa format PDF.',
            'file.max'         => 'Ukuran file maksimal 10MB.',
            'tanggal.required' => 'Tanggal penetapan wajib diisi.',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            $data['file_pdf'] = $request->file('file')->store('assets/perda', 'public');
        }

        Perda::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Perda No. ' . $request->nomor,
            'type'        => 'success',
        ]);

        return redirect()->route('perda.index')->with('success', 'Perda berhasil ditambahkan!');
    }

    public function edit(string $encryptedId)
    {
        $perda = $this->findByEncryptedId($encryptedId);
        return view('admin.perda.edit', compact('perda', 'encryptedId'));
    }

    public function update(Request $request, string $encryptedId)
    {
        $perda = $this->findByEncryptedId($encryptedId);

        $request->validate([
            'nomor'   => 'required|unique:perdas,nomor,' . $perda->id,
            'judul'   => 'required|min:10',
            'tahun'   => 'required|numeric|digits:4',
            'status'  => 'required',
            'file'    => 'nullable|mimes:pdf|max:10000',
            'tanggal' => 'required|date',
        ], [
            'nomor.required'   => 'Nomor Perda wajib diisi.',
            'nomor.unique'     => 'Nomor Perda ini sudah terdaftar di sistem.',
            'judul.required'   => 'Judul Perda tidak boleh kosong.',
            'judul.min'        => 'Judul Perda terlalu singkat (min. 10 karakter).',
            'tahun.required'   => 'Tahun penetapan wajib diisi.',
            'tahun.digits'     => 'Tahun harus terdiri dari 4 digit.',
            'status.required'  => 'Status wajib dipilih.',
            'file.mimes'       => 'Dokumen harus berupa format PDF.',
            'file.max'         => 'Ukuran file maksimal 10MB.',
            'tanggal.required' => 'Tanggal penetapan wajib diisi.',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            if ($perda->file_pdf && \Storage::disk('public')->exists($perda->file_pdf)) {
                \Storage::disk('public')->delete($perda->file_pdf);
            }
            $data['file_pdf'] = $request->file('file')->store('assets/perda', 'public');
        }

        $perda->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Mengubah Perda No. ' . $perda->nomor,
            'type'        => 'info',
        ]);

        return redirect()->route('perda.index')->with('success', 'Data Perda berhasil diperbarui!');
    }

    public function destroy(string $encryptedId)
    {
        $perda = $this->findByEncryptedId($encryptedId);

        if ($perda->file_pdf && \Storage::disk('public')->exists($perda->file_pdf)) {
            \Storage::disk('public')->delete($perda->file_pdf);
        }

        $nomorLama = $perda->nomor;
        $perda->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Perda No. ' . $nomorLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('perda.index')->with('success', 'Perda berhasil dihapus!');
    }

    /**
     * Halaman publik — tampilkan detail perda berdasarkan slug.
     * URL: /perda/{slug}
     */
    public function show(string $slug)
    {
        $perda = Perda::where('slug', $slug)->firstOrFail();
        return view('perda.show', compact('perda'));
    }

    // ─── Helper ─────────────────────────────────────────────────────────────

    private function findByEncryptedId(string $encryptedId): Perda
    {
        try {
            $id = Crypt::decrypt($encryptedId);
        } catch (DecryptException) {
            abort(404, 'Data tidak ditemukan.');
        }

        return Perda::findOrFail($id);
    }
}