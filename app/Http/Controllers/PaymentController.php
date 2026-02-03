<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Notifications\OrderStatusUpdated;

class PaymentController extends Controller
{
    public function checkout(Order $order)
    {
        // Vérification simple (ou utilise $this->authorize('view', $order))
    if (auth()->id() !== $order->user_id) {
        abort(403);
    }
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => 'Commande #' . $order->id],
                    'unit_amount' => $order->total_price * 100, // Stripe compte en centimes
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $order->id),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Order $order)
    {
        // 1. Mettre à jour le statut
        $order->update(['status' => 'Payée']);

        // 2. Déclencher la notification (Email + DB + Real-time)
        $order->user->notify(new OrderStatusUpdated($order));

        return view('payment.success', compact('order'));
    }
}