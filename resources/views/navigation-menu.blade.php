<nav x-data="{ open: false }" class="border-b border-white/5 bg-[#080808]/90 backdrop-blur-md sticky top-0 z-50">
    <div class="container mx-auto px-6 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-8">
            <a href="/" class="font-bold text-xl tracking-tighter text-white uppercase font-[Orbitron]">
                Protech<span class="text-[#DFFF00]">.</span>
            </a>

            <a href="{{ route('products.index') }}" 
               class="bg-[#DFFF00] hover:bg-[#e6ff33] text-black px-6 py-2.5 rounded-full flex items-center gap-2 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span class="text-[11px] font-black uppercase tracking-widest">Catalog</span>
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-[10px] font-bold uppercase tracking-[0.2em]">
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="text-[10px] font-bold uppercase tracking-[0.2em]">
                {{ __('Products') }}
            </x-nav-link>

            @role('seller')
            <x-nav-link href="{{ route('seller.crud.index') }}" :active="request()->routeIs('seller.crud.index')" class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#DFFF00]">
                {{ __('My Products') }}
            </x-nav-link>
            @endrole
        </nav>

        <div class="flex items-center gap-6 text-white/80">
            
            <a href="{{ route('cart.index') }}" class="relative group p-2 transition-colors hover:text-[#DFFF00]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="absolute top-1 right-0 bg-[#DFFF00] text-black text-[9px] font-bold px-1.5 rounded-full min-w-[18px] text-center shadow-lg">
                    {{ $cartNav->items->sum('quantity') }}
                </span>
            </a>

            <div class="relative flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-white/10 rounded-full focus:border-[#DFFF00] transition p-0.5">
                                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <button class="hover:text-[#DFFF00] transition-colors flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-[11px] font-bold uppercase tracking-widest hidden lg:inline">{{ Auth::user()->name }}</span>
                            </button>
                        @endif
                    </x-slot>
                    <x-slot name="content">
                        <div class="bg-[#080808] border border-white/10 py-1 shadow-2xl">
                            <div class="block px-4 py-2 text-[9px] text-gray-500 uppercase font-black tracking-widest">{{ __('Account Security') }}</div>
                            <x-dropdown-link href="{{ route('profile.show') }}" class="text-white hover:bg-[#DFFF00] hover:text-black"> {{ __('Profile') }} </x-dropdown-link>
                            <div class="border-t border-white/5"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-red-500 hover:bg-red-500 hover:text-white">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <button @click="open = ! open" class="md:hidden text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-[#080808] border-t border-white/5 px-6 py-6">
        <div class="space-y-4">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-gray-300"> Dashboard </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="text-[#DFFF00]"> Catalog </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')" class="text-gray-300"> Cart </x-responsive-nav-link>
            @role('seller')
                <x-responsive-nav-link href="{{ route('seller.crud.index') }}" :active="request()->routeIs('seller.crud.index')" class="text-gray-300"> My Products </x-responsive-nav-link>
            @endrole
        </div>
    </div>
</nav>