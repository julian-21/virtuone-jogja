<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriCoaching extends Model
{
    use HasFactory;

    protected $table = 'coaching_materi'; // Tentukan nama tabel yang sesuai

    protected $fillable = ['nama_materi']; // Tentukan kolom yang dapat diisi
}

