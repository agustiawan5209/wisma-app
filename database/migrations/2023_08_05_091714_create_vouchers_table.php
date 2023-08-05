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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['1','2','3'])->comment('1 = new user, 2 = tipe_kamar, 3 = kamar');
            $table->string('kode', 50)->unique();
            $table->integer('potongan');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->integer('max_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
