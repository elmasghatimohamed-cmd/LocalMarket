<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by categories
        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        // Sort by rating if requested
        if ($request->has('sort') && $request->sort == 'rating') {
            $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function sellerProduct(){
        $products = Product::where('seller_id', Auth::id())->paginate(12);
        return view('seller.crud.index', compact('products'));
    }

    public function crud()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        return view('seller.crud.index', compact('products'));
    }

    public function showHomeProducts(){
        $products = Product::take(6)->get();
        return view('home', compact('products'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('myproducts')->with('success', 'Product created');
    }

    public function show(Product $product)
    {

        $product->load(['reviews' => function($query) {
            $query->where('is_visible', true)->latest();
        }, 'reviews.user']);

        return view('products.show', compact('product'));
    }

    public function edit($id){
        $product = Product::with('category')->where('id', $id)->where('seller_id', Auth::id())->firstOrFail();
        $categories = Category::all();
        return view('seller.crud.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('myproducts')->with('success', 'Product updated');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('seller_id', Auth::id())
            ->firstOrFail();

        $product->delete();

        return back()->with('success', 'Product deleted');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated');
    }
}