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
            'tipe'=> TipeKamar::all(),
            'kamar'=> Kamar::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiskonRequest $request)
    {
        $diskon = Diskon::create($request->all());
        return redirect()->route('Diskon.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diskon $diskon)
    {
        return Inertia::render('Admin/Diskon/Show', [
            'diskon'=> Diskon::orderBy('id','desc')->find(Request::input('kode')),
            'tipe'=> TipeKamar::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diskon $diskon)
    {
        return Inertia::render('Admin/Diskon/Edit', [
            'diskon'=> Diskon::orderBy('id','desc')->find(Request::input('kode')),
            'tipe'=> TipeKamar::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiskonRequest $request, Diskon $diskon)
    {
        $diskon->find(Request::input('slug'))->update($request->all());
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
