<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    /**
     * Menampilkan daftar semua kontak/pesan.
     */
    public function index()
    {
        $data = Kontak::latest()->get();
        return view('admin.kontak.index', compact('data'));
    }

    /**
     * Menampilkan form untuk menambah kontak baru secara manual.
     */
    public function create()
    {
        return view('admin.kontak.create');
    }

    /**
     * Menyimpan data kontak baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string|max:1000',
        ]);

        Kontak::create($request->all());

        // Mencatat aktivitas admin
        Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Menambah Kontak',
            'description' => 'Admin menambahkan data kontak baru secara manual.'
        ]);

        return redirect()->route('kontak.index')->with('success', 'Kontak berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk data kontak tertentu.
     */
    public function edit($id)
    {
        $item = Kontak::findOrFail($id);
        return view('admin.kontak.edit', compact('item'));
    }

    /**
     * Memperbarui data kontak di database.
     */
    public function update(Request $request, $id)
    {
        $item = Kontak::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string',
        ]);

        $item->update($request->all());

        return redirect()->route('kontak.index')->with('success', 'Data kontak berhasil diperbarui!');
    }

    /**
     * Menghapus data kontak.
     */
    public function destroy($id)
    {
        $item = Kontak::findOrFail($id);
        $item->delete();

        return redirect()->route('kontak.index')->with('success', 'Pesan kontak telah dihapus.');
    }
}