<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MateriCoaching;

class UpdateMateriCoachingSeeder extends Seeder
{
    public function run()
    {
        MateriCoaching::whereBetween('id', [19, 25])
            ->update(['nama_materi' => DB::raw("CONCAT(nama_materi, ' Hot Topik')")]);
    }
}

