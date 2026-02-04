<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller CRUD') }}
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

                <div class="grid grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <div class="border p-4 rounded shadow">
                            <h2 class="font-semibold">{{ $product->name }}</h2>
                            <p>Price: ${{ number_format($product->price, 2) }}</p>
                            <p>Stock: {{ $product->stock }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>