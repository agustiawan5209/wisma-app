<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;
    protected $table = 'diskons';
    protected $fillable = ['tipe','kode','kode_kamar','potongan','tgl_mulai','tgl_akhir','max_user'];


    public function kamar(){
        return $this->hasOne(Kamar::class,'kode','kode_kamar');
    }
    public function tipe(){
        return $this->hasOne(TipeKamar::class,'tipe','tipe');
    }

    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null,  function ($query, $search) {
            $query->where('kode', 'like', '%' . $search . '%');
        })->when($filter['tipe'] ?? null,  function ($query, $tipe) {
            $query->where('tipe', '=', $tipe);
        });
    }
}
