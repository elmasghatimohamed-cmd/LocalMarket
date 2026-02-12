<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusChanged;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CheckoutController extends Controller
{

    private function checkStockAvailability($cart)
    {
        foreach ($cart->items as $item) {
            if ($item->product->stock < $item->quantity) {
                return "Désolé, le produit '{$item->product->name}' n'a que {$item->product->stock} unité(s) en stock.";
            }
        }
        return null;
    }
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
        $request->validate([
            'address' => 'required|string|max:255',
            'stripeToken' => 'required'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        // --- ÉTAPE 1 : VÉRIFICATION DU STOCK AVANT PAIEMENT ---
        $stockError = $this->checkStockAvailability($cart);
        if ($stockError) {
            return redirect()->route('cart.index')->with('error', $stockError);
        }

        $total = collect($cart->items)->sum(fn($item) => $item->product->price * $item->quantity);
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            DB::beginTransaction();

            // --- ÉTAPE 2 : PAIEMENT STRIPE ---
            $charge = Charge::create([
                "amount" => $total * 100,
                "currency" => "mad",
                "source" => $request->stripeToken,
                "description" => "Commande LocalMart - " . $user->email
            ]);

            // --- ÉTAPE 3 : CRÉATION COMMANDE ---
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'on_hold',
                'address' => $request->address,
                'payment_id' => $charge->id,
                'payment_status' => 'completed',
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            try {
                $user->notify(new OrderStatusChanged($order));
            } catch (\Exception $e) {
                \Log::error("Mail Error: " . $e->getMessage());
            }

            return redirect()->route('orders.index')->with('success', 'Transaction réussie ! Stock mis à jour.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("CHECKOUT ERROR: " . $e->getMessage());
            return redirect()->route('checkout.process')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function storeCod(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Panier vide.');
        }

        // --- VÉRIFICATION STOCK (COD) ---
        $stockError = $this->checkStockAvailability($cart);
        if ($stockError) {
            return redirect()->route('cart.index')->with('error', $stockError);
        }

        $total = collect($cart->items)->sum(fn($item) => $item->product->price * $item->quantity);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'on_hold',
                'payment_status' => 'pending',
                'address' => $request->address ?? $user->address ?? 'Non fournie',
                'payment_id' => 'COD-' . strtoupper(uniqid()),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // --- DÉCRÉMENTATION STOCK ---
                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Commande enregistrée et stock mis à jour.');

        } catch (\Exception $e) {
            DB::rollBack();
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