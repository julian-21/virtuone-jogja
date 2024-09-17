<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Formulir;
use App\Models\Jam;
use App\Models\Zoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\FormulirExport;
use Maatwebsite\Excel\Facades\Excel;

class FormulirAdminController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan metode getList dari model Formulir
        $formulir = new Formulir;
        $formulirs = $formulir->getList();
        $petugasKonsultasi = User::where('role', 'PETUGAS')->orderBy('name')->get();

        $monthFilter = $request->input('month');
        if ($monthFilter) {
            $formulirs = Formulir::whereMonth('tanggal', $monthFilter)->get();
        }
        // Mengambil data petugas konsultasi

        foreach ($formulirs as $formulir) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($formulir->zoom_id);

            if ($zooms) {
                $meetingId = $zooms->meeting_id;
                $passcode = $zooms->passcode;
                $zoomLink = $zooms->link_zoom;
                $mediaTeleconference = $zooms->media_teleconference;
            } else {
                // Handle the case where $zooms is not found for this $formulir
                $meetingId = 'Meeting ID Not Found';
                $passcode = 'Passcode Not Found';
                $zoomLink = 'Zoom Link Not Found';
                $mediaTeleconference = 'Media Teleconference Not Found';
            }

            $tanggal_up = $formulir->tanggal;
            $tanggal_fix = $formulir->tanggal_fix;
            $jam_final = $formulir->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_up = \Carbon\Carbon::parse($tanggal_up);
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
            $tanggal_up_formatted = $tanggal_up->format('j M Y');
            $panjang_teks = strlen($formulir->nomorhp);
            $nomore = '62' . substr($formulir->nomorhp, 1, $panjang_teks - 1);
            $formulir->nomorhp = $nomore;
            $formulir->pesanwa = "Perkenalkan, kami Virtual Assistant dari Kanreg I BKN Yogyakarta. Izin menginformasikan bahwa";

            if ($formulir->tanggal_fix == $formulir->tanggal && $formulir->jam_final == $formulir->jam_usul) {
                // If tanggal_fix is the same as tanggal, set a message for no changes
                $formulir->pesanwa .= " waktu konsultasi disetujui untuk dilaksanakan pada Tanggal: " . $tanggal_up_formatted . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            } else {
                // If there are changes, provide the updated schedule information
                $formulir->pesanwa .= " waktu konsultasi dialihkan menjadi Tanggal: " . $tanggal_fix->format('j M Y') . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            }
        }

        return view('formuliradmin.index', compact('formulirs', 'petugasKonsultasi', 'monthFilter'));
    }

    public function formulirExport(Request $request)
    {
        $monthFilter = $request->input('month');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $fileName = 'formulir_data.xlsx';

        return Excel::download(new FormulirExport($start_date, $end_date, $monthFilter), $fileName);
    }


    public function formulirReport(Request $request)
    {
        // Menggunakan metode getList dari model Formulir
        $formulir = new Formulir;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $formulirs = $formulir->getList();
        $petugasKonsultasi = User::where('role', 'PETUGAS')->orderBy('name')->get();

        if ($start_date && $end_date) {
            $formulirs = $formulirs->whereBetween('tanggal', [$start_date, $end_date]);
        }
        // Mengambil data petugas konsultasi

        foreach ($formulirs as $formulir) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($formulir->zoom_id);

            if ($zooms) {
                $meetingId = $zooms->meeting_id;
                $passcode = $zooms->passcode;
                $zoomLink = $zooms->link_zoom;
                $mediaTeleconference = $zooms->media_teleconference;
            } else {
                // Handle the case where $zooms is not found for this $formulir
                $meetingId = 'Meeting ID Not Found';
                $passcode = 'Passcode Not Found';
                $zoomLink = 'Zoom Link Not Found';
                $mediaTeleconference = 'Media Teleconference Not Found';
            }

            $tanggal_up = $formulir->tanggal;
            $tanggal_fix = $formulir->tanggal_fix;
            $jam_final = $formulir->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_up = \Carbon\Carbon::parse($tanggal_up);
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
            $tanggal_up_formatted = $tanggal_up->format('j M Y');
            $panjang_teks = strlen($formulir->nomorhp);
            $nomore = '62' . substr($formulir->nomorhp, 1, $panjang_teks - 1);
            $formulir->nomorhp = $nomore;
            $formulir->pesanwa = "Perkenalkan, kami Virtual Assistant dari Kanreg I BKN Yogyakarta. Izin menginformasikan bahwa";

            if ($formulir->tanggal_fix == $formulir->tanggal && $formulir->jam_final == $formulir->jam_usul) {
                // If tanggal_fix is the same as tanggal, set a message for no changes
                $formulir->pesanwa .= " waktu konsultasi disetujui untuk dilaksanakan pada Tanggal: " . $tanggal_up_formatted . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            } else {
                // If there are changes, provide the updated schedule information
                $formulir->pesanwa .= " waktu konsultasi dialihkan menjadi Tanggal: " . $tanggal_fix->format('j M Y') . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            }
        }

        return view('formuliradmin.formulir-report', compact('formulirs', 'petugasKonsultasi', 'start_date', 'end_date'));
    }

    public function claim(Formulir $formulir)
    {
        // Cek apakah formulir sudah diklaim oleh pengguna saat ini
        if ($formulir->va_id === auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda sudah mengklaim formulir ini.');
        }

        // Lakukan klaim formulir
        $formulir->va_id = auth()->user()->id;
        $formulir->save();

        return redirect()->back()->with('success', 'Formulir berhasil diklaim.');
    }

    public function unclaim(Formulir $formulir)
    {
        // Cek apakah pengguna saat ini adalah pemilik formulir (pengklaim)
        if ($formulir->va_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membatalkan klaim formulir ini.');
        }

        // Batalkan klaim formulir
        $formulir->va_id = null;
        $formulir->save();

        return redirect()->back()->with('success', 'Klaim formulir berhasil dibatalkan.');
    }


    public function show($id)
    {
        $formulir = Formulir::with('instansiWithUnitKerja')->find($id);
        $jamPermohonan = Jam::whereIn('id', explode(', ', $formulir->jam))->pluck('jam')->toArray();
        $jamPersetujuan = Jam::whereIn('id', explode(', ', $formulir->jam_fix))->pluck('jam')->toArray();
        $unitkerja_combined = optional($formulir->instansiWithUnitKerja)->unitkerja;

        return view('formuliradmin.show', compact('formulir', 'jamPermohonan', 'jamPersetujuan', 'unitkerja_combined'));
    }

    public function downloadFoto($fileName)
    {
        // Generate the file path to the storage
        $filePath = storage_path('app/public/gambar/' . $fileName);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404); // File not found, respond with a 404 status
        }

        // Use response()->file() to download the file
        return response()->file($filePath);
    }

    public function indexpetugas()
    {
        $petugasId = auth()->user()->id; // Retrieve the logged-in user's ID
        $formulir = new Formulir;
        // Use the "petugasgetList" method to retrieve the filtered results based on the user's ID
        $formulirs = $formulir->petugasgetList($petugasId);
        foreach ($formulirs as $formulir) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($formulir->zoom_id);

            if ($zooms) {
                $meetingId = $zooms->meeting_id;
                $passcode = $zooms->passcode;
                $zoomLink = $zooms->link_zoom;
                $mediaTeleconference = $zooms->media_teleconference;
            } else {
                // Handle the case where $zooms is not found for this $formulir
                $meetingId = 'Meeting ID Not Found';
                $passcode = 'Passcode Not Found';
                $zoomLink = 'Zoom Link Not Found';
                $mediaTeleconference = 'Media Teleconference Not Found';
            }

            $tanggal_fix = $formulir->tanggal_fix;
            $jam_final = $formulir->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
        }

        return view('formuliradmin.indexpetugas', compact('formulirs'));
    }
    // Validasi dan proses upload gambar
    public function uploadGambar(Request $request)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan validasi sesuai kebutuhan
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar', $fileName);

            // Dapatkan objek Formulir yang ingin Anda simpan gambar
            $formulir = Formulir::find($request->formulir_id);

            if ($formulir) {
                // Isi kolom 'gambar' pada objek Formulir dengan nama file
                $formulir->gambar = $fileName;
                $formulir->save();

                return redirect()->back()->with('success', 'Gambar berhasil diunggah.');
            } else {
                return redirect()->back()->with('error', 'Formulir tidak ditemukan.');
            }
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    public function downloadGambar($formulirId)
    {
        // Cari formulir berdasarkan ID
        $formulir = Formulir::find($formulirId);

        if (!$formulir) {
            return abort(404); // Formulir tidak ditemukan, tanggapi dengan kode 404
        }

        $gambarFileName = $formulir->gambar; // Dapatkan nama file gambar dari formulir

        if (!$gambarFileName) {
            return abort(404); // Jika tidak ada nama file gambar, tanggapi dengan kode 404
        }

        // Lokasi penyimpanan gambar (misalnya: storage/app/public/gambar)
        $storagePath = storage_path('app/public/gambar/' . $gambarFileName);

        if (file_exists($storagePath)) {
            // Menggunakan fungsi response()->download() untuk mengunduh gambar
            return response()->download($storagePath, $gambarFileName);
        }

        return abort(404); // Jika gambar tidak ditemukan, tanggapi dengan kode 404
    }
    public function hapusGambar($id)
    {
        $formulir = Formulir::find($id);

        if (!$formulir) {
            return abort(404);
        }

        if ($formulir->gambar) {
            // Hapus gambar dari direktori penyimpanan
            Storage::delete('public/gambar/' . $formulir->gambar);

            // Set kolom gambar di database menjadi NULL
            $formulir->gambar = null;
            $formulir->save();

            return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada gambar yang tersedia untuk dihapus.');
    }

    public function updateStatus(Request $request)
    {
        $formulirIds = $request->input('formulir_ids', []);

        if (empty($formulirIds)) {
            return redirect()->back()->with('error', 'Tidak ada formulir yang dipilih.');
        }

        try {
            // Iterate through selected formulars
            foreach ($formulirIds as $formulirId) {
                $formulir = Formulir::find($formulirId);

                if ($formulir) {
                    // Check if the formulir has an uploaded image
                    if ($formulir->gambar) {
                        // Update the formulir's status to completed
                        $formulir->update([
                            'is_completed' => 1, // Set is_completed to 1
                            'tanggal_selesai' => now(),
                        ]);
                    } else {
                        // If no image is uploaded, skip this formulir
                        continue;
                    }
                }
            }

            return redirect()->back()->with('success', 'Formulir yang dipilih ditandai sebagai selesai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui formulir.');
        }
    }

    public function showpetugas($id)
    {
        $formulir = Formulir::with('instansiWithUnitKerja')->find($id);
        $jamPermohonan = Jam::whereIn('id', explode(', ', $formulir->jam))->pluck('jam')->toArray();
        $jamPersetujuan = Jam::whereIn('id', explode(', ', $formulir->jam_fix))->pluck('jam')->toArray();
        $unitkerja_combined = optional($formulir->instansiWithUnitKerja)->unitkerja;

        return view('formuliradmin.showpetugas', compact('formulir', 'jamPermohonan', 'jamPersetujuan', 'unitkerja_combined'));
    }

    public function edit($id)
    {
        $formulir = Formulir::find($id);
        $allJams = Jam::all();

        // Mengambil data petugas konsultasi
        $petugasOptions = User::where('role', 'PETUGAS')->orderBy('name')->get();

        // Mengambil data media telekonferensi
        $zoomsOptions = Zoom::all();

        if ($formulir->va_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit formulir ini.');
        }

        $jamPermohonan = Jam::whereIn('id', explode(', ', $formulir->jam))->pluck('jam')->toArray();
        return view('formuliradmin.edit', compact('formulir', 'allJams', 'petugasOptions', 'jamPermohonan', 'zoomsOptions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'tanggal_fix' => 'required|date',
            'jam_fix' => 'required',
            'petugas_konsultasi' => 'required',
            'media_teleconference' => 'required',
        ]);

        $formulir = Formulir::find($id);

        // Temukan ID media telekonferensi berdasarkan nama yang dipilih dalam dropdown
        $mediaTeleconferenceName = $request->input('media_teleconference');
        $mediaTeleconference = Zoom::where('media_teleconference', $mediaTeleconferenceName)->first();

        if ($mediaTeleconference) {
            // Jika media telekonferensi ditemukan, simpan ID-nya dalam kolom zoom_id
            $formulir->zoom_id = $mediaTeleconference->id;
        } else {
            // Jika media telekonferensi tidak ditemukan, berikan penanganan kesalahan sesuai kebutuhan Anda
            return redirect()->back()->with('error', 'Media telekonferensi tidak valid.');
        }

        // Lanjutkan dengan menyimpan data formulir
        $formulir->nama = $request->input('nama');
        $formulir->nip = $request->input('nip');
        $formulir->tanggal_fix = $request->input('tanggal_fix');
        $formulir->jam_fix = $request->input('jam_fix');
        $formulir->petugas_id = $request->input('petugas_konsultasi');

        $formulir->save();

        return redirect()->route('formuliradmin.index')->with('success', 'Formulir berhasil diperbarui.');
    }
}
