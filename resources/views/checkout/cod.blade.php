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
                    inputBg: '#1a1a1a',
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
    input:focus { border-color: #DFFF00 !important; outline: none; }
</style>

@include('navigation-menu')

<div class="bg-darkBg min-h-screen py-12 font-sans text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12 border-b border-white/5 pb-8 text-center">
            <h1 class="text-3xl font-tech uppercase tracking-tighter text-white">
                Confirm <span class="text-protech">Delivery</span>
            </h1>
            <p class="text-white/40 text-[10px] mt-2 uppercase tracking-[0.4em]">Cash on Delivery Protocol</p>
        </div>

        <div class="bg-cardBg rounded-[2.5rem] p-8 border border-white/5 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-protech/50 to-transparent"></div>

            <form action="{{ route('checkout.cod') }}" method="POST" class="space-y-8">
                @csrf

                <div class="space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-8 h-8 rounded-full bg-protech/10 border border-protech/20 flex items-center justify-center">
                            <span class="text-protech text-xs font-tech">01</span>
                        </div>
                        <h2 class="font-tech uppercase text-sm tracking-widest">Shipping Destination</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-white/40 mb-2 ml-1">Full Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" disabled
                                class="w-full bg-inputBg border border-white/10 rounded-xl px-4 py-3 text-white/60 font-medium cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-white/40 mb-2 ml-1">Delivery Address</label>
                            <textarea name="address" required rows="3"
                                placeholder="Enter your full street address, apartment, city..."
                                class="w-full bg-inputBg border border-white/10 rounded-xl px-4 py-3 text-white transition-all focus:ring-1 focus:ring-protech/50">{{ Auth::user()->address }}</textarea>
                            @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-white/40 mb-2 ml-1">Contact Number</label>
                            <input type="tel" name="phone" required placeholder="+33 6 00 00 00 00"
                                class="w-full bg-inputBg border border-white/10 rounded-xl px-4 py-3 text-white transition-all">
                        </div>
                    </div>
                </div>

                <div class="bg-darkBg/50 rounded-2xl p-6 border border-white/5 space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-white/40 uppercase tracking-widest">Total to Pay on Delivery</span>
                        <span class="text-2xl font-tech text-protech">
                            ${{ number_format($total, 2) }}
                        </span>
                    </div>
                    <p class="text-[9px] text-white/20 uppercase tracking-tighter leading-relaxed">
                        By confirming, you agree to pay the total amount in cash to the courier upon arrival. Please ensure someone is present at the address.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('cart.index') }}" 
                        class="flex-1 text-center py-4 rounded-xl border border-white/10 text-white/40 text-[10px] font-tech uppercase hover:bg-white/5 transition-all">
                        Return to Cart
                    </a>
                    <button type="submit" 
                        class="flex-[2] bg-protech hover:bg-white text-black font-tech text-xs py-4 rounded-xl transition-all shadow-[0_10px_20px_rgba(223,255,0,0.1)] active:scale-95 flex items-center justify-center gap-2 group">
                        CONFIRM ORDER & PAY ON DELIVERY
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-8 text-center text-white/20 text-[9px] uppercase tracking-[0.2em]">
            Verified Protech Fulfillment • Secure Transaction Logic
        </p>
    </div>
</div>