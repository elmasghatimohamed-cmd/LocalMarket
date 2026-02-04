<script src="https://cdn.tailwindcss.com"></script>








<div class="bg-gray-50 min-h-screen">
    <header class="bg-white border-b border-gray-100 py-12 mb-12">
        <div class="container mx-auto px-4 text-center">
            <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-2 block">LocalMart Collection</span>
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Discover Local Products</h1>
            <p class="text-gray-500 max-w-xl mx-auto">High quality products from your local sellers, delivered with care to your doorstep.</p>
        </div>
    </header>

    <div class="container mx-auto px-4 pb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="group bg-white transition-all duration-300 flex flex-col items-center text-center p-6 border border-transparent hover:border-gray-100 hover:shadow-xl relative overflow-hidden">
                    
                    <div class="relative w-full aspect-square mb-6 overflow-hidden flex items-center justify-center bg-[#f9f9f9]">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="max-w-[85%] max-h-[85%] object-contain transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 flex items-end justify-center pb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('products.show', $product) }}" class="text-[11px] uppercase tracking-widest font-bold text-gray-800 bg-white/95 px-5 py-2.5 shadow-md hover:bg-black hover:text-white transition-all">
                                Quick View
                            </a>
                        </div>

                        @if($product->stock <= 0)
                            <span class="absolute top-0 left-0 bg-black text-white text-[10px] px-3 py-1.5 uppercase font-bold">Sold Out</span>
                        @elseif($product->stock <= 5)
                            <span class="absolute top-0 left-0 bg-red-600 text-white text-[10px] px-3 py-1.5 uppercase font-bold tracking-tighter">Low Stock</span>
                        @endif
                    </div>

                    <div class="w-full">
                        <div class="flex flex-col items-center gap-1 mb-3">
                            <span class="text-gray-400 text-[10px] uppercase tracking-[0.2em] font-medium">
                                {{ $product->category->name ?? "I'm a Product" }}
                            </span>
                            <h2 class="text-gray-900 text-lg font-medium leading-tight truncate w-full px-2">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                            </h2>
                        </div>
                        
                        <div class="flex flex-col items-center gap-2 mb-6">
                            <div class="flex items-center gap-1">
                                @php $rating = round($product->reviews_avg_rating ?? 5); @endphp
                                <span class="text-orange-400 text-xs">
                                    {{ str_repeat('★', $rating) }}{{ str_repeat('☆', 5 - $rating) }}
                                </span>
                            </div>
                            <span class="text-gray-900 font-light text-xl tracking-tight">${{ number_format($product->price, 2) }}</span>
                        </div>

                        <div class="mt-auto">
                            <button class="w-full bg-[#f3b110] hover:bg-black hover:text-white text-black text-[12px] font-black py-4 transition-all duration-300 uppercase tracking-widest">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-32 bg-white rounded-3xl border-2 border-dashed border-gray-100">
                    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <p class="text-gray-400 text-xl font-medium">No products available in the collection yet.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
</div>