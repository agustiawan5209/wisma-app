<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';
    protected $fillable = ['tipe_kamar', 'kode', 'ket', 'ruangan', 'status'];


    protected $appends = [
        'status_kamar',
        // 'path_gambar',
    ];

    protected function statusKamar(): Attribute
    {
        return new Attribute(
            get: fn () => $this->status == 1 ? 'Tersedia' : 'Tidak Tersedia',
        );
    }

    public function details()
    {
        return $this->hasMany(DetailKamar::class, 'kamar_id', 'id');
    }
    public function tipe()
    {
        return $this->hasOne(TipeKamar::class, 'tipe', 'tipe_kamar');
    }

    public function pathGambar(){
        $data = $this->details();
        $foto = null;
        foreach($data as $item){
            if($item->jenis === 'gambar'){
                $foto = $item->detail;
            }
        }
        return $foto;
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
