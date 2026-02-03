@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">My Cart</h1>

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

    @if($cart->items->count() > 0)
        <table class="w-full border-collapse border">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Product</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Quantity</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr class="border-b">
                    <td class="p-2">{{ $item->product->name }}</td>
                    <td class="p-2">{{ $item->product->price }} $</td>
                    <td class="p-2">{{ $item->quantity }}</td>
                    <td class="p-2">{{ $item->product->price * $item->quantity }} $</td>
                    <td class="p-2">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <p class="text-lg font-semibold">
                Total: {{ $cart->items->sum(fn($i) => $i->product->price * $i->quantity) }} $
            </p>
        </div>

    @else
        <p>Your cart is empty.</p>
    @endif

</div>
@endsection
