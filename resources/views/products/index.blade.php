<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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
                            <p>Price: ${{ number_format($product->price, 2) }}</p>
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
        </div>
    </div>
</x-app-layout>