<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-white min-h-screen">
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <div class="flex flex-col md:flex-row gap-16 items-center">
            
            <div class="w-full md:w-1/2">
                <div class="rounded-2xl overflow-hidden mb-4 shadow-sm">
                    <img src="{{ $product->image_url }}" class="w-full h-auto object-cover aspect-square">
                </div>
                <div class="flex gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-orange-500 cursor-pointer">
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                    </div>
                    </div>
            </div>

            <div class="w-full md:w-1/2">
                <span class="text-orange-500 font-bold tracking-widest uppercase text-sm mb-4 block">LocalMart Exclusive</span>
                <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">{{ $product->name }}</h1>
                
                <p class="text-gray-500 text-lg mb-8 leading-relaxed">
                    {{ $product->description }}
                </p>

                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-2">
                        <span class="text-3xl font-bold text-gray-900">${{ $product->price }}</span>
                        <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded-md font-bold text-sm">50% Off</span>
                    </div>
                    <span class="text-gray-400 line-through font-medium text-lg">$250.00</span>
                    
                    <div class="mt-4 flex items-center gap-2">
                         <span class="w-3 h-3 rounded-full {{ $product->stock > 5 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                         <p class="text-sm font-semibold text-gray-600">Stock: {{ $product->stock }} pieces available</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <button class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-xl shadow-lg shadow-orange-200 transition-all flex items-center justify-center gap-3">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        Add to cart
                    </button>
                    
                    <form action="{{ route('products.like', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-4 border-2 border-gray-100 rounded-xl hover:bg-red-50 hover:border-red-100 transition group">
                            <svg class="w-6 h-6 {{ auth()->user() && $product->isLikedByUser() ? 'text-red-500 fill-current' : 'text-gray-300 group-hover:text-red-400' }}" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-24 max-w-3xl">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Customer Reviews ({{ $product->reviews->count() }})</h3>

            @auth
            <form action="{{ route('products.review', $product) }}" method="POST" class="mb-12 bg-gray-50 p-8 rounded-2xl border border-gray-100">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Rating</label>
                    <select name="rating" class="w-full bg-white border-none rounded-xl p-3 shadow-sm text-orange-500 font-bold focus:ring-2 focus:ring-orange-500">
                        <option value="5">⭐⭐⭐⭐⭐ Special</option>
                        <option value="4">⭐⭐⭐⭐ Very Good</option>
                        <option value="3">⭐⭐⭐ Good</option>
                        <option value="2">⭐⭐ Not Bad</option>
                        <option value="1">⭐ Bad</option>
                    </select>
                </div>
                <div class="mb-6">
                    <textarea name="comment" class="w-full bg-white border-none rounded-xl p-4 shadow-sm focus:ring-2 focus:ring-orange-500" placeholder="Write your opinion here..." rows="3"></textarea>
                </div>
                <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-orange-500 transition-all shadow-md">Publish Review</button>
            </form>
            @endauth

            <div class="space-y-8">
                @forelse($product->reviews as $review)
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center font-bold text-gray-500">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="font-bold text-gray-900">{{ $review->user->name }}</span>
                                <span class="text-orange-400 text-xs">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </span>
                            </div>
                            <p class="text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                            <span class="text-xs text-gray-400 mt-2 block">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 italic">No reviews yet for this product.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>