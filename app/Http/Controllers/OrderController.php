<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        // Admins see all orders, others see only theirs
        if ($user && ($user->hasAnyRole('admin|seller') || $user->hasRole('moderator'))) {
            $orders = Order::with('user', 'items')->latest()->paginate(15);
        } else {
            $orders = Order::where('user_id', $user->id ?? auth()->id())
                ->with('items')
                ->latest()
                ->paginate(15);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check authorization
        if (auth()->id() !== $order->user_id && !auth()->check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->user();
        if (auth()->id() !== $order->user_id && !($user->hasRole('admin') || $user->hasRole('moderator'))) {
            abort(403, 'Unauthorized access');
        }

        $order->load('user', 'items.product');

        return view('orders.show', compact('order'));
    }
}
