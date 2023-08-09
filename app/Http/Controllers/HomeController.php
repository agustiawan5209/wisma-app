<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Welcome', [
            'tipe_kamar' => TipeKamar::all(),
        ]);
    }
    public function about()
    {
        return Inertia::render('Home/About', [
            'tipe_kamar' => TipeKamar::all(),

        ]);
    }
    public function blog()
    {
        return Inertia::render('Home/Blog', [
            'tipe_kamar' => TipeKamar::all(),

        ]);
    }
    public function contact()
    {
        return Inertia::render('Home/Contact', [
            'tipe_kamar' => TipeKamar::all(),

        ]);
    }
    public function room()
    {
        $tipe = Request::input('tipe');
        $tgl_masuk = Request::input('tgl_masuk');
        $tgl_keluar = Request::input('tgl_keluar');
        $jumlah_tamu = intval(Request::input('jumlah_tamu', 1));
        $formkamar =  ['tipe' => $tipe, 'tgl_masuk' => $tgl_masuk, 'tgl_keluar' => $tgl_keluar, 'jumlah_tamu' => $jumlah_tamu];
        // dd(Request::only('search', 'tipe'));
        return Inertia::render('Home/Room', [
            'kamar' => Kamar::orderBy('id', 'desc')->with(['details', 'diskon', 'tipe', 'foto'])->filter(Request::only('search', 'tipe'))->paginate(10),
            'search' => Request::input('search'),
            'formKamar' => $formkamar,
            'tipe_kamar' => TipeKamar::all(),
            'jumlah_tamu' => intval(Request::input('jumlah_tamu', 1)),
            'tipe' => $tipe,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,

        ]);
    }
}
