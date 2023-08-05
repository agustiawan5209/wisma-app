<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKamar extends Model
{
    use HasFactory;

    protected $table = 'detail_kamars';
    protected $fillable = ['kamar_id','jenis','detail'];

    protected $appends = ['path_foto'];

    protected function pathFoto() : Attribute
    {
        return new Attribute(
            get: fn()=>  $this->jenis == 'gambar' ? asset('storage/kamar/'.$this->detail) : null,
        );
    }
}
