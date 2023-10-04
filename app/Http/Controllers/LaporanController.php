<?php

namespace App\Http\Controllers;

use App\Exports\ReservasiExport;
use Inertia\Inertia;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(){
        $transaksi =  Reservasi::orderBy('id', 'desc')->with(['detail', 'transaksi'])
        ->filter(Request::only('min_date', 'max_date'))
        ->paginate(20);

        return Inertia::render("Admin/Laporan/Index", [
            'transaksi'=> $transaksi,
        ]);
    }

    public function cetakPDF(){
        $nama_file = 'laporan' . date('Y-m-d_H-i-s') . '.pdf';
        return Excel::download(new ReservasiExport(Request::only('max_date', 'min_date')), $nama_file,  \Maatwebsite\Excel\Excel::DOMPDF);
    }
    public function cetakEXCEL(){
        $nama_file = 'laporan' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new ReservasiExport(Request::only('max_date', 'min_date')), $nama_file, null, [\Maatwebsite\Excel\Excel::XLSX]);
    }
}
