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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 100)->unique();
            $table->string('bukti', 200);
            $table->foreignId('user_id')->constrained('users');
            $table->string('kode_kamar');
            $table->integer('diskon');
            $table->string('metode_bayar' ,50);
            $table->integer('sub_total');
            $table->enum('status', ['CANCEL','PENDING', 'SUCCESS']);

            $table->foreign('kode_kamar')->references('kode')->on('kamars')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
