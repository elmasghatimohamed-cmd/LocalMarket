<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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
                            <td class="p-2">${{ number_format($item->product->price, 2) }}</td>
                            <td class="p-2">{{ $item->quantity }}</td>
                            <td class="p-2">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td class="p-2">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    <p class="text-lg font-semibold">
                        Total: ${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}
                    </p>
                </div>

                @else
                <p>Your cart is empty</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>