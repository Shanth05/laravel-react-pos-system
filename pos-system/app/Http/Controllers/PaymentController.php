<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
public function processPayment(Request $request, $amount, $order)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100,
        'currency' => 'lkr',
        'source' => $request->stripeToken,
        'description' => 'POS Payment',
    ]);

    $order->update(['payment_status' => 'paid']);
}

}
