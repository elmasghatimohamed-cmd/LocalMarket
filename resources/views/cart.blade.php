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
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b text-gray-700">
                                <th class="p-3 text-left">Product</th>
                                <th class="p-3 text-center">Price</th>
                                <th class="p-3 text-center">Quantity</th>
                                <th class="p-3 text-center">Total</th>
                                <th class="p-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="p-3 font-medium">{{ $item->product->name }}</td>
                                    <td class="p-3 text-center">${{ number_format($item->product->price, 2) }}</td>
                                    <td class="p-3 text-center">{{ $item->quantity }}</td>
                                    <td class="p-3 text-center font-semibold">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </td>
                                    <td class="p-3 text-right">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-600 text-white px-3 py-1 rounded-md text-sm hover:bg-red-700 transition">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-end">
                        <div class="text-right">
                            <span class="text-gray-600 uppercase text-sm tracking-wide">Grand Total</span>
                            <p class="text-3xl font-bold text-gray-900">
                                ${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}
                            </p>
                        </div>
                    </div>

                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 text-lg">Your cart is empty.</p>
                        <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800">
                            Continue Shopping &rarr;
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>