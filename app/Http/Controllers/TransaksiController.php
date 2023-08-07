<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\Checkout\StoreTransaksiRequest;
use App\Http\Requests\Checkout\UpdateTransaksiRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Transaksi/Index', [
            'transaksi' => Transaksi::orderBy('id', 'desc')->with(['kamar', 'user'])->filter(Request::only('search', 'tgl'))->paginate(10),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return Inertia::render('Admin/Transaksi/Show', [
            'transaksi' => Transaksi::with(['kamar', 'user'])->find(Request::input('slug')),
        ]);
    }

    public function confirm(Transaksi $transaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', '=', Request::input('kode_transaksi'))->first();
        if ($transaksi !== null) {
            $transaksi->update([
                'status' => 'SUCCESS',
            ]);
        }
        return redirect()->route("Transaksi.index")->with('Transaksi Berhasil Di Konfirmasi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        Transaksi::with(['kamar', 'user'])->find(Request::input('slug'))->delete();
        return redirect()->route("Transaksi.index")->with('Transaksi Berhasil Di Hapus');

    }
}
