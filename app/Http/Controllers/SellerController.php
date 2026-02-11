<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusChanged;

class SellerController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        return view('seller.crud.index', compact('products'));
    }

    public function orders()
    {
        $orders = Order::whereHas('items.product', function($query) {
            $query->where('seller_id', Auth::id());
        })->with(['user', 'items.product'])->latest()->get();

        return view('seller.crud.status', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:on_hold,paid,delivered'
        ]);

        $order->update(['status' => $request->status]);
        $order->user->notify(new OrderStatusChanged($order));

        return back()->with('success', 'Statut mis à jour');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Product created');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('seller_id', Auth::id())
            ->firstOrFail();

        $product->delete();

        return back()->with('success', 'Product deleted');
    }
}
