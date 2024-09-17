<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingMateriTable extends Migration
{
    public function up()
    {
        Schema::create('coaching_materi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_materi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coaching_materi');
    }
}
;
