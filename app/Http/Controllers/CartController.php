<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function getCart()
    {
        $user = Auth::user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        // load products inside cart
        $cart->load('items.product');

        return view('cart', compact('cart'));
    }

    public function addProduct(Request $request)
{
    $user = $request->user();

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'nullable|integer|min:1'
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($product->stock <= 0) {
        return response()->json([
            'message' => 'Product out of stock'
        ], 400);
    }

    $cart = Cart::firstOrCreate([
        'user_id' => $user->id
    ]);

    $cartItem = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $product->id)
        ->first();

    $quantity = $request->quantity ?? 1;

    if ($cartItem) {

        if ($cartItem->quantity + $quantity > $product->stock) {
            return response()->json([
                'message' => 'Quantity exceeds stock'
            ], 400);
        }

        $cartItem->quantity += $quantity;
        $cartItem->save();

    } else {

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $quantity
        ]);
    }

    return response()->json([
        'message' => 'Product added to cart'
    ]);
}

    public function removeProduct($id)
    {
        $cartItem = CartItem::findOrFail($id);
        
        // Ensure the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

}
