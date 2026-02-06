<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

@include('navigation-menu')

<section class="relative bg-[#0a0a0a] overflow-hidden" x-data="{ activeSlide: 1 }">
    <div class="relative h-[500px] flex items-center">
        <div x-show="activeSlide === 1" class="container mx-auto px-6 grid md:grid-cols-2 items-center gap-12">
            <div class="z-10">
                <span class="text-[#DFFF00] font-bold tracking-[0.4em] uppercase text-xs">Limited Promotion</span>
                <h2 class="text-5xl md:text-7xl font-black text-white mb-6 font-[Orbitron] leading-tight">NEXT GEN<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">GRAPHICS</span></h2>
                <p class="text-gray-400 text-lg mb-8 max-w-lg">Upgrade your rig with the new RTX Series. 20% off for early adopters.</p>
                <button class="bg-[#DFFF00] text-black font-black px-10 py-4 uppercase text-xs tracking-[0.2em] rounded-full hover:bg-white transition-all shadow-[0_0_20px_rgba(223,255,0,0.2)]">Claim Offer</button>
            </div>
            <div class="relative hidden md:block">
                <div class="absolute inset-0 bg-[#DFFF00]/10 blur-[120px] rounded-full"></div>
                <img src="{{ asset('img/rtx-removebg-preview.png') }}" class="relative z-10 w-full max-w-md h-auto object-contain rotate-12 drop-shadow-2xl">
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-[#080808]">
    <div class="container mx-auto px-4">
        <div class="flex items-end justify-between mb-16 border-l-4 border-[#DFFF00] pl-6">
            <div>
                <h3 class="text-white text-3xl font-bold font-[Orbitron] uppercase">Hardware Store</h3>
                <p class="text-gray-500 text-xs uppercase tracking-widest mt-2">Latest transmissions in stock</p>
            </div>
            <a href="#" class="text-[#DFFF00] text-[10px] font-black uppercase tracking-widest border-b border-[#DFFF00] pb-1">Browse All Products</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group bg-[#111] border border-white/5 rounded-[2rem] p-6 hover:border-[#DFFF00]/30 transition-all">
                <div class="relative aspect-square mb-6 overflow-hidden rounded-2xl bg-[#0a0a0a] flex items-center justify-center">
                    <img src="https://m.media-amazon.com/images/I/61S9aVn9d6L._AC_SL1500_.jpg" class="w-40 h-40 object-contain group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-[#DFFF00] text-black text-[9px] font-black px-3 py-1 rounded-full uppercase">New</span>
                </div>
                <h4 class="text-white font-bold uppercase tracking-tight mb-2">DualSense™ Edge Wireless</h4>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-white font-[Orbitron] text-lg">$199.99</span>
                    <button class="bg-white/5 p-3 rounded-xl hover:bg-[#DFFF00] hover:text-black transition-colors text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>

            <div class="group bg-[#111] border border-white/5 rounded-[2rem] p-6 hover:border-[#DFFF00]/30 transition-all">
                <div class="relative aspect-square mb-6 overflow-hidden rounded-2xl bg-[#0a0a0a] flex items-center justify-center">
                    <img src="https://m.media-amazon.com/images/I/71o8Q5h69ML._AC_SL1500_.jpg" class="w-40 h-40 object-contain group-hover:scale-110 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-[9px] font-black px-3 py-1 rounded-full uppercase">-15%</span>
                </div>
                <h4 class="text-white font-bold uppercase tracking-tight mb-2">SteelSeries Arctis Nova 7</h4>
                <div class="flex items-center justify-between mt-4">
                    <div>
                        <span class="text-white font-[Orbitron] text-lg">$169.00</span>
                        <span class="text-gray-600 text-xs line-through ml-2 font-[Orbitron]">$189.00</span>
                    </div>
                    <button class="bg-white/5 p-3 rounded-xl hover:bg-[#DFFF00] hover:text-black transition-colors text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>

            <div class="group bg-[#111] border border-white/5 rounded-[2rem] p-6 hover:border-[#DFFF00]/30 transition-all">
                <div class="relative aspect-square mb-6 overflow-hidden rounded-2xl bg-[#0a0a0a] flex items-center justify-center">
                    <img src="https://m.media-amazon.com/images/I/51H9V6UvH+L._AC_SL1200_.jpg" class="w-40 h-40 object-contain group-hover:scale-110 transition-transform duration-500">
                </div>
                <h4 class="text-white font-bold uppercase tracking-tight mb-2">Logitech G Pro X Superlight</h4>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-white font-[Orbitron] text-lg">$145.00</span>
                    <button class="bg-white/5 p-3 rounded-xl hover:bg-[#DFFF00] hover:text-black transition-colors text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>

            <div class="group bg-[#111] border border-white/5 rounded-[2rem] p-6 hover:border-[#DFFF00]/30 transition-all">
                <div class="relative aspect-square mb-6 overflow-hidden rounded-2xl bg-[#0a0a0a] flex items-center justify-center">
                    <img src="https://m.media-amazon.com/images/I/61L5S6YmP+L._AC_SL1500_.jpg" class="w-40 h-40 object-contain group-hover:scale-110 transition-transform duration-500">
                </div>
                <h4 class="text-white font-bold uppercase tracking-tight mb-2">Keychron Q1 Mechanical</h4>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-white font-[Orbitron] text-lg">$179.00</span>
                    <button class="bg-white/5 p-3 rounded-xl hover:bg-[#DFFF00] hover:text-black transition-colors text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mx-auto px-4 mb-24">
    <div class="bg-gradient-to-r from-[#DFFF00] to-[#bfff00] rounded-[3rem] p-12 flex flex-col md:flex-row items-center justify-between overflow-hidden relative">
        <div class="z-10 text-black">
            <h3 class="text-4xl font-black uppercase font-[Orbitron] mb-2 leading-tight">Elite Membership<br>Now Open.</h3>
            <p class="font-bold opacity-70 mb-8">Get exclusive early access to RTX 50-Series drop.</p>
            <button class="bg-black text-white px-8 py-3 rounded-full font-black text-[10px] uppercase tracking-widest hover:bg-gray-800 transition-all">Join Protocol</button>
        </div>
        <div class="absolute right-0 bottom-0 opacity-20 text-[15rem] font-black font-[Orbitron] -mb-20 tracking-tighter">PRT</div>
    </div>
</section>

<footer class="bg-[#0a0a0a] text-white pt-16 pb-8 border-t border-white/5">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div>
                <span class="text-2xl font-bold font-[Orbitron] mb-6 block">Protech<span class="text-[#DFFF00]">.</span></span>
                <p class="text-gray-500 text-[11px] uppercase tracking-widest leading-loose">Authentic Hardware Destination.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 text-xs uppercase tracking-widest">Support</h4>
                <ul class="text-gray-500 text-[10px] space-y-4 font-bold uppercase">
                    <li><a href="#" class="hover:text-[#DFFF00]">Tracking</a></li>
                    <li><a href="#" class="hover:text-[#DFFF00]">Warranty</a></li>
                    <li><a href="#" class="hover:text-[#DFFF00]">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>