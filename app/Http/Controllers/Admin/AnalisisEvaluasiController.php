<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnalisisEvaluasi;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AnalisisEvaluasiController extends Controller
{
    public function index()
    {
        $data = AnalisisEvaluasi::latest()->get();
        return view('admin.analisis_evaluasi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.analisis_evaluasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'required|mimes:pdf|max:10000',
        ], [
            'type_dokumen.required'  => 'Type dokumen wajib diisi.',
            'judul.required'         => 'Judul wajib diisi.',
            'teu_pengarang.required' => 'T.E.U pengarang/badan wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'file_pdf.required'      => 'File PDF wajib diunggah.',
            'file_pdf.mimes'         => 'File harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file maksimal 10MB.',
        ]);

        $data = $request->all();

        // Generate slug unik dari judul
        $slug         = Str::slug($request->judul);
        $originalSlug = $slug;
        $count        = 1;
        while (AnalisisEvaluasi::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/analisis', 'public');
        }

        AnalisisEvaluasi::create($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menambahkan Analisis Evaluasi: ' . $request->judul,
            'type'        => 'success',
        ]);

        return redirect()->route('analisis-evaluasi.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Edit - menerima encryptedId dari URL admin
     */
    public function edit($encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = AnalisisEvaluasi::findOrFail($id);

        return view('admin.analisis_evaluasi.edit', compact('item', 'encryptedId'));
    }

    /**
     * Update - menerima encryptedId dari URL admin
     */
    public function update(Request $request, $encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = AnalisisEvaluasi::findOrFail($id);

        $request->validate([
            'type_dokumen'  => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'teu_pengarang' => 'required|string|max:255',
            'tahun'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'file_pdf'      => 'nullable|mimes:pdf|max:10000',
        ], [
            'type_dokumen.required'  => 'Type dokumen wajib diisi.',
            'judul.required'         => 'Judul wajib diisi.',
            'teu_pengarang.required' => 'T.E.U pengarang/badan wajib diisi.',
            'tahun.required'         => 'Tahun wajib diisi.',
            'tahun.digits'           => 'Tahun harus terdiri dari 4 digit.',
            'tahun.integer'          => 'Tahun harus berupa angka.',
            'tahun.min'              => 'Tahun tidak valid.',
            'tahun.max'              => 'Tahun tidak boleh melebihi tahun ini.',
            'file_pdf.mimes'         => 'File harus berformat PDF.',
            'file_pdf.max'           => 'Ukuran file maksimal 10MB.',
        ]);

        $data = $request->all();

        // Update slug jika judul berubah, tetap pastikan unik
        $slug         = Str::slug($request->judul);
        $originalSlug = $slug;
        $count        = 1;
        while (AnalisisEvaluasi::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('file_pdf')) {
            if ($item->file_pdf) {
                Storage::disk('public')->delete($item->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('assets/analisis', 'public');
        }

        $item->update($data);

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Memperbarui Analisis Evaluasi: ' . $item->judul,
            'type'        => 'info',
        ]);

        return redirect()->route('analisis-evaluasi.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    /**
     * Destroy - menerima encryptedId dari URL admin
     */
    public function destroy($encryptedId)
    {
        $id   = Crypt::decryptString($encryptedId);
        $item = AnalisisEvaluasi::findOrFail($id);

        if ($item->file_pdf) {
            Storage::disk('public')->delete($item->file_pdf);
        }

        $judulLama = $item->judul;
        $item->delete();

        Activity::create([
            'user_id'     => auth()->id(),
            'description' => 'Menghapus Analisis Evaluasi: ' . $judulLama,
            'type'        => 'danger',
        ]);

        return redirect()->route('analisis-evaluasi.index')->with('success', 'Data Berhasil Dihapus!');
    }

    /**
     * Show publik - menggunakan SLUG
     */
    public function show($slug)
    {
        $item = AnalisisEvaluasi::where('slug', $slug)->firstOrFail();

        return view('analisis_evaluasi.show', compact('item'));
    }
}