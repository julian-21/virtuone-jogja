<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulir;

class CekKodeController extends Controller
{
    public function index()
    {
        return view('cek-kode'); // Ganti 'cek_kode.index' dengan nama view yang sesuai.
    }

    public function cek(Request $request)
    {
        // Validasi input kode
        $request->validate([
            'kode' => 'required|exists:formulirs,kode|min:8|max:8', // Memastikan kode ada dalam tabel formulirs.
        ]);

        // Dapatkan formulir berdasarkan kode yang dimasukkan
        $formulir = Formulir::where('kode', $request->input('kode'))->first();

        if (!$formulir) {
            return redirect()->route('cek-kode.index')->with('error', 'Kode tidak valid.'); // Ganti 'cek-kode.index' dengan rute halaman cek kode.
        }

        $id_param = urlencode(base64_encode(config('global.salt_parameter').$formulir->id));
        // Kode valid, arahkan ke halaman formulir.show dengan ID formulir
        return redirect()->route('formulir.show', ['id' => $id_param]);
    }
}
