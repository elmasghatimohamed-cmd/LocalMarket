<nav x-data="{ open: false }" class="border-b border-white/5 bg-[#080808]/90 backdrop-blur-md sticky top-0 z-50">
    <div class="container mx-auto px-6 h-20 flex items-center justify-between">

        <div class="flex items-center gap-8">
            <a href="/" class="font-bold text-xl tracking-tighter text-white uppercase font-[Orbitron]">
                Protech<span class="text-[#DFFF00]">.</span>
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                class="text-[10px] font-bold uppercase tracking-[0.2em]">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')"
                class="text-[10px] font-bold uppercase tracking-[0.2em]">
                {{ __('Products') }}
            </x-nav-link>

            @role('seller')
            <x-nav-link href="{{ route('seller.crud.index') }}" :active="request()->routeIs('seller.crud.index')"
                class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#DFFF00]">
                {{ __('My Products') }}
            </x-nav-link>
            @endrole
            @role('client')
            <x-nav-link href="{{ route('orders.index') }}" :active="request()->routeIs('seller.crud.index')"

                class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#DFFF00]">
                {{ __('My Orders') }}
            </x-nav-link>
            @endrole
        </nav>

        <div class="flex items-center gap-6 text-white/80">
            @role('client')
            <a href="{{ route('cart.index') }}" class="relative group p-2 transition-colors hover:text-[#DFFF00]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span
                    class="absolute top-1 right-0 bg-[#DFFF00] text-black text-[9px] font-bold px-1.5 rounded-full min-w-[18px] text-center shadow-lg">
                    {{ $cartNav?->items->count() ?? 0 }}
                </span>
            </a>
            @endrole

            <div class="relative flex items-center">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button
                            class="relative p-2 text-white/80 hover:text-[#DFFF00] transition-colors focus:outline-none group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#DFFF00] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#DFFF00]"></span>
                            </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-[#080808] border border-white/10 shadow-2xl min-w-[280px]">
                            <div class="px-4 py-3 border-b border-white/5 bg-white/[0.02]">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-[0.2em] text-[#DFFF00]">Notifications</span>
                                    <span
                                        class="text-[9px] px-2 py-0.5 bg-white/5 text-white/40 rounded uppercase font-bold">3
                                        New</span>
                                </div>
                            </div>

                            <div class="max-h-80 overflow-y-auto">
                                <a href="#"
                                    class="block px-4 py-4 border-b border-white/5 hover:bg-white/[0.03] transition group">
                                    <div class="flex gap-3">
                                        <div class="w-2 h-2 mt-1.5 rounded-full bg-[#DFFF00] shadow-[0_0_8px_#DFFF00]">
                                        </div>
                                        <div>
                                            <p
                                                class="text-[11px] text-white font-bold leading-tight uppercase tracking-tight group-hover:text-[#DFFF00]">
                                                Order #8492 Confirmed</p>
                                            <p class="text-[10px] text-white/40 mt-1">Your payment has been successfully
                                                processed.
                                            </p>
                                            <p
                                                class="text-[9px] text-[#DFFF00]/50 font-bold uppercase mt-2 tracking-tighter">
                                                2 mins
                                                ago</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#"
                                    class="block px-4 py-4 border-b border-white/5 hover:bg-white/[0.03] transition group">
                                    <div class="flex gap-3">
                                        <div class="w-2 h-2 mt-1.5 rounded-full bg-white/10"></div>
                                        <div>
                                            <p
                                                class="text-[11px] text-white/80 font-bold leading-tight uppercase tracking-tight group-hover:text-white">
                                                Security Alert</p>
                                            <p class="text-[10px] text-white/40 mt-1">New login detected from Nador,
                                                Morocco.</p>
                                            <p
                                                class="text-[9px] text-white/20 font-bold uppercase mt-2 tracking-tighter">
                                                1 hour ago
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="block px-4 py-4 hover:bg-white/[0.03] transition group">
                                    <div class="flex gap-3">
                                        <div class="w-2 h-2 mt-1.5 rounded-full bg-white/10"></div>
                                        <div>
                                            <p
                                                class="text-[11px] text-white/80 font-bold leading-tight uppercase tracking-tight group-hover:text-white">
                                                Inventory Update</p>
                                            <p class="text-[10px] text-white/40 mt-1">Product "Cyber X1" is almost out
                                                of stock.</p>
                                            <p
                                                class="text-[9px] text-white/20 font-bold uppercase mt-2 tracking-tighter">
                                                5 hours
                                                ago</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <a href="#"
                                class="block py-3 text-center bg-white/[0.02] border-t border-white/5 text-[9px] font-black uppercase tracking-[0.2em] text-white/40 hover:text-[#DFFF00] hover:bg-white/[0.05] transition">
                                View all system logs
                            </a>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            @auth
                <div class="relative flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-white/10 rounded-full focus:border-[#DFFF00] transition p-0.5">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="hover:text-[#DFFF00] transition-colors flex items-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span
                                        class="text-[11px] font-bold uppercase tracking-widest hidden lg:inline">{{ Auth::user()->name }}</span>
                                </button>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <div class="bg-[#080808] border border-white/10 py-1 shadow-2xl">
                                <div class="block px-4 py-2 text-[9px] text-gray-500 uppercase font-black tracking-widest">
                                    {{ __('Account Security') }}
                                </div>
                                <x-dropdown-link href="{{ route('profile.show') }}"
                                    class="text-white hover:bg-[#DFFF00] hover:text-black"> {{ __('Profile') }}
                                </x-dropdown-link>
                                <div class="border-t border-white/5"></div>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                    @csrf
                                    <x-dropdown-link href="#"
                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                        class="text-red-500 hover:bg-red-500 hover:text-white">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth
            <button @click="open = ! open" class="md:hidden text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden md:hidden bg-[#080808] border-t border-white/5 px-6 py-6">
        <div class="space-y-4">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                class="text-gray-300"> Dashboard </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')"
                class="text-[#DFFF00]"> Catalog </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')"
                class="text-gray-300"> Cart </x-responsive-nav-link>
            @role('seller')
            <x-responsive-nav-link href="{{ route('seller.crud.index') }}"
                :active="request()->routeIs('seller.crud.index')" class="text-gray-300"> My Products
            </x-responsive-nav-link>
            @endrole
        </div>
    </div>
</nav>