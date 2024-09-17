<?php

namespace App\Http\Controllers;

use App\Models\Zoom;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ZoomController extends Controller
{
    public function index()
    {
        // Ambil semua data Zoom meetings dari database
        $zooms = Zoom::all();

        // Tampilkan halaman daftar Zoom meetings
        return view('zoom.index', compact('zooms'));
    }
    public function setActive($id)
    {
        $this->updateMeetingStatus($id, 1);

        return redirect()->route('zoom.index')->with('success', 'Status media teleconference telah diatur aktif.');
    }

    public function setInactive($id)
    {
        $this->updateMeetingStatus($id, 0);

        return redirect()->route('zoom.index')->with('success', 'Status media teleconference telah diatur nonaktif.');
    }

    private function updateMeetingStatus($id, $status)
    {
        // Update the specific Zoom record with the provided ID
        Zoom::where('id', $id)->update(['is_zoom_active' => $status]);
    }


    public function create()
    {
        return view('zoom.create');
    }

    public function show($id)
    {
        // Temukan data Zoom berdasarkan ID
        $zoom = Zoom::find($id);

        // Periksa apakah data Zoom ditemukan
        if (!$zoom) {
            // Jika tidak ditemukan, kembalikan respons atau redirect ke halaman lain dengan pesan kesalahan
            return redirect()->route('zoom.index')->with('error', 'Zoom meeting not found.');
        }

        // Tampilkan data Zoom dalam view
        return view('zoom.show', compact('zoom'));
    }

    public function store(Request $request)
    {
        // Validasi input form untuk meeting_id, passcode, dan link_zoom
        $request->validate([
            'meeting_id' => 'required',
            'passcode' => 'required',
            'link_zoom' => 'required',
            'media_teleconference' => 'required',
        ]);

        // Buat Zoom Meeting baru
        $zoom = new Zoom([
            'meeting_id' => $request->input('meeting_id'),
            'passcode' => $request->input('passcode'),
            'link_zoom' => $request->input('link_zoom'),
            'media_teleconference' => $request->input('media_teleconference'),
        ]);

        // Simpan Zoom Meeting ke database
        $zoom->save();

        return redirect()->route('zoom.index')->with('success', 'Pertemuan Zoom berhasil dibuat.');
    }

    public function edit($id)
    {
        // Ambil data Zoom meeting dari database berdasarkan ID
        $zoom = Zoom::find($id);

        if (!$zoom) {
            return redirect()->route('zoom.index')->with('error', 'Zoom meeting not found.');
        }

        return view('zoom.edit', compact('zoom'));
    }

    public function destroy($id)
    {
        // Temukan data Zoom berdasarkan ID
        $zoom = Zoom::find($id);

        if (!$zoom) {
            return redirect()->route('zoom.index')->with('error', 'Zoom Meeting not found.');
        }

        // Hapus Zoom Meeting
        $zoom->delete();

        return redirect()->route('zoom.index')->with('success', 'Zoom Meeting berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'meeting_id' => 'required',
            'passcode' => 'required',
            'link_zoom' => 'required', // Pastikan validasi untuk link_zoom sesuai kebutuhan
            'media_teleconference' => 'required',
        ]);

        // Temukan data Zoom berdasarkan ID
        $zoom = Zoom::find($id);

        if (!$zoom) {
            return redirect()->route('zoom.index')->with('error', 'Rapat Zoom tidak ditemukan.');
        }

        // Perbarui data Zoom, termasuk link_zoom
        $zoom->meeting_id = $request->input('meeting_id');
        $zoom->passcode = $request->input('passcode');
        $zoom->link_zoom = $request->input('link_zoom');
        $zoom->media_teleconference = $request->input('media_teleconference'); // Update link_zoom

        try {
            $zoom->save();
        } catch (\Exception $e) {
            // Tangani kesalahan, misalnya:
            return redirect()->route('zoom.index')->with('error', 'Gagal memperbarui Rapat Zoom.');
        }

        return redirect()->route('zoom.index')->with('success', 'Pertemuan Zoom berhasil diperbarui.');
    }
}
