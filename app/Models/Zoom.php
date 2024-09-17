<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $fillable = [
        'meeting_id',
        'passcode',
        'link_zoom',
        'media_teleconference',
    ];

    // Definisikan relasi antara Zoom dan Formulir
    public function formulir()
    {
        return $this->belongsTo(Formulir::class, 'formulir_id', 'id');
    }
}
