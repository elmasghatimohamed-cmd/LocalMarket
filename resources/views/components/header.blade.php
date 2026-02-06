<nav class="bg-[#080808] border-b border-white/5">
    <div class="container mx-auto px-4 py-6 flex flex-wrap items-center justify-between gap-6">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="relative w-12 h-12 bg-black flex items-center justify-center overflow-hidden border border-[#DFFF00]/20">
                    <div class="absolute inset-0 border-[4px] border-[#DFFF00] rotate-45"></div>
                    <div class="w-2 h-2 rounded-full bg-white z-10 shadow-[0_0_10px_#DFFF00]"></div>
                </div>
                <div>
                    <a href="/" class="text-3xl font-bold tracking-tighter text-white font-[Orbitron]">Protech<span class="text-[#DFFF00]">.</span></a>
                    <p class="text-[9px] text-gray-500 uppercase tracking-[0.3em] font-medium -mt-1">Future Tech Store</p>
                </div>
            </div>

            <a href="{{ route('products.index') }}"
                class="bg-[#DFFF00] hover:bg-[#e6ff33] text-black px-6 py-2.5 rounded-full flex items-center gap-2 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span class="text-[11px] font-black uppercase tracking-widest">Catalog</span>
            </a>
        </div>

        <nav class="hidden lg:flex items-center gap-8">
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
        </nav>

        <div class="flex items-center gap-8">
            <a href="{{ route('cart.index') }}" class="relative group">
                <div class="bg-[#DFFF00] p-3 rounded-xl shadow-lg transition-transform group-hover:scale-110">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="absolute -top-2 -right-2 bg-white text-black text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-[#080808]">{{ $cartNav->items->sum('quantity') ?? 0 }}</span>
            </a>
            @auth
                <div class="relative">
                    <button onclick="toggleProfileDropdown()" class="bg-white/5 border border-white/10 text-white px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#DFFF00] hover:text-black transition-all">
                        {{ Auth::user()->name }}
                    </button>
                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-[#111] border border-white/10 rounded-xl shadow-lg z-50">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-white text-xs hover:bg-[#DFFF00] hover:text-black transition-all rounded-t-xl">Dashboard</a>
                        <a href="{{ route('products.index') }}" class="block px-4 py-3 text-white text-xs hover:bg-[#DFFF00] hover:text-black transition-all">Products</a>
                        <a href="{{ route('profile.show') }}" class="block px-4 py-3 text-white text-xs hover:bg-[#DFFF00] hover:text-black transition-all">Profile</a>
                        @role('seller')
                        <a href="{{ route('seller.crud.index') }}" class="block px-4 py-3 text-white text-xs hover:bg-[#DFFF00] hover:text-black transition-all">My Products</a>
                        @endrole
                        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-white text-xs hover:bg-[#DFFF00] hover:text-black transition-all rounded-b-xl">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-white/5 border border-white/10 text-white px-6 py-2.5 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#DFFF00] hover:text-black transition-all">Login</a>
            @endauth
        </div>
    </div>
</nav>

<script>
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown) dropdown.classList.toggle('hidden');
}

document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const button = event.target.closest('button[onclick="toggleProfileDropdown()"]');
    if (!button && dropdown && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
