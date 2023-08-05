<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Voucher;
use App\Models\TipeKamar;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Inertia::render('Admin/Voucher/Index', [
            'voucher'=> Voucher::orderBy('id','desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Voucher/Form', [
            'voucher'=> Voucher::orderBy('id','desc')->paginate(10),
            'tipe'=> TipeKamar::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $voucher = Voucher::create($request->all());
        return redirect()->route('Voucher.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return Inertia::render('Admin/Voucher/Show', [
            'voucher'=> Voucher::orderBy('id','desc')->find(Request::input('kode')),
            'tipe'=> TipeKamar::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        return Inertia::render('Admin/Voucher/Edit', [
            'voucher'=> Voucher::orderBy('id','desc')->find(Request::input('kode')),
            'tipe'=> TipeKamar::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->find(Request::input('slug'))->update($request->all());
        return redirect()->route('Voucher.index')->with('success', 'Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->find(Request::input('slug'))->delete();
        return redirect()->route('Voucher.index')->with('success', 'Berhasil Di Hapus');
    }
}
