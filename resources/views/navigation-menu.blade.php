<nav x-data="{ open: false }" class="border-b border-white/5 bg-darkBg/80 backdrop-blur-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="font-tech text-2xl tracking-tighter">
            Protech<span class="text-protech">.</span>
        </div>

        <nav class="hidden md:flex items-center gap-8">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-nav-link>
            <x-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')">
                {{ __('Cart') }}
            </x-nav-link>
            @role('seller')
            <x-nav-link href="{{ route('seller.crud.index') }}" :active="request()->routeIs('seller.crud.index')">
                <i class="fas fa-store mr-1"></i> {{ __('My Inventory') }}
            </x-nav-link>
            @endrole
        </nav>

        <div class="flex items-center gap-6 text-white/80">
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center px-3 py-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 bg-transparent hover:text-white focus:outline-none transition">
                                {{ Auth::user()->currentTeam->name }}
                                <i class="fas fa-chevron-down ms-2 text-[8px]"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="w-60 bg-[#080808] border border-[#222]">
                                <div class="block px-4 py-2 text-xs text-gray-500 uppercase tracking-widest">{{ __('Manage Team') }}</div>
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="hover:bg-[#DFFF00] hover:text-black"> {{ __('Team Settings') }} </x-dropdown-link>
                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-dropdown-link href="{{ route('teams.create') }}" class="hover:bg-[#DFFF00] hover:text-black"> {{ __('Create New Team') }} </x-dropdown-link>
                                @endcan
                                @if (Auth::user()->allTeams()->count() > 1)
                                    <div class="border-t border-[#222]"></div>
                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <div class="relative flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-[#222] rounded-full focus:border-[#DFFF00] transition p-0.5">
                                <img class="size-9 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <button class="hover:text-protech transition-colors flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-sm hidden sm:inline">{{ Auth::user()->name }}</span>
                            </button>
                        @endif
                    </x-slot>
                    <x-slot name="content">
                        <div class="bg-[#080808] border border-[#222] py-1">
                            <div class="block px-4 py-2 text-[9px] text-gray-500 uppercase font-black">{{ __('Account Security') }}</div>
                            <x-dropdown-link href="{{ route('profile.show') }}" class="text-white hover:bg-[#DFFF00] hover:text-black transition-colors"> {{ __('Profile') }} </x-dropdown-link>
                            <div class="border-t border-[#222]"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-red-500 hover:bg-red-500 hover:text-white transition-colors">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#080808] border-t border-[#222]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"> Dashboard </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')"> Products </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-[#222]">
            <div class="flex items-center px-4 mb-4">
                <img class="size-10 rounded-full object-cover border border-[#DFFF00]" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <div class="ms-3">
                    <div class="font-bold text-sm text-white uppercase">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1 pb-4">
                <x-responsive-nav-link href="{{ route('profile.show') }}" class="text-gray-400"> Profile </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-red-500"> Log Out </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>