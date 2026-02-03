@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Shopping Cart</h1>
            <span class="text-gray-500 font-medium">{{ $cart->items->count() }} Items</span>
        </div>

        @if(session('success'))
            <div class="mb-6 flex items-center bg-orange-50 border-l-4 border-orange-500 text-orange-700 p-4 rounded-xl shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if($cart->items->count() > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="lg:w-2/3 space-y-4">
                    @foreach($cart->items as $item)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center justify-between transition-hover hover:shadow-md">
                            <div class="flex items-center w-full sm:w-auto">
                                <div class="h-24 w-24 bg-gray-100 rounded-xl flex-shrink-0 overflow-hidden border border-gray-50">
                                    <img src="https://via.placeholder.com/150" class="object-cover w-full h-full">
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-orange-600 font-semibold mt-1">${{ number_format($item->product->price, 2) }}</p>
                                    <p class="text-gray-400 text-xs mt-1 uppercase tracking-wider">SKU: PROD-{{ $item->product->id }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between w-full sm:w-auto mt-6 sm:mt-0 space-x-8">
                                <div class="flex flex-col items-center">
                                    <span class="text-xs font-bold text-gray-400 uppercase mb-1">Qty</span>
                                    <span class="text-lg font-bold text-gray-800 bg-gray-50 px-4 py-1 rounded-lg border border-gray-100">
                                        {{ $item->quantity }}
                                    </span>
                                </div>

                                <div class="text-right min-w-[100px]">
                                    <span class="text-xs font-bold text-gray-400 uppercase block mb-1">Total</span>
                                    <span class="text-xl font-black text-gray-900">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </span>
                                </div>

                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 sticky top-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 border-b border-gray-50 pb-6">
                            <div class="flex justify-between text-gray-600 font-medium">
                                <span>Subtotal</span>
                                <span>${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 font-medium">
                                <span>Shipping</span>
                                <span class="text-green-500 font-bold text-sm uppercase">Free</span>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between items-end">
                            <span class="text-gray-900 font-bold text-lg">Total Amount</span>
                            <span class="text-3xl font-black text-orange-600">
                                ${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}
                            </span>
                        </div>

                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-extrabold py-4 px-8 rounded-2xl mt-8 transition-all shadow-lg shadow-orange-100 hover:shadow-orange-200 active:scale-95 flex items-center justify-center">
                            CHECKOUT NOW
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>

                        <div class="mt-6 flex items-center justify-center space-x-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4 opacity-30">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6 opacity-30">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4 opacity-30">
                        </div>
                    </div>
                </div>

            </div>

        @else
            <div class="bg-white rounded-3xl p-20 text-center border border-dashed border-gray-200 shadow-sm">
                <div class="bg-orange-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Your cart is empty</h2>
                <p class="text-gray-500 mt-2 max-w-xs mx-auto">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-8 text-orange-500 font-bold border-b-2 border-orange-500 hover:text-orange-600 hover:border-orange-600 transition-colors">
                    Back to Shop
                </a>
            </div>
        @endif

    </div>
</div>
@endsection