<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coaching;

class CekKodeCoachingController extends Controller
{
    public function index()
    {
        return view('cek-kodecoaching'); // Ganti 'cek_kode.index' dengan nama view yang sesuai.
    }

    public function cek(Request $request)
    {
        // Validasi input kode
        $request->validate([
            'kode' => 'required|exists:coachings,kode|min:8|max:8', // Memastikan kode ada dalam tabel formulirs.
        ]);

        // Dapatkan formulir berdasarkan kode yang dimasukkan
        $coachings = Coaching::where('kode', $request->input('kode'))->first();

        if (!$coachings) {
            return redirect()->route('cek-kodecoaching.index')->with('error', 'Kode tidak valid.'); // Ganti 'cek-kode.index' dengan rute halaman cek kode.
        }

        $id_param = urlencode(base64_encode(config('global.salt_parameter').$coachings->id));
        // Kode valid, arahkan ke halaman formulir.show dengan ID formulir
        return redirect()->route('coaching.show', ['id' => $id_param]);
    }
}
