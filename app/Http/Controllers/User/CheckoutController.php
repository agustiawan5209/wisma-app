<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CheckoutRequest;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $checkoutRequest){
        return $checkoutRequest;
    }
}
