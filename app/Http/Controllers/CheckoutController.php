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
        // 1. Validation
        $request->validate([
            'address' => 'required|string|max:255',
            'stripeToken' => 'required'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        $total = collect($cart->items)->sum(fn($item) => $item->product->price * $item->quantity);

        // Utilisation de config() pour plus de fiabilité
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            \DB::beginTransaction();

            // 2. Exécution du paiement
            $charge = Charge::create([
                "amount" => $total * 100,
                "currency" => "mad",
                "source" => $request->stripeToken,
                "description" => "Commande LocalMart - " . $user->email
            ]);

            // 3. Création de la commande (Vérifie bien ton modèle Order)
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'on_hold',
                'address' => $request->address,
                'payment_id' => $charge->id,
                'payment_status' => 'completed',
            ]);

            // 4. Items de commande
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // 5. Suppression du panier
            $cart->items()->delete();
            $cart->delete();

            \DB::commit();

            // Notification Mailtrap
            try {
                $user->notify(new OrderStatusChanged($order));
            } catch (\Exception $e) {
                \Log::error("Mail Error: " . $e->getMessage());
            }

            return redirect()->route('orders.index')->with('success', 'Transaction réussie !');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error("CHECKOUT ERROR: " . $e->getMessage());
            return redirect()->route('checkout.process')->with('error', 'Le paiement a échoué : ' . $e->getMessage());
        }
    }

    public function storeCod()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        $total = collect($cart->items)->sum(fn($item) => $item->product->price * $item->quantity);

        try {
            \DB::beginTransaction();

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'on_hold',
                'payment_status' => 'pending',
                'address' => $user->address ?? 'To be provided',
                'payment_id' => 'COD-' . strtoupper(uniqid()),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            \DB::commit();

            return redirect()->route('orders.index')->with('success', 'Commande enregistrée (Paiement à la livraison)');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function showCod()
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = $cart->items->map(function ($item) {
            return $item->product->price * $item->quantity;
        })->sum();

        return view('checkout.cod', compact('total', 'cart'));
    }
}