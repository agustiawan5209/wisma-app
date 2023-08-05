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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['1','2'])->comment('1 = tipe_kamar, 2 = kamar');
            $table->string('kode', 50)->unique();
            $table->string('kode_kamar',50);
            $table->integer('potongan');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->foreign('kode_kamar')->references('kode')->on('kamars')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
