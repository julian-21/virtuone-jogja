<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi'; // Set the table name

    public function formulirs()
    {
        return $this->hasMany(Formulir::class, 'unitkerja', 'unitkerja');
    }
}
