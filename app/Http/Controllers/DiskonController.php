<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Http\Requests\StoreDiskonRequest;
use App\Http\Requests\UpdateDiskonRequest;
use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DiskonController extends Controller
{

    /**
     * createCode
     *
     * @return void
     */
    private function createCode()
    {
        $alternatif = Diskon::max('kode');
        if ($alternatif == null) {
            $kode = "DK-01";
        } else {
            $parse_kode = substr($alternatif, 3, 2);
            $parse_kode++;
            $huruf = "DK-";
            $kode = sprintf($huruf . "%02s",  $parse_kode);
        }
        return $kode;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Diskon/Index', [
            'diskon'=> Diskon::orderBy('id','desc')->filter(Request::only('search','tipe'))->paginate(10),
            'search'=> Request::input('search'),
            'tipe'=> Request::input('tipe'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Diskon/Form', [
            'diskon'=> Diskon::orderBy('id','desc')->paginate(10),
            'tipe_kamar'=> TipeKamar::all(),
            'kamar'=> Kamar::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiskonRequest $request)
    {
        $req = $request->all();
        $req['kode'] =  $this->createCode();
        $diskon = Diskon::create($req);
        return redirect()->route('Diskon.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diskon $diskon)
    {
        return Inertia::render('Admin/Diskon/Show', [
            'diskon'=> Diskon::orderBy('id','desc')->where('kode',Request::input('kode'))->first(),
            'tipe_kamar'=> TipeKamar::all(),
            'kamar'=> Kamar::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diskon $diskon)
    {
        return Inertia::render('Admin/Diskon/Edit', [
            'diskon'=> Diskon::orderBy('id','desc')->where('kode',Request::input('kode'))->first(),
            'tipe_kamar'=> TipeKamar::all(),
            'kamar'=> Kamar::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiskonRequest $request, Diskon $diskon)
    {
        $diskon->where('kode',Request::input('slug'))->update($request->all());
        return redirect()->route('Diskon.index')->with('success', 'Berhasil Di Edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diskon $diskon)
    {
        $diskon->find(Request::input('slug'))->delete();
        return redirect()->route('Diskon.index')->with('success', 'Berhasil Di Hapus');
    }
}
