<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToDaftarPoliTable extends Migration
{
    public function up()
    {
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('daftar_poli', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
