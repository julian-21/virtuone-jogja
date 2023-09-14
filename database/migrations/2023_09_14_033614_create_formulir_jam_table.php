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
    Schema::create('formulir_jam', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('formulir_id');
        $table->unsignedBigInteger('jam_id');
        $table->timestamps();

        $table->foreign('formulir_id')->references('id')->on('formulirs')->onDelete('cascade');
        $table->foreign('jam_id')->references('id')->on('jams')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_jam');
    }
};
