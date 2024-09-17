<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'petugas_konsultasi';

    protected $fillable = [
        'nama',
        'posisi',
        // Tambahkan kolom lainnya sesuai kebutuhan
    ];

    public function formulirs()
    {
        return $this->hasMany(Formulir::class, 'petugas_id');
    }
}
