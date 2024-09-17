<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitkerjaTableSeeder extends Seeder
{
    public function run()
    {
        $unitkerjaData = [
            ['unitkerja_kode' => '6418', 'unitkerja' => 'Pemerintah Kab. Banjarnegara'],
            ['unitkerja_kode' => '6423', 'unitkerja' => 'Pemerintah Kab. Kebumen'],
            ['unitkerja_kode' => '6422', 'unitkerja' => 'Pemerintah Kab. Purworejo'],
            ['unitkerja_kode' => '6421', 'unitkerja' => 'Pemerintah Kab. Wonosobo'],
            ['unitkerja_kode' => '6419', 'unitkerja' => 'Pemerintah Kab. Magelang'],
            ['unitkerja_kode' => '6425', 'unitkerja' => 'Pemerintah Kab. Boyolali'],
            ['unitkerja_kode' => '6424', 'unitkerja' => 'Pemerintah Kab. Klaten'],
            ['unitkerja_kode' => '6410', 'unitkerja' => 'Pemerintah Kab. Kudus'],
            ['unitkerja_kode' => '6412', 'unitkerja' => 'Pemerintah Kab. Jepara'],
            ['unitkerja_kode' => '6427', 'unitkerja' => 'Pemerintah Kab. Sukoharjo'],
            ['unitkerja_kode' => '6429', 'unitkerja' => 'Pemerintah Kab. Wonogiri'],
            ['unitkerja_kode' => '6401', 'unitkerja' => 'Pemerintah Kab. Semarang'],
            ['unitkerja_kode' => '6420', 'unitkerja' => 'Pemerintah Kab. Temanggung'],
            ['unitkerja_kode' => '6402', 'unitkerja' => 'Pemerintah Kab. Kendal'],
            ['unitkerja_kode' => '6406', 'unitkerja' => 'Pemerintah Kab. Batang'],
            ['unitkerja_kode' => '6405', 'unitkerja' => 'Pemerintah Kab. Pekalongan'],
            ['unitkerja_kode' => '6428', 'unitkerja' => 'Pemerintah Kab. Karanganyar'],
            ['unitkerja_kode' => '6426', 'unitkerja' => 'Pemerintah Kab. Sragen'],
            ['unitkerja_kode' => '6404', 'unitkerja' => 'Pemerintah Kab. Grobogan'],
            ['unitkerja_kode' => '6414', 'unitkerja' => 'Pemerintah Kab. Blora'],
            ['unitkerja_kode' => '6413', 'unitkerja' => 'Pemerintah Kab. Rembang'],
            ['unitkerja_kode' => '6409', 'unitkerja' => 'Pemerintah Kab. Pati'],
            ['unitkerja_kode' => '6400', 'unitkerja' => 'Pemerintah Provinsi Jawa Tengah'],
            ['unitkerja_kode' => '6416', 'unitkerja' => 'Pemerintah Kab. Cilacap'],
            ['unitkerja_kode' => '6415', 'unitkerja' => 'Pemerintah Kab. Banyumas'],
            ['unitkerja_kode' => '6417', 'unitkerja' => 'Pemerintah Kab. Purbalingga'],
            ['unitkerja_kode' => '6303', 'unitkerja' => 'Pemerintah Kab. Gunung Kidul'],
            ['unitkerja_kode' => '6302', 'unitkerja' => 'Pemerintah Kab. Sleman'],
            ['unitkerja_kode' => '6371', 'unitkerja' => 'Pemerintah Kota Yogyakarta'],
            ['unitkerja_kode' => '6300', 'unitkerja' => 'Pemerintah Daerah Istimewa Yogyakarta'],
            ['unitkerja_kode' => '6411', 'unitkerja' => 'Pemerintah Kab. Pemalang'],
            ['unitkerja_kode' => '6407', 'unitkerja' => 'Pemerintah Kab. Tegal'],
            ['unitkerja_kode' => '6408', 'unitkerja' => 'Pemerintah Kab. Brebes'],
            ['unitkerja_kode' => '6475', 'unitkerja' => 'Pemerintah Kota Magelang'],
            ['unitkerja_kode' => '6476', 'unitkerja' => 'Pemerintah Kota Surakarta'],
            ['unitkerja_kode' => '6472', 'unitkerja' => 'Pemerintah Kota Salatiga'],
            ['unitkerja_kode' => '6471', 'unitkerja' => 'Pemerintah Kota Semarang'],
            ['unitkerja_kode' => '6473', 'unitkerja' => 'Pemerintah Kota Pekalongan'],
            ['unitkerja_kode' => '6474', 'unitkerja' => 'Pemerintah Kota Tegal'],
            ['unitkerja_kode' => '6304', 'unitkerja' => 'Pemerintah Kab. Kulon Progo'],
            ['unitkerja_kode' => '6301', 'unitkerja' => 'Pemerintah Kab. Bantul'],
            ['unitkerja_kode' => '6403', 'unitkerja' => 'Pemerintah Kab. Demak'],
        ];

        // Masukkan data ke dalam tabel unitkerja
        DB::table('unitkerja')->insert($unitkerjaData);
    }
}

