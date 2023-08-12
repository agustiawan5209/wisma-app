<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailUser extends Model
{
    use HasFactory;

    protected $table = 'detail_users';
    protected $fillable = ['user_id','foto','no_hp','alamat','jenis_kelamin'];


    protected $appends = [
        'profile_path',
    ];

    protected function profilePath() : Attribute
    {
        return new Attribute(
            get:fn()=> asset('storage/profile/'. $this->foto)
        );
    }

}
