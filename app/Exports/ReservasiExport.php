<?php

namespace App\Exports;

use App\Models\Reservasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservasiExport implements FromView
{
    public $filter;
    public function __construct($filterDate = [])
    {
        $this->filter = $filterDate;
    }

    public function view(): View
    {
        return view('exports-reservasi', [
            'kas' => Reservasi::join('transaksis', 'reservasis.kode_transaksi', '=', 'transaksis.kode_transaksi')
                ->join('reservasi_details', 'reservasis.id', '=', 'reservasi_details.reservasi_id')
                ->select('kode_reservasi', 'nama', 'no_hp', 'tgl_masuk', 'tgl_keluar', 'jumlah_tamu', 'sub_total')
                ->filter($this->filter)
                ->get(),
        ]);
    }
}
