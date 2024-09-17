<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoomIdToFormulirs extends Migration
{
    public function up()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->unsignedBigInteger('zoom_id')->nullable(); // Kolom ID Zoom
            $table->foreign('zoom_id')->references('id')->on('zooms')->onDelete('set null'); // Kunci asing ke tabel Zoom
        });
    }

    public function down()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->dropForeign(['zoom_id']);
            $table->dropColumn('zoom_id');
        });
    }
};
