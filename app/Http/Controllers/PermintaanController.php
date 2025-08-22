<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    /**
     * Tampilkan list permintaan
     */
    public function index()
    {
        $permintaans = Permintaan::with('user')->latest()->get();
        return view('permintaan.index', compact('permintaans'));
    }

    /**
     * Simpan permintaan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_permintaan' => 'required|date',
            'nama_item' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Permintaan::create([
            'user_id' => Auth::id(),
            'tanggal_permintaan' => $request->tanggal_permintaan,
            'nama_item' => $request->nama_item,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil dikirim!');
    }
}
