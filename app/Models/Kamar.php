<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * details
     * kamar has many detail kamar
     * @return void
     */
    public function details(): HasMany
    {
        return $this->hasMany(DetailKamar::class, 'kamar_id', 'id');
    }

    /**
     * tipe
     *  Kamar Has One Tipe Kamar
     * @return void
     */
    public function tipe()
    {
        return $this->hasOne(TipeKamar::class, 'tipe', 'tipe_kamar');
    }

    public function foto()
    {
        return $this->hasOne(KamarGambar::class, 'kamar_id', 'id');
    }

    public function pathGambar()
    {
        $data = $this->details();
        $foto = null;
        // foreach($data as $item){
        //     if($item->jenis === 'gambar'){
        //         $foto = $item->detail;
        //     }
        // }
        return $foto;
    }

    /**
     * scopeFilter
     * fungsi Pencarian Untuk
     * Kode
     * Tipe Kamar
     * @param  mixed $query
     * @param  mixed $filter
     * @return void
     */
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null,  function ($query, $search) {
            $query->where('kode', 'like', '%' . $search . '%');
        })->when($filter['tipe'] ?? null,  function ($query, $tipe) {
            $query->where('tipe_kamar', '=', $tipe);
        });
    }


    /**
     * diskon
     * Kamar Has One Diskon
     * @return void
     */
    public function diskon(){
        return $this->hasOne(Diskon::class,'kode_kamar','kode');
    }
}
