<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarGambar extends Model
{
    use HasFactory;

    protected $table = 'kamar_gambars';
    protected $fillable = ['name', 'ket','kamar_id','default'];

    public function kamar(){
        return $this->hasOne(Kamar::class, 'id','kamar_id');
    }

    protected $appends = [
        'path_gambar',
    ];

    /**
     * pathGambar
     *  Path image Gambar
     * @return Attribute
     */
    protected function pathGambar(): Attribute
    {
        return new Attribute(
            get: fn()=> asset('kamar/'.$this->name)
        );
    }

}
