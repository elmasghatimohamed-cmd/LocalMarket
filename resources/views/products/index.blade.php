<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
    .custom-shadow { shadow-[0_0_20px_rgba(223,255,0,0.1)]; }
</style>

@include('navigation-menu')

<div class="min-h-screen bg-darkBg text-white font-sans">

    <div class="container mx-auto px-6 pt-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <nav class="text-xs text-white/40 mb-4 flex gap-2">
                    <a href="#">Home</a> <span>•</span> <a href="#" class="text-white/80">Bestsellers</a>
                </nav>
                <h1 class="text-5xl font-tech tracking-tight uppercase">Bestsellers</h1>
            </div>
            
            <div class="flex gap-4">
                <div class="flex bg-white/5 p-1 rounded-full border border-white/10">
                    <button class="px-6 py-2 rounded-full bg-protech text-black font-bold text-sm">All items</button>
                    <button class="px-6 py-2 rounded-full text-white/60 text-sm hover:text-white">Smartphones</button>
                    <button class="px-6 py-2 rounded-full text-white/60 text-sm hover:text-white">Kitchen</button>
                </div>
                <button class="flex items-center gap-2 bg-white/5 border border-white/10 px-6 py-2 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4h18M6 12h12m-7 8h2"></path></svg>
                    Top rated
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 flex gap-10 pb-20">
        <aside class="w-64 hidden lg:block space-y-10">
            <div>
                <button class="text-white/60 text-sm flex items-center gap-2 mb-6 hover:text-white">
                    <span class="text-xl">×</span> Reset filters
                </button>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-white/10 px-3 py-1 rounded-full text-xs flex items-center gap-2 border border-white/10">Apple <button>×</button></span>
                    <span class="bg-white/10 px-3 py-1 rounded-full text-xs flex items-center gap-2 border border-white/10">SMEG <button>×</button></span>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <span class="font-bold uppercase tracking-widest text-xs">Price</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <span class="font-bold uppercase tracking-widest text-xs">Brand</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 15l7-7 7 7"></path></svg>
                    </div>
                    <div class="space-y-3 px-1">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" checked class="w-5 h-5 accent-protech rounded">
                            <span class="text-sm text-white/80 group-hover:text-white transition-colors">Apple</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-5 h-5 accent-protech rounded">
                            <span class="text-sm text-white/60 group-hover:text-white transition-colors">Samsung</span>
                        </label>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="group bg-cardBg rounded-[32px] p-6 border border-white/5 hover:border-protech/50 transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-6 left-6 z-10">
                        <span class="bg-protech text-black text-[10px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-tighter">Sale 15%</span>
                    </div>
                    
                    <button class="absolute top-6 right-6 z-10 w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/20 transition-all text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>

                    <div class="relative aspect-square mb-8 p-4">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110">
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-white/40 text-[10px] font-bold uppercase tracking-widest">
                            <span>{{ $product->brand ?? 'SMEG' }}</span>
                            <div class="flex items-center gap-1">
                                <span class="text-protech text-sm">★</span>
                                <span class="text-white">{{ number_format($product->reviews_avg_rating ?? 5.0, 1) }}</span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex items-baseline gap-3 mb-1">
                                <span class="text-2xl font-tech">${{ number_format($product->price, 2) }}</span>
                                <span class="text-white/20 line-through text-sm font-tech">${{ number_format($product->price * 1.2, 2) }}</span>
                            </div>
                            <h3 class="text-white/70 font-medium group-hover:text-white transition-colors leading-tight truncate">
                                {{ $product->name }}
                            </h3>
                            <p class="text-[10px] text-white/30 uppercase mt-1">{{ $product->category->name ?? 'Home Appliances' }}</p>
                        </div>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-protech hover:bg-white text-black font-bold py-3 px-4 rounded-full transition-all duration-300 flex items-center justify-center gap-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                ADD TO CART
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-40 text-center opacity-20">
                    <p class="font-tech text-2xl uppercase tracking-[0.5em]">No products found</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>