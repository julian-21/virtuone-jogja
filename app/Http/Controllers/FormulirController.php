<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Jam;
use App\Models\Zoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class FormulirController extends Controller
{
    public function create()
    {
        $jams = Jam::orderBy('id', 'asc')->get(); // Ambil semua data jam dari tabel "jams" dan urutkan berdasarkan ID jam.
        $unitkerjaData = DB::table('instansi')->get();

        return view('formulir.create', compact('jams'), ['unitkerjaData' => $unitkerjaData]);
    }

    public function store(Request $request)
    {
        // Validasi input formulir
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'unitkerja' => 'required',
            'nomorhp' => 'required|numeric',
            'email' => 'required|email:rfc,dns',
            'keluhan' => 'required|min:3',
            'tanggal' => 'required|date',
            'jam' => 'required|array|min:1',
            'jam.*' => [
                'required',
                'exists:jams,id',
            ],
            'captcha' => 'required|captcha'
        ]);
        //'g-recaptcha-response' => 'required|captcha',

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
            if ($jumlahPemilihan + $count > 100) {
                return redirect()->route('formulir.create')->withErrors(['jam' => 'Anda hanya dapat memilih jam yang sama maksimal 3 kali.']);
            }
        }

        // Simpan data formulir
        $id_jams = implode(', ', $selectedJams);
        $latestZoom = Zoom::latest()->first();

        $formulir = new Formulir([
            'nama' => trim(strtoupper($request->input('nama'))),
            'nip' => $request->input('nip'),
            'jabatan' => $request->input('jabatan'),
            'unitkerja' => $request->input('unitkerja'),
            'nomorhp' => $request->input('nomorhp'),
            'email' => $request->input('email'),
            'keluhan' => $request->input('keluhan'),
            'tanggal' => $request->input('tanggal'),
            'tanggal_fix' => $request->input('tanggal'),
            'kode' => substr(strtoupper(uniqid()), 0, 8),
            'jam' => $id_jams,
            'jam_fix' => $id_jams,
            'zoom_id' => $latestZoom->id
        ]);
        $formulir->save();

        // Kirim notifikasi Telegram setelah formulir berhasil disimpan
        // $this->sendTelegramNotification($request->input('nama'));

        $id_param = urlencode(base64_encode(config('global.salt_parameter').$formulir->id));
        return redirect()->route('formulir.show', ['id' => $id_param])->with('success', 'Formulir berhasil disimpan.');
    }

    private function sendTelegramNotification($namaPengisi)
    {
        $message = "Ada Pengisian Formulir Baru dengan Nama: $namaPengisi";

        // Kirim pesan notifikasi ke chat ID Anda
        Telegram::sendMessage([
            'chat_id' => '1735891331', // Gantilah dengan ID obrolan Telegram Anda
            'text' => $message,
        ]);
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function show($id)
    {
        $id_param = base64_decode(urldecode($id));
        $pjg_salt = strlen(config('global.salt_parameter'));
        $pjg_id = strlen($id_param)-$pjg_salt;
        $id_formulir = substr($id_param,$pjg_salt,$pjg_id);
        // dd($id_formulir);

        $formulir = Formulir::with('instansiWithUnitKerja')->find($id_formulir);
        $arrJamPermohonan = Jam::whereIn('id', explode(', ', $formulir->jam))->pluck('jam')->toArray();
        $jamPermohonan = $arrJamPermohonan[0];
        $arrJamPersetujuan = Jam::whereIn('id', explode(', ', $formulir->jam_fix))->pluck('jam')->toArray();
        $jamPersetujuan = $arrJamPersetujuan[0];
        $zoom = Zoom::find($formulir->zoom_id);

        if (!$formulir) {
            return response()->view('errors.404', [], 404);
        }

        // Retrieve the 'unitkerja' value from the related 'Instansi' model
        $unitkerja_combined = optional($formulir->instansiWithUnitKerja)->unitkerja;

        return view('formulir.show', compact('formulir', 'zoom', 'jamPermohonan', 'jamPersetujuan', 'unitkerja_combined'));
    }
}
