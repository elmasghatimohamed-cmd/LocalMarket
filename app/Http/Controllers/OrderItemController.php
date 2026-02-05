<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderStatusChanged;
use Illuminate\Support\Facades\Gate;

class OrderItemController extends Controller
{
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:en_attente,en_cours,expediee,livree,annulee',
        ]);

        $order->update([
            'status' => $validated['status']
        ]);

        $user = $order->user;

        if ($user) {
            $user->notify(new OrderStatusChanged($order));
        }

        return back()->with('success', 'Le statut de la commande #' . $order->id . ' est maintenant : ' . $order->status);
    }
}