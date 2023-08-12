<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserController extends Controller
{
    public function dashboard(){
        return Inertia::render('User/Dashboard');
    }
}
