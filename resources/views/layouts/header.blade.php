<!-- <script src="https://cdn.tailwindcss.com"></script>
<header class="bg-white">
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-8">
            <a class="group flex items-center gap-2">
                <div class="w-10 h-10 rounded-full border-2 border-[#f3b110] flex items-center justify-center text-[#f3b110] group-hover:bg-[#f3b110] group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>

                @if (Route::has('login'))
                    @auth

                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 group-hover:text-[#f3b110]">Log In</a>

                @if (Route::has('register'))

                <a href="{{ route('register') }}" class="text-sm font-bold text-gray-700 group-hover:text-[#f3b110]">Register</a>

                @endif
                                @endauth
            </a>

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


        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif -->