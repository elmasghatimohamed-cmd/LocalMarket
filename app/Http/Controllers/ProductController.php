<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // show theLanding Page
    public function index()
    {

        $products = Product::with('category')->where('stock', '>', 0)->paginate(12);
        return view('products.index', compact('products'));
    }

    // show product details
    public function show(Product $product)
    {
    
    $product->load(['reviews' => function($query) {
            $query->where('is_visible', true)->latest();
        }, 'reviews.user']);

        return view('products.show', compact('product'));
    }
}