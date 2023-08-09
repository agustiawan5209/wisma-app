<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Kamar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\User\CheckoutRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $user = User::with(['detail'])->find(Auth::user()->id);
        return Inertia::render('User/checkout', [
            'formKamar' => ['tipe' => $tipe, 'tgl_masuk' => $tgl_masuk, 'tgl_keluar' => $tgl_keluar, 'jumlah_tamu' => $jumlah_tamu],
            'kamar' => Kamar::where('kode', $kode_kamar)->with(['details','diskon', 'tipe'])->first(),
            'user'=> $user,
            'jumlah_tamu' => intval(Request::input('jumlah_tamu', 1)),
            'tipe' => $tipe,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,
        ]);
    }

    public function checkout(CheckoutRequest $checkoutRequest){
        return $checkoutRequest;
    }
}
