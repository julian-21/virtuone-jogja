<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetugasKonsultasi;

class PetugasKonsultasiSeeder extends Seeder
{
    public function run()
    {
        // Contoh data petugas konsultasi
        $petugas1 = [
            'nama' => 'Anton',
            'posisi' => 'Petugas 1',
            // tambahkan kolom lainnya sesuai kebutuhan
        ];

        $petugas2 = [
            'nama' => 'Mukidi',
            'posisi' => 'Petugas 2',
            // tambahkan kolom lainnya sesuai kebutuhan
        ];

        // Simpan data ke dalam tabel
        PetugasKonsultasi::create($petugas1);
        PetugasKonsultasi::create($petugas2);

        // Tambahkan data lainnya jika diperlukan
    }
}

