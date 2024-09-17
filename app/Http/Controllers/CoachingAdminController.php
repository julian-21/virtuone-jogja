<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\MateriCoaching;
use App\Models\Jam;
use App\Models\Zoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\CoachingExport;
use Maatwebsite\Excel\Facades\Excel;

class CoachingAdminController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan metode getList dari model Formulir
        $coaching = new Coaching;
        $coachings = $coaching->getList();
        $petugasKonsultasi = User::where('role', 'PETUGAS')->orderBy('name')->get();

        $monthFilter = $request->input('month');
        if ($monthFilter) {
            $coachings = Coaching::whereMonth('tanggal', $monthFilter)->get();
        }
        // Mengambil data petugas konsultasi

        foreach ($coachings as $coaching) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($coaching->zoom_id);

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

            $tanggal_up = $coaching->tanggal;
            $tanggal_fix = $coaching->tanggal_fix;
            $jam_final = $coaching->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_up = \Carbon\Carbon::parse($tanggal_up);
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
            $tanggal_up_formatted = $tanggal_up->format('j M Y');
            $panjang_teks = strlen($coaching->nomorhp);
            $nomore = '62' . substr($coaching->nomorhp, 1, $panjang_teks - 1);
            $coaching->nomorhp = $nomore;
            $coaching->pesanwa = "Perkenalkan, kami Virtual Assistant dari Kanreg I BKN Yogyakarta. Izin menginformasikan bahwa";

            if ($coaching->tanggal_fix == $coaching->tanggal && $coaching->jam_final == $coaching->jam_usul) {
                // If tanggal_fix is the same as tanggal, set a message for no changes
                $coaching->pesanwa .= " waktu konsultasi disetujui untuk dilaksanakan pada Tanggal: " . $tanggal_up_formatted . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            } else {
                // If there are changes, provide the updated schedule information
                $coaching->pesanwa .= " waktu konsultasi dialihkan menjadi Tanggal: " . $tanggal_fix->format('j M Y') . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            }
        }

        return view('coachingadmin.index', compact('coachings', 'petugasKonsultasi', 'monthFilter'));
    }

    public function export(Request $request)
    {
        $monthFilter = $request->input('month');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $fileName = 'coaching_data.xlsx';

        return Excel::download(new CoachingExport($start_date, $end_date, $monthFilter), $fileName);
    }

    public function coachingReport(Request $request)
    {
        // Menggunakan metode getList dari model Formulir
        $coaching = new Coaching;
        $coachings = $coaching->getList();
        $petugasKonsultasi = User::where('role', 'PETUGAS')->orderBy('name')->get();

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $coachings = $coachings->whereBetween('tanggal', [$start_date, $end_date]);
        }

        // Mengambil data petugas konsultasi

        foreach ($coachings as $coaching) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($coaching->zoom_id);

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

            $tanggal_up = $coaching->tanggal;
            $tanggal_fix = $coaching->tanggal_fix;
            $jam_final = $coaching->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_up = \Carbon\Carbon::parse($tanggal_up);
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
            $tanggal_up_formatted = $tanggal_up->format('j M Y');
            $panjang_teks = strlen($coaching->nomorhp);
            $nomore = '62' . substr($coaching->nomorhp, 1, $panjang_teks - 1);
            $coaching->nomorhp = $nomore;
            $coaching->pesanwa = "Perkenalkan, kami Virtual Assistant dari Kanreg I BKN Yogyakarta. Izin menginformasikan bahwa";

            if ($coaching->tanggal_fix == $coaching->tanggal && $coaching->jam_final == $coaching->jam_usul) {
                // If tanggal_fix is the same as tanggal, set a message for no changes
                $coaching->pesanwa .= " waktu konsultasi disetujui untuk dilaksanakan pada Tanggal: " . $tanggal_up_formatted . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            } else {
                // If there are changes, provide the updated schedule information
                $coaching->pesanwa .= " waktu konsultasi dialihkan menjadi Tanggal: " . $tanggal_fix->format('j M Y') . " Jam : " . $jam_final . " menyesuaikan dengan waktu petugas kami. Media teleconference yang digunakan adalah $mediaTeleconference dengan credential sebagai berikut:
        Meeting ID: $meetingId
        Passcode: $passcode
        Link Zoom: $zoomLink
        Terima kasih telah menggunakan layanan kami.";
            }
        }

        return view('coachingadmin.coaching-report', compact('coachings', 'petugasKonsultasi', 'start_date', 'end_date'));
    }

    public function claim(Coaching $coaching)
    {
        // Cek apakah coaching sudah diklaim oleh pengguna saat ini
        if ($coaching->va_id === auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda sudah mengklaim coaching ini.');
        }

        // Lakukan klaim formulir
        $coaching->va_id = auth()->user()->id;
        $coaching->save();

        return redirect()->back()->with('success', 'Coaching berhasil diklaim.');
    }

    public function unclaim(Coaching $coaching)
    {
        // Cek apakah pengguna saat ini adalah pemilik formulir (pengklaim)
        if ($coaching->va_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membatalkan klaim Coaching ini.');
        }

        // Batalkan klaim coaching
        $coaching->va_id = null;
        $coaching->save();

        return redirect()->back()->with('success', 'Klaim Coaching berhasil dibatalkan.');
    }


    public function show($id)
    {
        $coaching = Coaching::with('instansiWithUnitKerja')->find($id);
        $jamPermohonan = Jam::whereIn('id', explode(', ', $coaching->jam))->pluck('jam')->toArray();
        $jamPersetujuan = Jam::whereIn('id', explode(', ', $coaching->jam_fix))->pluck('jam')->toArray();
        $unitkerja_combined = optional($coaching->instansiWithUnitKerja)->unitkerja;
        $materi = MateriCoaching::find($coaching->elemenmanajemen);

        return view('coachingadmin.show', compact('coaching', 'jamPermohonan', 'jamPersetujuan', 'unitkerja_combined', 'materi'));
    }

    public function indexpetugas()
    {
        $petugasId = auth()->user()->id; // Retrieve the logged-in user's ID
        $coaching = new Coaching;
        // Use the "petugasgetList" method to retrieve the filtered results based on the user's ID
        $coachings = $coaching->petugasgetList($petugasId);
        foreach ($coachings as $coaching) {
            // Proses penggantian nomorhp, tanggal_fix, dan lainnya seperti yang Anda lakukan sebelumnya

            // Fetch the Zoom data based on your actual logic
            $zooms = Zoom::find($coaching->zoom_id);

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

            $tanggal_fix = $coaching->tanggal_fix;
            $jam_final = $coaching->jam_final;
            $tanggal_fix = \Carbon\Carbon::parse($tanggal_fix); // Mengonversi string menjadi objek Carbon
            $tanggal_fix_formatted = $tanggal_fix->format('j M Y');
        }

        return view('coachingadmin.indexpetugas', compact('coachings'));
    }
    // Validasi dan proses upload gambar
    public function uploadFile(Request $request)
    {
        $request->validate([
            'gambar' => 'mimes:jpeg,png,jpg,gif,doc,docx,pdf,xlsx,xls|max:10240', // Sesuaikan validasi sesuai kebutuhan
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar', $fileName);

            // Dapatkan objek Formulir yang ingin Anda simpan gambar
            $coaching = Coaching::find($request->coaching_id);

            if ($coaching) {
                // Isi kolom 'gambar' pada objek Formulir dengan nama file
                $coaching->gambar = $fileName;
                $coaching->save();

                return redirect()->back()->with('success', 'Gambar berhasil diunggah.');
            } else {
                return redirect()->back()->with('error', 'Coaching tidak ditemukan.');
            }
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    public function downloadGambar($coachingId)
    {
        // Cari formulir berdasarkan ID
        $coaching = Coaching::find($coachingId);

        if (!$coaching) {
            return abort(404); // Formulir tidak ditemukan, tanggapi dengan kode 404
        }

        $gambarFileName = $coaching->gambar; // Dapatkan nama file gambar dari formulir

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

    public function downloadFile($fileName)
    {
        $filePath = storage_path('app/public/gambar/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName);
        } else {
            return abort(404); // File not found
        }
    }

    public function hapusGambar($id)
    {
        $coaching = Coaching::find($id);

        if (!$coaching) {
            return abort(404);
        }

        if ($coaching->gambar) {
            // Hapus gambar dari direktori penyimpanan
            Storage::delete('public/gambar/' . $coaching->gambar);

            // Set kolom gambar di database menjadi NULL
            $coaching->gambar = null;
            $coaching->save();

            return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada gambar yang tersedia untuk dihapus.');
    }

    public function updateStatus(Request $request)
    {
        $coachingIds = $request->input('coaching_ids', []);

        if (empty($coachingIds)) {
            return redirect()->back()->with('error', 'Tidak ada coaching yang dipilih.');
        }

        try {
            // Iterate through selected formulars
            foreach ($coachingIds as $coachingId) {
                $coaching = Coaching::find($coachingId);

                if ($coaching) {
                    // Check if the coaching has an uploaded image
                    if ($coaching->gambar) {
                        // Update the coaching's status to completed
                        $coaching->update([
                            'is_completed' => 1, // Set is_completed to 1
                            'tanggal_selesai' => now(),
                        ]);
                    } else {
                        // If no image is uploaded, skip this formulir
                        continue;
                    }
                }
            }

            return redirect()->back()->with('success', 'Coaching yang dipilih ditandai sebagai selesai.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui coaching.');
        }
    }

    public function showpetugas($id)
    {
        $coaching = Coaching::with('instansiWithUnitKerja')->find($id);
        $jamPermohonan = Jam::whereIn('id', explode(', ', $coaching->jam))->pluck('jam')->toArray();
        $jamPersetujuan = Jam::whereIn('id', explode(', ', $coaching->jam_fix))->pluck('jam')->toArray();
        $unitkerja_combined = optional($coaching->instansiWithUnitKerja)->unitkerja;
        $materi = MateriCoaching::find($coaching->elemenmanajemen);

        return view('coachingadmin.showpetugas', compact('coaching', 'jamPermohonan', 'jamPersetujuan', 'unitkerja_combined', 'materi'));
    }

    public function edit($id)
    {
        $coaching = Coaching::find($id);
        $allJams = Jam::all();

        // Mengambil data petugas konsultasi
        $petugasOptions = User::where('role', 'PETUGAS')->orderBy('name')->get();

        // Mengambil data media telekonferensi
        $zoomsOptions = Zoom::all();

        if ($coaching->va_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit Coaching ini.');
        }

        $jamPermohonan = Jam::whereIn('id', explode(', ', $coaching->jam))->pluck('jam')->toArray();
        return view('coachingadmin.edit', compact('coaching', 'allJams', 'petugasOptions', 'jamPermohonan', 'zoomsOptions'));
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

        $coaching = Coaching::find($id);

        // Temukan ID media telekonferensi berdasarkan nama yang dipilih dalam dropdown
        $mediaTeleconferenceName = $request->input('media_teleconference');
        $mediaTeleconference = Zoom::where('media_teleconference', $mediaTeleconferenceName)->first();

        if ($mediaTeleconference) {
            // Jika media telekonferensi ditemukan, simpan ID-nya dalam kolom zoom_id
            $coaching->zoom_id = $mediaTeleconference->id;
        } else {
            // Jika media telekonferensi tidak ditemukan, berikan penanganan kesalahan sesuai kebutuhan Anda
            return redirect()->back()->with('error', 'Media telekonferensi tidak valid.');
        }

        // Lanjutkan dengan menyimpan data coaching
        $coaching->nama = $request->input('nama');
        $coaching->nip = $request->input('nip');
        $coaching->tanggal_fix = $request->input('tanggal_fix');
        $coaching->jam_fix = $request->input('jam_fix');
        $coaching->petugas_id = $request->input('petugas_konsultasi');

        $coaching->save();

        return redirect()->route('coachingadmin.index')->with('success', 'Coaching berhasil diperbarui.');
    }
}
