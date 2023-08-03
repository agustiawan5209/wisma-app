<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $fillable = ['tipe_kamar','kode','status'];

    public function details(){
        return $this->hasMany(DetailKamar::class, 'kamar_id','id');
    }
    public function tipe(){
        return $this->hasOne(TipeKamar::class,'tipe','tipe_kamar');
    }
}
