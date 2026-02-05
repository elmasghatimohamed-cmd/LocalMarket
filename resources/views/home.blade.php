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

                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                {{ __('Dashboard') }}
                            </a>

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



<section class="relative bg-gray-900 overflow-hidden" 
         x-data="{ 
            activeSlide: 1, 
            slides: [
                { id: 1, title: 'Next-Gen Computing', desc: 'Experience the power of M3 chips.', tag: 'New Arrival', img: 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&q=80&w=1200' },
                { id: 2, title: 'Audio Reimagined', desc: 'Studio quality sound in your pocket.', tag: 'Trending', img: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=1200' },
                { id: 3, title: 'Smart Living', desc: 'Automate your world with AI home kits.', tag: 'Smart Home', img: 'https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&q=80&w=1200' },
                { id: 4, title: 'Gaming Unleashed', desc: '4K 120FPS gaming starts here.', tag: 'Gaming', img: 'https://images.unsplash.com/photo-1603481588273-2f908a9a7a1b?auto=format&fit=crop&q=80&w=1200' }
            ],
            loop() {
                setInterval(() => { this.activeSlide = this.activeSlide === 4 ? 1 : this.activeSlide + 1 }, 5000)
            }
         }" 
         x-init="loop()">

    <div class="relative h-[400px] md:h-[500px]">
        <template x-for="slide in slides" :key="slide.id">
            <div x-show="activeSlide === slide.id"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[5000ms] scale-110" 
                     :style="`background-image: url('${slide.img}')`"
                     :class="activeSlide === slide.id ? 'scale-100' : 'scale-110'">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>

                <div class="relative container mx-auto px-6 h-full flex flex-col justify-center">
                    <span x-text="slide.tag" class="text-[#f3b110] font-bold tracking-[0.3em] uppercase text-xs mb-4"></span>
                    <h2 x-text="slide.title" class="text-4xl md:text-6xl font-black text-white mb-4 max-w-2xl leading-tight"></h2>
                    <p x-text="slide.desc" class="text-gray-300 text-lg mb-8 max-w-lg"></p>
                    <div class="flex gap-4">
                        <button class="bg-[#f3b110] text-black font-black px-8 py-3 uppercase text-xs tracking-widest hover:bg-white transition-colors">Shop Now</button>
                        <button class="border border-white/30 text-white font-bold px-8 py-3 uppercase text-xs tracking-widest hover:bg-white/10 transition-colors">Details</button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3">
        <template x-for="i in 4">
            <button @click="activeSlide = i" 
                    class="h-1 transition-all duration-300 rounded-full"
                    :class="activeSlide === i ? 'w-12 bg-[#f3b110]' : 'w-4 bg-white/30'"></button>
        </template>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12 mb-16">
            <div class="md:w-1/2">
                <span class="text-[#f3b110] font-bold tracking-widest uppercase text-sm">Since 2024</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mt-2 mb-6">Your Neighborhood <br> Tech Revolution.</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    LocalMarket started with a simple idea: bring world-class technology to our local community. We aren't just a store; we are a hub for creators, gamers, and professionals who demand the best tools.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl">100% Original</h4>
                        <p class="text-sm text-gray-500">Authorized dealer for all major global tech brands.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl">Local Delivery</h4>
                        <p class="text-sm text-gray-500">Ultra-fast shipping directly from our local warehouse.</p>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 bg-[#f3b110]/10 rounded-full blur-2xl"></div>
                <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&q=80&w=800" 
                     alt="Tech Store Office" 
                     class="rounded-2xl shadow-2xl relative z-10">
            </div>
        </div>
    </div>
</section>



<footer class="bg-[#1a1a1a] text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-[#f3b110] flex items-center justify-center">
                        <div class="w-3 h-3 rounded-full bg-black"></div>
                    </div>
                    <span class="text-2xl font-bold tracking-tighter">Local<span class="text-[#f3b110]">Market</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    The premium destination for authentic gadgets and tech support in the heart of the city.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-[#f3b110] transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="text-gray-400 hover:text-[#f3b110] transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6">Contact Us</h4>
                <ul class="text-gray-400 text-sm space-y-4">
                    <li>123 Tech Avenue, Silicon Suite</li>
                    <li>San Francisco, CA 94107</li>
                    <li class="text-[#f3b110] font-bold">Tel: 1-800-000-0000</li>
                    <li>support@localmarket.com</li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6">Customer Service</h4>
                <ul class="text-gray-400 text-sm space-y-4 uppercase tracking-tighter">
                    <li><a href="#" class="hover:text-[#f3b110] transition-colors">Contact Us ></a></li>
                    <li><a href="#" class="hover:text-[#f3b110] transition-colors">Shipping ></a></li>
                    <li><a href="#" class="hover:text-[#f3b110] transition-colors">Returns ></a></li>
                    <li><a href="#" class="hover:text-[#f3b110] transition-colors">Payment & Warranty ></a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6">We Accept</h4>
                <div class="flex gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-6 bg-white px-1 rounded" alt="Mastercard">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-6 bg-white px-1 rounded" alt="Visa">
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-xs uppercase tracking-widest">
                © 2026 by LocalMarket. Powered by Passion.
            </p>
            <div class="flex gap-6 text-xs text-gray-500 uppercase tracking-widest">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>