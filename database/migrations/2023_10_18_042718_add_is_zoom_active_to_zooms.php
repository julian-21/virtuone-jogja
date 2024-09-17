<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsZoomActiveToZooms extends Migration
{
    public function up()
    {
        Schema::table('zooms', function (Blueprint $table) {
            $table->boolean('is_zoom_active')->default(false); // Define the new column
        });
    }

    public function down()
    {
        Schema::table('zooms', function (Blueprint $table) {
            $table->dropColumn('is_zoom_active'); // Define the column removal logic if needed
        });
    }
};
