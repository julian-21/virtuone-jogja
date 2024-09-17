<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasKonsultasiTable extends Migration
{
    public function up()
    {
        Schema::create('petugas_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('posisi');
            // Tambahkan kolom lainnya sesuai kebutuhan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas_konsultasi');
    }
};

