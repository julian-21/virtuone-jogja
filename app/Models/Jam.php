<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $fillable = ['jam'];

    public function formulirs()
    {
        return $this->belongsToMany(Formulir::class, 'formulir_jam')->withTimestamps();
    }
}
