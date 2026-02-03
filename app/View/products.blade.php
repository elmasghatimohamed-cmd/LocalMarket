@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Products</h1>

    <div class="grid grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="border p-4 rounded shadow">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" class="mb-2 w-full h-40 object-cover" />
            <h2 class="font-semibold text-lg">{{ $product->name }}</h2>
            <p class="text-gray-600">{{ $product->price }} $</p>
            <p class="text-sm text-gray-500">Stock: {{ $product->stock }}</p>

            <form action="{{ route('cart.add') }}" method="POST" class="mt-2 flex items-center space-x-2">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded w-16 px-2 py-1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Add to Cart</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
