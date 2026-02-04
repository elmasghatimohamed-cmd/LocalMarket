<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function crud()
    {
        $products = Product::where('seller_id', Auth::id())->get();
        return view('seller.crud', compact('products'));
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

        return redirect()->route('seller.crud.crud')->with('success', 'Product created');
    }

    public function show(Product $product)
    {
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
    