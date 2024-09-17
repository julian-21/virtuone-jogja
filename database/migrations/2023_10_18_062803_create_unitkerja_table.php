<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('unitkerja', function (Blueprint $table) {
            $table->id(); // Kolom ID (secara otomatis)
            $table->string('unitkerja_kode', 20)->unique(); // Kolom kode
            $table->string('unitkerja', 255); // Kolom nama unit kerja
            $table->timestamps(); // Kolom timestamp (created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unitkerja');
    }
};
