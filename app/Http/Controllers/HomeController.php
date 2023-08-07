<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render('Home/Welcome', [

        ]);
    }
    public function about(){
        return Inertia::render('Home/About', [

        ]);
    }
    public function blog(){
        return Inertia::render('Home/Blog', [

        ]);
    }
    public function contact(){
        return Inertia::render('Home/Contact', [

        ]);
    }
    public function room(){
        return Inertia::render('Home/Room', [
            'kamar'=> Kamar::orderBy('id','desc')->with(['details', 'tipe'])->filter(Request::only('search', 'tipe'))->paginate(10),
            'search'=> Request::input('search'),
        ]);
    }

}
