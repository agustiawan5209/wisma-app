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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi',100);
            $table->string('user_id');
            $table->string('kode_reservasi',50);
            $table->string('kode_kamar',50);
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->integer('jumlah_tamu');
            $table->enum('status', ['CANCELED','CHECK-IN', 'CHECK-OUT','WAITING']);

            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksis')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
