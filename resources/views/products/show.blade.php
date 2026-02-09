<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    protech: '#DFFF00',
                    darkBg: '#080808',
                    cardBg: '#111111',
                },
                fontFamily: {
                    tech: ['Orbitron', 'sans-serif'],
                    sans: ['Plus Jakarta Sans', 'sans-serif'],
                }
            }
        }
    }
</script>

<style>
    body { background-color: #080808; color: white; }
</style>

@include('navigation-menu')

<div class="bg-[#080808] min-h-screen text-white font-sans">
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        
        <nav class="flex text-xs uppercase tracking-widest text-gray-500 mb-8 space-x-2">
            <a href="/" class="hover:text-white transition">Home</a>
            <span>•</span>
            <a href="{{ route('products.index') }}" class="hover:text-white transition">Products</a>
            <span>•</span>
            <span class="text-gray-300">{{ $product->category->name ?? 'Bose' }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-24 items-start">
            
            <div class="w-full lg:w-3/5">
                <div class="relative bg-[#111] rounded-[2.5rem] p-8 mb-6 border border-white/5 flex justify-center items-center shadow-2xl">
                    <span class="absolute top-8 left-8 bg-[#DFFF00] text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">
                        Bestseller
                    </span>
                    
                    <button class="absolute top-8 right-8 bg-white/5 p-3 rounded-full hover:bg-white/10 transition border border-white/10">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </button>

                    <img src="{{ $product->image_url }}" class="w-full max-w-md h-auto object-contain transform hover:scale-105 transition duration-700">
                </div>

                <div class="flex gap-4">
                    <div class="w-20 h-20 bg-[#111] border-2 border-[#DFFF00] rounded-2xl p-2 cursor-pointer transition">
                        <img src="{{ $product->image_url }}" class="w-full h-full object-contain">
                    </div>
                    </div>
            </div>

            <div class="w-full lg:w-2/5">
                <span class="text-gray-500 text-sm uppercase tracking-[0.2em] mb-2 block">{{ $product->brand ?? 'Bose' }}</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tighter leading-tight uppercase font-[Orbitron]">
                    {{ $product->name }}
                </h1>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex items-center gap-1 text-[#DFFF00]">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-white font-bold text-sm tracking-widest">4.2</span>
                    </div>
                    <span class="text-gray-500 text-sm border-b border-gray-700 pb-0.5 tracking-widest">{{ number_format($product->reviews->count() ?? 12384) }} REVIEWS</span>
                </div>

                <p class="text-gray-400 text-sm leading-relaxed mb-8 uppercase tracking-wide">
                    {{ $product->description }}
                </p>

                <div class="text-4xl font-bold mb-10 tracking-tighter font-[Orbitron]">
                    ${{ number_format($product->price, 2) }}
                </div>

                <div class="mb-12">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-[0.3em] mb-4">Key features</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start gap-3">
                            <span class="text-[#DFFF00] mt-1.5">•</span>
                            <span>Sound quality: World-class noise cancelling and spatialised audio</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-[#DFFF00] mt-1.5">•</span>
                            <span>Battery: Up to 6-hours or 24 hours total with case</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @role('client')
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-[0.2em] mb-3">Quantity</label>
                            <div class="flex items-center bg-[#111] border border-white/10 rounded-full p-2 w-32">
                                <button type="button" onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center text-white hover:text-protech transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="flex-1 bg-transparent text-center text-white font-bold outline-none">
                                <button type="button" onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center text-white hover:text-protech transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>

                        
                        <button type="submit" class="w-full bg-protech hover:bg-white text-black font-bold py-5 rounded-full transition-all flex items-center justify-center gap-3 uppercase tracking-[0.1em] text-sm shadow-[0_10px_30px_rgba(223,255,0,0.15)]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Add to cart
                        </button>
                        
                    </form>
                    
                    <button class="w-full bg-white/5 hover:bg-white/10 text-white font-bold py-5 rounded-full border border-white/10 transition-all flex items-center justify-center uppercase tracking-[0.1em] text-sm">
                        Buy Now
                    </button>
                    @endrole
                </div>
                
                <script>
                    function increaseQty() {
                        const input = document.getElementById('quantity');
                        const max = parseInt(input.getAttribute('max'));
                        if (parseInt(input.value) < max) {
                            input.value = parseInt(input.value) + 1;
                        }
                    }
                    
                    function decreaseQty() {
                        const input = document.getElementById('quantity');
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    }
                </script>
            </div>
        </div>

        <div class="mt-32 max-w-4xl border-t border-white/5 pt-16">
            <h3 class="text-2xl font-bold mb-12 tracking-tighter uppercase font-[Orbitron]">Customer Feedback</h3>

            @auth
            @role('client')
            <form action="{{ route('products.review', $product) }}" method="POST" class="mb-16 bg-[#111] p-8 rounded-[2rem] border border-white/5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-[0.2em]">Rating</label>
                        <select name="rating" class="w-full bg-[#080808] border border-white/10 rounded-xl p-4 text-[#DFFF00] font-bold focus:border-[#DFFF00] outline-none appearance-none">
                            <option value="5">⭐⭐⭐⭐⭐ MASTERPIECE</option>
                            <option value="4">⭐⭐⭐⭐ EXCELLENT</option>
                            </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-gray-500 mb-3 uppercase tracking-[0.2em]">Your Transmission</label>
                    <textarea name="comment" class="w-full bg-[#080808] border border-white/10 rounded-2xl p-5 text-white focus:border-[#DFFF00] outline-none transition" placeholder="ENTER YOUR REVIEW DATA..." rows="4"></textarea>
                </div>
                <button type="submit" class="bg-white text-black px-10 py-4 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-[#DFFF00] transition-colors">Publish Review</button>
            </form>
            @endrole
            @endauth
            
            <div class="space-y-12">
                @forelse($product->reviews as $review)
                    <div class="flex gap-6 items-start border-b border-white/5 pb-12">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex-shrink-0 flex items-center justify-center font-bold text-[#DFFF00] font-[Orbitron]">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-3">
                                <span class="font-bold text-lg tracking-tight uppercase">{{ $review->user->name }}</span>
                                <div class="flex gap-1 text-[#DFFF00] text-xs">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $review->comment }}</p>
                            <span class="text-[10px] text-gray-600 uppercase tracking-widest font-mono italic">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-600 italic tracking-widest text-sm uppercase">No log entries found for this hardware unit.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>