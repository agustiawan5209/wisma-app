<?php

namespace App\Exports;

use App\Models\Reservasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoiceExport implements FromView, WithProperties, WithStyles
{
    public $kode, $reservasi;

    public function __construct($kode)
    {
        $this->kode= $kode;
        $this->reservasi = Reservasi::with(['detail', 'transaksi','transaksi.user','transaksi.kamar'])->where('kode_reservasi',$kode)->first();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function properties(): array
    {
        return [
            'title'          => 'Reservasi'. $this->reservasi->kode_reservasi,
            'description'    => 'Latest Invoices',
            'subject'        => 'Invoices',
            'company'        => 'Malaqbi',
        ];
    }

    public function view(): View
    {
        return view('invoice-pdf', [
            'reservasi' => Reservasi::with(['detail', 'transaksi','transaksi.user','transaksi.kamar'])->where('kode_reservasi',$this->kode)->first()
        ]);
    }
}
