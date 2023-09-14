<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jam;

class JamSeeder extends Seeder
{
    public function run()
    {
        // Data jam yang akan dimasukkan
        $jamData = [
            ['jam' => '09:00:00'],
            ['jam' => '10:00:00'],
            ['jam' => '11:00:00'],
            ['jam' => '13:00:00'],
            ['jam' => '14:00:00'],
            ['jam' => '15:00:00'],
        ];

        // Loop untuk memasukkan data jam ke dalam tabel "jams"
        foreach ($jamData as $data) {
            Jam::create($data);
        }
    }
}