<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
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
    .custom-shadow { shadow-[0_0_20px_rgba(223,255,0,0.1)]; }
    nav[role="navigation"] p { display: none; }
</style>

@include('navigation-menu')

<div class="min-h-screen bg-darkBg text-white font-sans">

    <div class="container mx-auto px-6 pt-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <nav class="text-xs text-white/40 mb-4 flex gap-2">
                    <a href="#">Home</a> <span>•</span> <a href="#" class="text-white/80">Best sellers</a>
                </nav>
                <h1 class="text-5xl font-tech tracking-tight uppercase">Best sellers</h1>
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
        <form id="filterForm" class="w-64 hidden lg:block space-y-10">
            <div>
                <a href="{{ route('products.index') }}" class="text-white/60 text-sm flex items-center gap-2 mb-6 hover:text-white">
                    <span class="text-xl">×</span> Reset filters
                </a>
                <div id="activeFilters" class="flex flex-wrap gap-2">
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <button type="button" onclick="toggleDropdown('priceDropdown')" class="flex items-center justify-between border-b border-white/10 pb-4 w-full">
                        <span class="font-bold uppercase tracking-widest text-xs">Price</span>
                        <svg id="priceArrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="priceDropdown" class="hidden mt-4 space-y-3 px-1">
                        <div class="space-y-3">
                            <div>
                                <label class="text-[10px] text-white/50 uppercase tracking-wider mb-1 block">Min Price</label>
                                <input type="number" name="min_price" id="minPrice" placeholder="$0" value="{{ request('min_price') }}" class="w-full bg-darkBg border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-protech focus:outline-none transition">
                            </div>
                            <div>
                                <label class="text-[10px] text-white/50 uppercase tracking-wider mb-1 block">Max Price</label>
                                <input type="number" name="max_price" id="maxPrice" placeholder="$1000" value="{{ request('max_price') }}" class="w-full bg-darkBg border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-protech focus:outline-none transition">
                            </div>
                            <button type="button" onclick="applyFilters()" class="w-full bg-protech hover:bg-white text-black font-bold py-2 px-4 rounded-lg text-xs uppercase tracking-wider transition-all">
                                Apply
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" onclick="toggleDropdown('categoryDropdown')" class="flex items-center justify-between border-b border-white/10 pb-4 w-full">
                        <span class="font-bold uppercase tracking-widest text-xs">Categories</span>
                        <svg id="categoryArrow" class="w-4 h-4 transition-transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="categoryDropdown" class="mt-4 space-y-3 px-1">
                        @foreach($categories as $category)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="category-filter w-5 h-5 accent-protech rounded" onchange="applyFilters()" @if(in_array($category->id, (array)request('categories', []))) checked @endif>
                            <span class="text-sm text-white/60 group-hover:text-white transition-colors">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>

        <script>
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    const arrow = document.getElementById(id.replace('Dropdown', 'Arrow'));
    
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        dropdown.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}

function applyFilters() {
    const filterForm = document.getElementById('filterForm');
    const formData = new FormData(filterForm);
    const params = new URLSearchParams(formData);
    
    window.location.href = '{{ route("products.index") }}?' + params.toString();
}
</script>

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

                    <div class="relative w-full h-48 mb-8 p-4 bg-white/5 rounded-2xl">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover rounded-xl transition-transform duration-700 group-hover:scale-110">
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
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-[10px] text-white/50 uppercase tracking-wider">Stock:</span>
                                <span class="text-[11px] font-bold text-protech bg-protech/10 px-2 py-1 rounded-full border border-protech/20">{{ $product->stock }} units</span>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                
                                @role('client')
                                <button type="submit" class="w-full bg-protech hover:bg-white text-black font-bold py-3 px-4 rounded-full transition-all duration-300 flex items-center justify-center gap-2 group">
                                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    ADD TO CART
                                </button>
                                @endrole
                            </form>
                            
                            <a href="{{ route('products.show', $product) }}" class="w-full bg-white/5 hover:bg-white/10 text-white font-bold py-3 px-4 rounded-full transition-all duration-300 flex items-center justify-center gap-2 group border border-white/10 hover:border-white/20">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                VIEW PRODUCT
                            </a>
                        </div>
                    </div>
                </div>
                @empty

                <div class="col-span-full py-40 text-center opacity-20">
                    <p class="font-tech text-2xl uppercase tracking-[0.5em]">No products found</p>
                </div>
                @endforelse
            </div>
            
            <div class="flex justify-center mt-12">
                {{$products->onEachSide(1)->links()}}
            </div>
        </div>
    
</div>
