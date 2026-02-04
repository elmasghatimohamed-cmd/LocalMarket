<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        
        return view('products.index', compact('products'));
    }

    public function sellerProduct(){
        $products = Product::where('seller_id', Auth::id())->paginate(10);
        return view('seller.crud.index', compact('products'));
    }

    public function crud()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        return view('seller.crud.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.crud.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Product created');
    }

    public function show(Product $product)
    {

        $product->load(['reviews' => function($query) {
            $query->where('is_visible', true)->latest();
        }, 'reviews.user']);

        return view('products.show', compact('product'));
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
    