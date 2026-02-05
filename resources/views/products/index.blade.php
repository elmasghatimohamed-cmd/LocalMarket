<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>




<header class="bg-white" x-data="{ openProfile: false }">
    <div class="container mx-auto px-4 py-6 flex flex-wrap items-center justify-between gap-6">

        <div class="flex items-center gap-3">
            <div class="relative w-12 h-12 bg-black flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 border-[6px] border-[#f3b110] rotate-45"></div>
                <div class="w-4 h-4 rounded-full bg-white z-10"></div>
            </div>
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Local<span class="text-[#f3b110]">Market</span></h1>
                <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] font-medium -mt-1">A Perfect Tech Store</p>
            </div>
        </div>

        <div class="flex-1 max-w-md hidden md:block">
            <div class="relative">
                <input type="text" placeholder="Search for products..."
                    class="w-full bg-gray-50 border border-gray-100 rounded-full py-2.5 px-6 focus:outline-none focus:ring-2 focus:ring-[#f3b110] transition-all">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#f3b110]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        

        <!-- <div class="flex items-center gap-8">

            <a class="group flex items-center gap-2">
                <div class="w-10 h-10 rounded-full border-2 border-[#f3b110] flex items-center justify-center text-[#f3b110] group-hover:bg-[#f3b110] group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>

                @if (Route::has('login'))
                @auth



                <a href="{{ url('/products') }}" class="text-sm font-bold text-gray-700 group-hover:text-[#f3b110]">{{ Auth::user()->name }}
                </a>

                @else

                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 group-hover:text-[#f3b110]">Log In</a>



                @if (Route::has('register'))

                <a href="{{ route('register') }}" class="text-sm font-bold text-gray-700 group-hover:text-[#f3b110]">Register</a>

                @endif
                @endauth
            </a>

            @endif

            <a href="#" class="relative group">
                <div class="bg-[#f3b110] p-3 rounded-lg shadow-sm group-hover:shadow-md transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="absolute -top-2 -right-2 bg-black text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white">
                    1
                </span>
            </a>
        </div> -->

        <div class="flex items-center gap-8">
            @if (Route::has('login'))
                @auth
                    <div class="relative">
                        <button @click="openProfile = ! openProfile" class="group flex items-center gap-2 focus:outline-none">
                            <div class="w-10 h-10 rounded-full border-2 border-[#f3b110] flex items-center justify-center overflow-hidden transition-all group-hover:bg-[#f3b110]">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="size-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @else
                                    <svg class="w-5 h-5 text-[#f3b110] group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" /></svg>
                                @endif
                            </div>
                            <div class="text-left hidden sm:block">
                                <span class="text-xs block font-bold text-gray-700 leading-none">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-gray-400">Account Settings</span>
                            </div>
                        </button>

                        <div x-show="openProfile" 
                             @click.away="openProfile = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             class="absolute right-0 mt-3 w-48 bg-white border border-gray-100 shadow-xl rounded-xl py-2 z-50">
                            
                            <div class="block px-4 py-2 text-xs text-gray-400 uppercase tracking-widest font-bold">Manage Account</div>
                            
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#f3b110] transition-colors">
                                {{ __('Your Profile') }}
                            </a>

                            <!-- <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                {{ __('Dashboard') }}
                            </a> -->

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" @click.prevent="$root.submit();" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-bold">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-[#f3b110]">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-black text-white text-xs px-5 py-2 rounded-full font-bold hover:bg-[#f3b110] transition-all">Register</a>
                        @endif
                    </div>
                @endauth
            @endif

            <a href="{{ route('cart.index') }}" class="relative group">
                <div class="bg-[#f3b110] p-3 rounded-lg shadow-sm group-hover:shadow-md transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="absolute -top-2 -right-2 bg-black text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white">
                    0
                </span>
            </a>
        </div>
    </div>

    <nav class="bg-[#1a1a1a]">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <ul class="flex">
                <li><a href="#" class="inline-block py-4 px-6 text-gray-400 hover:text-white hover:bg-white/5 transition-all text-sm font-medium border-b-2 border-transparent hover:border-[#f3b110]">Home</a></li>
                <li><a href="#" class="inline-block py-4 px-6 text-white bg-white/5 text-sm font-medium border-b-2 border-[#f3b110]">Shop</a></li>
                <li><a href="#" class="inline-block py-4 px-6 text-gray-400 hover:text-white hover:bg-white/5 transition-all text-sm font-medium border-b-2 border-transparent hover:border-[#f3b110]">FAQ</a></li>
                <li><a href="#" class="inline-block py-4 px-6 text-gray-400 hover:text-white hover:bg-white/5 transition-all text-sm font-medium border-b-2 border-transparent hover:border-[#f3b110]">Contact Us</a></li>
            </ul>

            <div class="hidden lg:flex items-center gap-2 text-white/60 text-sm italic">
                <span>Call Us:</span>
                <span class="text-white font-bold not-italic tracking-wider">1-800-000-0000</span>
            </div>
        </div>
    </nav>
</header>




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
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="text-gray-400 text-xl font-medium">No products available in the collection yet.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-20 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
</div>