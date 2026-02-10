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
                },
                fontFamily: {
                    tech: ['Orbitron', 'sans-serif'],
                    sans: ['Plus Jakarta Sans', 'sans-serif'],
                }
            }
        }
    }
</script>

@extends('layouts.admin')

@section('content')
        <div class="w-full bg-darkBg text-white font-sans overflow-x-hidden">
            <div class="w-screen min-h-screen px-4 sm:px-8 lg:px-12 py-12">

                <div class="mb-12 border-b border-white/5 pb-8">
                    <h1 class="text-5xl font-tech tracking-tight uppercase text-white">Secure <span class="text-protech">Checkout</span></h1>
                    <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Encrypted Transaction Interface</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-8">

                        <div class="bg-cardBg rounded-3xl border border-white/5 p-8">
                            <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-protech rounded-full animate-pulse"></span>
                                Hardware Selection
                            </h2>

                            <div class="space-y-4">
                                @foreach($cart->items as $item)
                                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5 group hover:border-protech/20 transition-all">
                                        <div class="flex items-center gap-6">
                                            <div class="w-16 h-16 bg-darkBg rounded-xl overflow-hidden border border-white/10 p-2">
                                                <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" class="object-contain w-full h-full transform group-hover:scale-110 transition-transform">
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-bold text-white uppercase tracking-tight">{{ $item->product->name }}</h3>
                                                <p class="text-[10px] text-white/30 font-tech mt-1">UNIT_PRICE: {{ number_format($item->product->price, 2) }} DH</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] text-white/30 uppercase font-bold">Subtotal</p>
                                            <p class="font-tech text-protech text-lg">{{ number_format($item->product->price * $item->quantity, 2) }} <span class="text-[10px]">DH</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-cardBg rounded-3xl border border-white/5 p-8">
                            <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6">Dispatch Protocol</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-widest ml-1">Recipient Identity</label>
                                    <input type="text" form="payment-form" name="name" value="{{ Auth::user()->name }}" 
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm font-bold text-white focus:ring-1 focus:ring-protech focus:outline-none focus:border-protech/50 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-widest ml-1">Terminal Address</label>
                                    <input type="text" form="payment-form" name="address" required placeholder="Shipping location..." 
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm font-bold text-white focus:ring-1 focus:ring-protech focus:outline-none focus:border-protech/50 transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-cardBg rounded-3xl border border-white/5 p-8 sticky top-8 shadow-2xl">
                            <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-8 border-b border-white/5 pb-4">Transaction Summary</h2>

                            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                                @csrf
                                <div class="mb-10">
                                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] block mb-4">Encrypted Card Entry</label>
                                    <div id="card-element" class="bg-darkBg p-5 rounded-2xl border border-white/10 focus-within:border-protech/50 transition-all shadow-inner">
                                        </div>
                                    <div id="card-errors" role="alert" class="text-red-500 text-[10px] mt-4 uppercase font-bold tracking-tighter"></div>
                                </div>

                                <div class="space-y-3 mb-10">
                                    <div class="flex justify-between text-[10px] font-bold text-white/40 uppercase">
                                        <span>Net Total</span>
                                        <span class="font-tech text-white">{{ number_format($total, 2) }} DH</span>
                                    </div>
                                    <div class="flex justify-between text-[10px] font-bold text-white/40 uppercase">
                                        <span>System Fee</span>
                                        <span class="text-protech tracking-tighter italic">Waived</span>
                                    </div>
                                    <div class="pt-4 border-t border-white/5 flex justify-between items-end">
                                        <span class="text-xs font-bold uppercase">Final Amount</span>
                                        <span class="text-3xl font-tech text-protech drop-shadow-[0_0_10px_rgba(223,255,0,0.2)]">
                                            {{ number_format($total, 2) }}<span class="text-xs ml-1 font-sans">DH</span>
                                        </span>
                                    </div>
                                </div>

                                <button type="submit" id="submit-button" 
                                    class="w-full bg-protech hover:bg-white text-black font-tech text-xs py-5 rounded-2xl transition-all shadow-[0_10px_30px_rgba(223,255,0,0.1)] active:scale-[0.98] flex items-center justify-center gap-3 group">
                                    INITIATE TRANSACTION
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </form>

                            <div class="mt-8 pt-8 border-t border-white/5 flex flex-wrap justify-center gap-4 opacity-20 grayscale">
                                <i class="fab fa-cc-visa text-xl"></i>
                                <i class="fab fa-cc-mastercard text-xl"></i>
                                <i class="fab fa-cc-stripe text-xl"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Remplace par ta clé publique Stripe
                const stripe = Stripe("{{ env('STRIPE_KEY') }}");
                const elements = stripe.elements();

                // Style pour l'input Stripe pour matcher Orbitron
                const style = {
                    base: {
                        color: '#ffffff',
                        fontFamily: 'Orbitron, sans-serif',
                        fontSize: '14px',
                        '::placeholder': { color: '#4b5563' }
                    }
                };

                const card = elements.create('card', { style: style, hidePostalCode: true });
                card.mount('#card-element');

                const form = document.getElementById('payment-form');
                const submitBtn = document.getElementById('submit-button');

                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = "AUTHORIZING...";

                    const {token, error} = await stripe.createToken(card);

                    if (error) {
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = error.message;
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'RETRY TRANSACTION';
                    } else {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            });
        </script>
@endsection