<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Product $product)
    {
        $user = Auth::user();
        
        $like = Like::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

        if ($like) {
            $like->delete();
            return back()->with('success', 'Like reemoved');
        }

        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        return back()->with('success', 'u liked the product');
    }
}
