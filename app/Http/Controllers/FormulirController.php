<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormulirController extends Controller
{
    public function create()
    {
        $jams = Jam::orderBy('id', 'asc')->get(); // Ambil semua data jam dari tabel "jams" dan urutkan berdasarkan ID jam.

        return view('formulir.create', compact('jams'));
    }

    public function store(Request $request)
    {
        // Validasi input formulir
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'namainstansi' => 'required',
            'nomorhp' => 'required',
            'email' => 'required|email',
            'keluhan' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required|array', // Input jam adalah array
            'jam.*' => [
                'required',
                'exists:jams,id', // Validasi eksistensi ID jam dalam tabel "jams"
            ],
        ]);
    
        $selectedJams = $request->input('jam');
    
        // Hitung berapa kali setiap jam dipilih
        $countedJamIds = array_count_values($selectedJams);
    
        // Loop melalui pemilihan jam dan cek apakah melebihi 3 kali
        foreach ($countedJamIds as $jamId => $count) {
            // Query untuk menghitung berapa kali jam tersebut sudah dipilih dalam formulirs
            $jumlahPemilihan = DB::table('formulirs')
                ->where('jam', 'like', '%' . $jamId . '%')
                ->count();
    
            // Jika jumlah pemilihan lebih dari 2 (3 kali atau lebih), kembalikan pesan kesalahan
            if ($jumlahPemilihan + $count > 3) {
                return redirect()->route('formulir.create')->withErrors(['jam' => 'Anda hanya dapat memilih jam yang sama maksimal 3 kali.']);
            }
        }
    
        // Simpan data formulir
        $formulir = new Formulir([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'jabatan' => $request->input('jabatan'),
            'namainstansi' => $request->input('namainstansi'),
            'nomorhp' => $request->input('nomorhp'),
            'email' => $request->input('email'),
            'keluhan' => $request->input('keluhan'),
            'tanggal' => $request->input('tanggal'),
            'kode' => strtoupper(uniqid()), // Menghasilkan kode unik
            'jam' => implode(', ', $selectedJams), // Menyimpan jam dalam bentuk teks
        ]);
    
        $formulir->save();
    
        return redirect()->route('formulir.create')->with('success', 'Formulir berhasil disimpan.');
    }    
}
