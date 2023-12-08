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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kamar',50)->index();
            $table->string('kode', 50)->unique();
            $table->string('ruangan', 50)->unique();
            $table->longText('ket');
            $table->enum('status', ['1','2'])->comment('1 = Kosong, 2 = terisi');

            $table->foreign('tipe_kamar')->references('tipe')->on('tipe_kamars')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
