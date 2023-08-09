<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';
    protected $fillable = ['kode_transaksi', 'user_id','kode_reservasi','kode_kamar','tgl_masuk','tgl_keluar','status','jumlah_tamu'];

    public function transaksi(): HasOne {
        return $this->hasOne(Transaksi::class,'kode_transaksi','kode_transaksi');
    }

    public function detail(){
        return $this->hasOne(ReservasiDetail::class,'reservasi_id','id');
    }
}
