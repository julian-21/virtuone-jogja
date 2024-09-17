<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coaching extends Model
{
    protected $fillable = [
        'nama', 'nip', 'jabatan', 'unitkerja', 'nomorhp', 'email', 'elemenmanajemen', 'tanggal', 'kode', 'jam', 'jam_fix', 'tanggal_fix', 'zoom_id', 'gambar', 'tanggal_selesai', 'is_completed', 'pdf_content'
    ];


    public function jams()
    {
        return $this->belongsToMany(Jam::class, 'coaching_jam');
    }

    public function zoom()
    {
        return $this->belongsTo(Zoom::class, 'zoom_id');
    }

    public function zooms()
    {
        return $this->hasMany(Zoom::class);
    }
    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_fix'); // 'jam_fix' adalah nama kolom yang mengandung ID di tabel 'formulirs'
    }

    public function getList()
    {
        $results = DB::table('coachings AS c')
            ->select(
                'c.id',
                'c.nama',
                'c.nip',
                'c.jabatan',
                'c.unitkerja',
                'c.nomorhp',
                'c.tanggal',
                'c.tanggal_fix',
                'c.email',
                'c.elemenmanajemen',
                'c.zoom_id',
                'c.petugas_id',
                'c.gambar',
                'c.va_id',
                'c.is_completed',
                'c.tanggal_selesai',
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('jams AS j', 'c.jam', '=', 'j.id')
            ->join('zooms AS za', 'c.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'c.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'c.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'c.va_id', '=', 'ua.id')
            ->get();

        return $results;
    }
    public function petugasgetList($petugasId)
    {
        $results = DB::table('coachings AS c')
            ->select(
                'c.id',
                'c.nama',
                'c.nip',
                'c.jabatan',
                'c.unitkerja',
                'c.nomorhp',
                'c.tanggal',
                'c.tanggal_fix',
                'c.email',
                'c.elemenmanajemen',
                'c.zoom_id',
                'c.petugas_id',
                'c.gambar',
                'c.va_id',
                'c.tanggal_selesai',
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('jams AS j', 'c.jam', '=', 'j.id')
            ->join('zooms AS za', 'c.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'c.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'c.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'c.va_id', '=', 'ua.id')
            ->where('c.petugas_id', $petugasId) // Add this condition to filter by petugas_id
            ->get();

        return $results;
    }

    public function isCompleted()
    {
        return !is_null($this->tanggal_selesai);
    }

    public function storeGambar($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gambar', $fileName);
        $this->gambar = $fileName;
        $this->save();
    }

    public function instansiWithUnitKerja()
    {
        return $this->belongsTo(Instansi::class, 'unitkerja', 'unitkerja_kode');
    }    
}
