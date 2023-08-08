<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Kamar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\User\CheckoutRequest;

class CheckoutController extends Controller
{

    public function index(){

        $request = Request::validate([
            'tipe'=> 'required|exists:tipe_kamars,tipe',
            'kode_kamar'=> 'required|exists:kamars,kode',
            'tgl_masuk'=> 'required|date',
            'tgl_keluar'=> 'required|date',
            'jumlah_tamu'=> 'required|numeric',
        ]);
        $tipe = Request::input('tipe');
        $kode_kamar = Request::input('kode_kamar');
        $tgl_masuk = Request::input('tgl_masuk');
        $tgl_keluar = Request::input('tgl_keluar');
        $jumlah_tamu = Request::input('jumlah_tamu', 1);

        // $tipe_exists = Request::exists('tipe');
        // $kode_kamar_exists = Request::exists('kode_kamar');
        // $tgl_masuk_exists = Request::exists('tgl_masuk');
        // $tgl_keluar_exists = Request::exists('tgl_keluar');
        // $jumlah_tamu_exists = Request::exists('jumlah_tamu');
        // if($tipe_exists && $kode_kamar_exists &&)
        return Inertia::render('User/checkout', [
            'formKamar' => ['tipe' => $tipe, 'tgl_masuk' => $tgl_masuk, 'tgl_keluar' => $tgl_keluar, 'jumlah_tamu' => $jumlah_tamu],
            'kamar' => Kamar::where('kode', $kode_kamar)->with(['details', 'tipe'])->first(),

        ]);
    }

    public function checkout(CheckoutRequest $checkoutRequest){
        return $checkoutRequest;
    }
}
