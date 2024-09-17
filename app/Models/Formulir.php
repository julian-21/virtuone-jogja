<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Formulir extends Model
{
    protected $fillable = [
        'nama', 'nip', 'jabatan', 'unitkerja', 'nomorhp', 'email', 'keluhan', 'tanggal', 'kode', 'jam', 'jam_fix', 'tanggal_fix', 'zoom_id', 'gambar', 'tanggal_selesai', 'is_completed'
    ];


    public function jams()
    {
        return $this->belongsToMany(Jam::class, 'formulir_jam');
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
        return $this->belongsTo(Jam::class, 'jam','jam_fix'); 
    }

    public function getList()
    {
        $results = DB::table('formulirs AS f')
            ->select(
                'f.id',
                'f.nama',
                'f.nip',
                'f.jabatan',
                'f.unitkerja',
                'f.nomorhp',
                'f.tanggal',
                'f.tanggal_fix',
                'f.email',
                'f.keluhan',
                'f.zoom_id',
                'f.petugas_id',
                'f.gambar',
                'f.va_id',
                'f.is_completed',
                'f.tanggal_selesai',
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('jams AS j', 'f.jam', '=', 'j.id')
            ->join('zooms AS za', 'f.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'f.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'f.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'f.va_id', '=', 'ua.id')
            ->get();

        return $results;
    }
    public function petugasgetList($petugasId)
    {
        $results = DB::table('formulirs AS f')
            ->select(
                'f.id',
                'f.nama',
                'f.nip',
                'f.jabatan',
                'f.unitkerja',
                'f.nomorhp',
                'f.tanggal',
                'f.tanggal_fix',
                'f.email',
                'f.keluhan',
                'f.zoom_id',
                'f.petugas_id',
                'f.gambar',
                'f.va_id',
                'f.tanggal_selesai',
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('jams AS j', 'f.jam', '=', 'j.id')
            ->join('zooms AS za', 'f.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'f.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'f.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'f.va_id', '=', 'ua.id')
            ->where('f.petugas_id', $petugasId) // Add this condition to filter by petugas_id
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
