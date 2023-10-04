<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';
    protected $fillable = ['kode_transaksi', 'user_id','kode_reservasi','kode_kamar','tgl_masuk','tgl_keluar','status','jumlah_tamu'];

    public function transaksi(): HasOne {
        return $this->hasOne(Transaksi::class,'kode_transaksi','kode_transaksi');
    }

    public function detail(){
        return $this->hasOne(ReservasiDetail::class,'reservasi_id','id');
    }

    public function scopeFilter($query, $array)
    {
        $query->when($array['search'] ?? null, function ($query, $search) {
            $query->where('kode_transaksi', 'like', '%' . $search . '%')
                ->orWhere('kode_reservasi', 'like',  '%' . $search . '%')
                ->orWhere('kode_kamar', 'like',  '%' . $search . '%')
                ->orWhereDate('tgl_masuk', 'like',  '%' . $search . '%')
                ->orWhereDate('tgl_keluar', 'like',  '%' . $search . '%')
                ->orWhereDate('jumlah_tamu', 'like',  '%' . $search . '%')
                ->orWhere('status', 'like',  '%' . $search . '%');
        })->when($array['tgl'] ?? null,  function ($query, $date) {
            $query->whereDate('created_at', $date);
        })->when($array['status'] ?? null,  function ($query, $status) {
            $query->Where('status', $status);
        })->when($array['min_date'] ?? null && $array['max_date'] ?? null, function ($query) use ($array) {
            $query->whereBetween('created_at', [$array['min_date'], $array['max_date']]);
        });
    }
}
