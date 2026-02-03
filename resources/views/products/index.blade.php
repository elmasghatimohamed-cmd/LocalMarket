<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 flex items-center bg-orange-50 border-l-4 border-orange-500 text-orange-700 p-4 rounded-lg shadow-sm">
                    <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @foreach($products as $product)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl flex flex-col md:flex-row border border-gray-100">
                
                <div class="md:w-1/2 bg-white p-6 flex flex-col items-center justify-center border-r border-gray-50">
                    <div class="relative group">
                        <img src="https://via.placeholder.com/600x600" alt="{{ $product->name }}" class="rounded-2xl object-cover w-full h-auto transition-transform duration-500 group-hover:scale-105">
                        <span class="absolute top-4 left-4 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">New Arrival</span>
                    </div>
                    <div class="flex mt-4 space-x-2">
                        <div class="w-20 h-20 border-2 border-orange-500 rounded-lg p-1"><img src="https://via.placeholder.com/100" class="rounded-md"></div>
                        <div class="w-20 h-20 border border-gray-200 rounded-lg p-1 opacity-60 hover:opacity-100 cursor-pointer transition"><img src="https://via.placeholder.com/100" class="rounded-md"></div>
                    </div>
                </div>

                <div class="md:w-1/2 p-8 lg:p-14">
                    <nav class="flex text-gray-400 text-sm mb-4" aria-label="Breadcrumb">
                        <span>Shop</span> <span class="mx-2">/</span> <span class="text-orange-500">Category</span>
                    </nav>

                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $product->name }}</h1>
                    
                    <div class="flex items-center mt-4">
                        <div class="flex items-center text-orange-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                        <span class="ml-3 text-sm text-gray-500 font-medium">124 Reviews</span>
                    </div>

                    <div class="mt-6 flex items-baseline">
                        <span class="text-4xl font-bold text-orange-600">${{ number_format($product->price, 2) }}</span>
                        <span class="ml-3 text-lg text-gray-400 line-through">${{ number_format($product->price * 1.2, 2) }}</span>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase">Description</h3>
                        <p class="mt-3 text-gray-600 leading-relaxed text-base">
                            {{ $product->description ?? 'This premium product is crafted with the highest quality materials. Designed for durability and style, it offers a seamless experience for modern users looking for excellence.' }}
                        </p>
                    </div>

                    <div class="mt-10 pt-8 border-t border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="flex items-center justify-center px-3 py-1 rounded-full bg-{{ $product->stock > 0 ? 'green-100' : 'red-100' }}">
                                <div class="h-2 w-2 rounded-full bg-{{ $product->stock > 0 ? 'green-500' : 'red-500' }} mr-2"></div>
                                <span class="text-xs font-bold text-{{ $product->stock > 0 ? 'green-700' : 'red-700' }}">
                                    {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ' units)' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="sm:w-32">
                                    <label class="block text-xs font-black text-gray-400 uppercase mb-2">Quantity</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-full border-gray-200 rounded-xl focus:ring-orange-500 focus:border-orange-500 p-3 font-bold text-center bg-gray-50">
                                </div>
                                <div class="flex-1 flex items-end">
                                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-extrabold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg shadow-orange-200 hover:shadow-orange-300 flex items-center justify-center active:scale-95">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        ADD TO CART
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="mt-10 bg-white rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Customer Reviews</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">JD</div>
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-900">John Doe</p>
                                <div class="flex text-orange-400 scale-75 origin-left">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm italic italic">"Amazing quality! The orange accents in the branding are beautiful. High recommended."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>