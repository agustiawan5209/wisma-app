<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function dashboard(){
        return Inertia::render('User/Dashboard', [
            'reservasi'=> Reservasi::where('user_id', Auth::user()->id)->with(['detail','detail.kamar','detail.kamar.foto','transaksi'])->latest()->first(),
        ]);
    }

    public function invoice(){
        return Inertia::render('User/InvoiceKamar', [
            'reservasi'=> Reservasi::where('user_id', Auth::user()->id)->with(['detail','detail.kamar','detail.kamar.foto','transaksi'])->latest()->first(),
        ]);
    }
    public function reservasi(){
        return Inertia::render('User/Reservasi', [
            'reservasi'=> Reservasi::where('user_id', Auth::user()->id)->with(['detail','detail.kamar','detail.kamar.foto','transaksi'])->latest()->paginate(10),
        ]);
    }

    public function profile(){
        return Inertia::render('User/Profile/Edit', [
            'user'=> User::with(['detail'])->find(Auth::user()->id),
        ]);
    }
}
