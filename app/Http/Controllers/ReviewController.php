<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|min:5',
        ]);

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_visible' => true, // so it can shows to public(false; to check if it doesnt not contain bad words)
        ]);

        return back()->with('success', 'thanks for rating');
    }
}
