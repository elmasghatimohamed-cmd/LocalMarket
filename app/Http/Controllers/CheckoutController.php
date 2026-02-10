<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusChanged;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function process()
    {
        $user = Auth::user();
        // On récupère le panier avec les produits
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = collect($cart->items)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.process', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
        $total = collect($cart->items)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Configuration de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Création de la charge Stripe
            $charge = Charge::create([
                "amount" => $total * 100, // Stripe calcule en centimes (ex: 100.00 DH = 10000)
                "currency" => "mad",
                "source" => $request->stripeToken,
                "description" => "Paiement commande LocalMart - " . $user->email
            ]);

            // Si le paiement est réussi, on crée la commande en base de données
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'en_cours', // Directement en cours après paiement
                'payment_id' => $charge->id,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Vider le panier
            $cart->items()->delete();

            // Notification Mailtrap
            $user->notify(new OrderStatusChanged($order));

            return redirect()->route('orders.index')->with('success', 'Paiement validé ! Votre commande est en préparation.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur de paiement : ' . $e->getMessage());
        }
    }
}