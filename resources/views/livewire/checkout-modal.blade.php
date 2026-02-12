<div>
    <button wire:click="openModal" class="w-full bg-protech hover:bg-white text-black font-tech text-sm py-5 rounded-2xl mt-10 transition-all shadow-[0_10px_20px_rgba(223,255,0,0.15)] flex items-center justify-center gap-3 group">
        INITIATE CHECKOUT
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </button>

    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-md p-4">
        <div class="relative bg-cardBg border border-white/10 w-full max-w-4xl rounded-[2.5rem] p-8 shadow-2xl">
            <button wire:click="closeModal" class="absolute top-6 right-6 text-white/20 hover:text-protech transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2"></path></svg>
            </button>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <h2 class="text-2xl font-tech text-white uppercase">Checkout <span class="text-protech">Protocol</span></h2>
                    <div class="max-h-64 overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                        @foreach($cart->items as $item)
                        <div class="flex items-center gap-4 bg-white/5 p-3 rounded-xl border border-white/5">
                            <img src="{{ $item->product->image_url }}" class="w-12 h-12 object-contain">
                            <div class="flex-1">
                                <p class="text-[10px] text-white/40 font-bold uppercase">{{ $item->product->name }}</p>
                                <p class="text-protech font-tech text-sm">{{ number_format($item->product->price, 2) }} DH</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <input type="text" wire:model.defer="address" placeholder="SHIPPING ADDRESS" class="w-full bg-darkBg border border-white/10 rounded-xl px-5 py-3 text-white focus:border-protech outline-none transition-all font-sans text-sm">
                </div>

                <div class="bg-darkBg p-6 rounded-3xl border border-white/10 flex flex-col justify-between">
                    <div wire:ignore>
                        <label class="text-[10px] font-bold text-white/30 uppercase tracking-widest mb-4 block font-tech">Payment Module</label>
                        <div id="modal-card-element" class="bg-cardBg p-4 rounded-xl border border-white/10 mb-4"></div>
                        <div id="modal-card-errors" class="text-red-500 text-[10px] font-bold uppercase"></div>
                    </div>

                    <div>
                        <div class="flex justify-between items-end mb-6">
                            <span class="text-[10px] text-white/40 font-bold uppercase">Total Due</span>
                            <span class="text-3xl font-tech text-protech">{{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }} DH</span>
                        </div>
                        <button id="modal-submit-payment" class="w-full bg-protech hover:bg-white text-black font-tech py-4 rounded-xl transition-all shadow-lg active:scale-95 uppercase text-sm">
                            Authorize Transaction
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>