<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiDetail extends Model
{
    use HasFactory;

    protected $table  = 'reservasi_details';
    protected $fillable = ['reservasi_id','nama','email','no_hp','catatan','tipe_kamar','kode_kamar'];
}
