<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCompletedToFormulirs extends Migration
{
    public function up()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->boolean('is_completed')->default(0); // Adds an 'is_completed' column
        });
    }

    public function down()
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->dropColumn('is_completed');
        });
    }
}

