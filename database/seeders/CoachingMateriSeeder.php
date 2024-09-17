<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachingMateriSeeder extends Seeder
{
    public function run()
    {
        $materi = [
            ['nama_materi' => 'Penyusunan dan Penetapan Kebutuhan ASN'],
            ['nama_materi' => 'Pengadaan ASN'],
            ['nama_materi' => 'Pengangkatan ASN'],
            ['nama_materi' => 'Jabatan'],
            ['nama_materi' => 'Pangkat'],
            ['nama_materi' => 'Pola Karier'],
            ['nama_materi' => 'Pengembangan Karier ASN'],
            ['nama_materi' => 'Mutasi'],
            ['nama_materi' => 'Penilaian Kinerja'],
            ['nama_materi' => 'Penghargaan'],
            ['nama_materi' => 'Disiplin'],
            ['nama_materi' => 'Cuti'],
            ['nama_materi' => 'Kode Etik'],
            ['nama_materi' => 'Pemberhentian'],
            ['nama_materi' => 'Jaminan Pensiun dan Hari Tua'],
            ['nama_materi' => 'Penggajian, Tunjangan, dan Fasilitasi'],
            ['nama_materi' => 'Pensiun'],
            ['nama_materi' => 'Perlindungan'],
            ['nama_materi' => 'Sistem Kerja Pada Instansi Pemerintah untuk Penyederhanaan Birokrasi'],
            ['nama_materi' => 'Manajemen Talenta'],
            ['nama_materi' => 'BerAKHLAK'],
            ['nama_materi' => 'KORPRI'],
            ['nama_materi' => 'Indeks NSPK'],
            ['nama_materi' => 'Penugasan ASN pada Instansi Pemerintah dan di luar Instansi Pemerintah'],
            ['nama_materi' => 'Jabatan Fungsional'],
        ];

        // Masukkan data ke dalam tabel coaching_materi
        DB::table('coaching_materi')->insert($materi);
    }
}


