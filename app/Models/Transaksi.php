<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = ['kode_transaksi', 'bukti', 'user_id', 'kode_kamar', 'diskon', 'metode_bayar', 'sub_total', 'status'];

    protected $appends = [
        'bukti_path',
        'tanggal',
    ];

    protected function buktiPath(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/bukti/' . $this->bukti)
        );
    }
    protected function tanggal(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->created_at)->format('Y-m-d')
        );
    }

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'kode', 'kode_kamar');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeFilter($query, $array)
    {
        $query->when($array['search'] ?? null, function ($query, $search) {
            $query->where('kode_transaksi', 'like', '%' . $search . '%');
        })->when($array['tgl'] ?? null,  function ($query, $date) {
            $query->whereDate('created_at', $date);
        });
    }
}
