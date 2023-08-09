<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamars';
    protected $fillable = ['tipe','harga',];

    /**
     * diskon
     *  Tipe Kamar Has One Diskon
     * @return void
     */
    public function diskon(){
        return $this->hasOne(Diskon::class, 'tipe_kamar','tipe');
    }

    // Append Nilai Harga
    protected $appends = [
        'rupiah',
    ];

    /**
     * rupiah
     * Generate Harga
     * Ke Rupiah
     * @return Attribute
     */
    protected function rupiah(): Attribute
    {
        return new Attribute(
            get:fn()=> 'Rp. ' . number_format($this->harga, 0,2),
        );
    }
}

