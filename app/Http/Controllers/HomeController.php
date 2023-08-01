<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        ]);
    }

}
