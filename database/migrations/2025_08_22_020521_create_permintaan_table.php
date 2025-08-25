<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanTable extends Migration
{
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('tiket')->unique()->notNullable();
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_permintaan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan');
    }
}
