@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Products</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="border p-4 rounded shadow">
                <h2 class="font-semibold">{{ $product->name }}</h2>
                <p>Price: {{ $product->price }} $</p>
                <p>Stock: {{ $product->stock }}</p>

                <form action="{{ route('cart.add') }}" method="POST" class="mt-2 flex items-center space-x-2">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded w-16 px-2 py-1">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>

</div>
@endsection
