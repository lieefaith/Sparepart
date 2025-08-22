<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_id');
            $table->string('kode_region', 10);
            $table->string('jenis', 50)->nullable();
            $table->string('tipe', 50)->nullable();
            $table->string('nama_barang');
            $table->string('serial_number', 50)->nullable();
            $table->string('in_out', 10);
            $table->string('spk', 50);
            $table->integer('harga');
            $table->integer('quantity');
            $table->string('unit', 50);
            $table->date('tanggal');
            $table->string('pic');
            $table->string('department');
            $table->text('keterangan');
            $table->string('status', 50)->nullable();
            $table->timestamps();

            $table->foreign('jenis_id')->references('id')->on('jenis_barang')->onDelete('cascade');
            $table->foreign('kode_region')->references('kode_region')->on('region')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_barang');
    }
};
