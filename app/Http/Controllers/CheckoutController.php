<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {

    }
}
