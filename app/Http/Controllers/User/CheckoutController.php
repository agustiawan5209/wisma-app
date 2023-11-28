<?php

namespace App\Http\Controllers\User;

use App\Exports\InvoiceExport;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Kamar;
use Nette\Utils\Random;
use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\ReservasiDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\User\CheckoutRequest;

class CheckoutController extends Controller
{

    public function index()
    {

        $request = Request::validate([
            'tipe' => 'required|exists:tipe_kamars,tipe',
            'kode_kamar' => 'required|exists:kamars,kode',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date',
            'jumlah_tamu' => 'required|numeric',
        ]);
        $tipe = Request::input('tipe');
        $kode_kamar = Request::input('kode_kamar');
        $tgl_masuk = Request::input('tgl_masuk');
        $tgl_keluar = Request::input('tgl_keluar');
        $jumlah_tamu = Request::input('jumlah_tamu', 1);
        $user = User::with(['detail'])->find(Auth::user()->id);
        $kamar =  Kamar::where('kode', $kode_kamar)->with(['details', 'foto', 'diskon', 'tipe'])->first();
        $diskon = $this->getDiskonKamar($kamar);
        return Inertia::render('User/checkout', [
            'formKamar' => ['tipe' => $tipe, 'tgl_masuk' => $tgl_masuk, 'tgl_keluar' => $tgl_keluar, 'jumlah_tamu' => $jumlah_tamu],
            'kamar' => $kamar,
            'user' => $user,
            'jumlah_tamu' => intval(Request::input('jumlah_tamu', 1)),
            'tipe' => $tipe,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,
            'diskon' => $diskon,
            'sub_total' => intval($kamar->tipe->harga) - $diskon,
        ]);
    }
    public function getDiskonKamar($kamar)
    {
        $diskon_kamar = 0;
        $diskon_tipe = 0;
        if ($kamar->diskon !== null) {
            $diskon_kamar  = intval($kamar->diskon->potongan);
        }
        if ($kamar->tipe->diskon !== null) {
            $diskon_tipe  = intval($kamar->tipe->diskon->potongan);
        }
        $potongan = intval($diskon_kamar + $diskon_tipe) / 100;
        $harga = intval($kamar->tipe->harga);
        return   intval($harga * $potongan);
    }

    public function success()
    {
        $resevasi = Reservasi::with(['detail', 'transaksi','transaksi.user','transaksi.kamar'])->where('kode_reservasi',Request::input('kode_reservasi'))->first();
        // return Excel::download(new InvoiceExport(Request::input('kode')), 'invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        return Inertia::render('User/Success',[
            'reservasi'=> $resevasi,
        ]);
    }

    private function createCode()
    {
        $alternatif = Transaksi::max('id');
        if ($alternatif == null) {
            $kode = "TRX-01";
        } else {
            $parse_kode = substr($alternatif, 4, 2);
            $parse_kode++;
            $huruf = "TRX-";
            $kode = sprintf($huruf . "%02s",  $parse_kode);
        }
        return $kode;
    }
    private function ReservasiKode()
    {
        $alternatif = Reservasi::max('id');
        if ($alternatif == null) {
            $kode = "RSV01";
        } else {
            $parse_kode = substr($alternatif, 3, 2);
            $parse_kode++;
            $huruf = "RSV";
            $kode = sprintf($huruf . "%02s",  $parse_kode);
        }
        return $kode;
    }
    public function checkout(CheckoutRequest $checkoutRequest)
    {
        $kode_transaksi = $this->createCode();
        $nama = null;
        if ($checkoutRequest->bukti_bayar !== null || $checkoutRequest->file('bukti_bayar') !== null) {
            $file = $checkoutRequest->file('bukti_bayar');
            $nama = md5($file->getClientOriginalName());
            $file->storeAs('public', 'bukti/' . $nama);
        }
        $transaksi = Transaksi::create([
            'kode_transaksi' => $kode_transaksi,
            'bukti' => $nama,
            'user_id' => Auth::user()->id,
            'kode_kamar' => $checkoutRequest->kode_kamar,
            'diskon' => $checkoutRequest->diskon,
            'sub_total' => $checkoutRequest->sub_total,
            'metode_bayar' => $checkoutRequest->metode_bayar,
            'status' => "PENDING",
        ]);

        $reservasi = Reservasi::create([
            'kode_transaksi' => $transaksi->kode_transaksi,
            'user_id' => $transaksi->user_id,
            'kode_reservasi' => Auth::user()->name . '-' . $this->ReservasiKode(),
            'kode_kamar' => $transaksi->kode_kamar,
            'tgl_masuk' => $checkoutRequest->tgl_masuk,
            'tgl_keluar' => $checkoutRequest->tgl_keluar,
            'jumlah_tamu' => $checkoutRequest->jumlah_tamu,
            'status' => "CHECK-IN",
        ]);
        $user = User::with(['detail'])->find(Auth::user()->id);

        ReservasiDetail::create([
            'reservasi_id'=> $reservasi->id,
            'nama' => $checkoutRequest->user_name,
            'email'=> $checkoutRequest->user_email,
            'no_hp'=> $checkoutRequest->user_no_hp,
            'tipe_kamar'=> $checkoutRequest->tipe,
            'kode_kamar'=> $reservasi->kode_kamar,
        ]);

        return redirect()->route('Checkout.success', ['kode_reservasi'=> $reservasi->kode_reservasi]);
    }
}
