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
        Schema::create('histori_permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('tiket');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->date('tanggal_transaksi');
            $table->string('nama_item', 50);
            $table->string('deskripsi', 255);
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamp('tanggal_perubahan')->useCurrent();

            $table->foreign('tiket')->references('tiket')->on('permintaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_permintaan');
    }
};
