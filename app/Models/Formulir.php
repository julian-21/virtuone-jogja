<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    protected $fillable = [
        'nama', 'nip', 'jabatan', 'namainstansi', 'nomorhp', 'email', 'keluhan', 'tanggal', 'kode', 'jam'
    ];

    public function jams()
    {
        return $this->belongsToMany(Jam::class, 'formulir_jam');
    }
}
