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
        if ($user->hasRole('admin') || $user->hasRole('moderator')) {
            $orders = Order::with('user', 'orderItems')->latest()->paginate(15);
        } else {
            $orders = Order::where('user_id', $user->id)
                ->with('orderItems')
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
        if (auth()->id() !== $order->user_id && !auth()->user()->hasRole(['admin', 'moderator'])) {
            abort(403, 'Unauthorized access');
        }

        $order->load('user', 'orderItems.product');
        
        return view('orders.show', compact('order'));
    }
}
