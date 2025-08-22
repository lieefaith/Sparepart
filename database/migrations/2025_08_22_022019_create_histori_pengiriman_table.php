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
        Schema::create('histori_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiriman_id')->constrained('pengiriman')->onDelete('cascade');
            $table->string('status', 50);
            $table->date('tanggal_transaksi');
            $table->string('nama_item', 50);
            $table->string('deskripsi', 255);
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamp('tanggal_perubahan')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_pengiriman');
    }
};
