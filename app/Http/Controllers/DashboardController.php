<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == "User"){
            return redirect()->route('welcome');
        }
        return Inertia::render('Dashboard');
    }
}
