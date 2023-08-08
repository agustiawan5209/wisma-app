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

    protected $appends = [
        'rupiah',
    ];

    protected function rupiah(): Attribute
    {
        return new Attribute(
            get:fn()=> 'Rp. ' . number_format($this->harga, 0,2),
        );
    }
}

