<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';
    protected $fillable = ['tipe','kode','potongan','tgl_mulai','tgl_akhir','max_user'];


    public function kamar(){
        return $this->hasOne(Kamar::class,'kode','kode_kamar');
    }
    public function tipe(){
        return $this->hasOne(TipeKamar::class,'tipe','tipe');
    }
}
