<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

<style>
    body {
        background-color: #080808;
        color: white;
    }
</style>

@include('navigation-menu')

<div class="bg-darkBg min-h-screen py-12 font-sans text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-12 border-b border-white/5 pb-8">
            <div>
                <h1 class="text-4xl font-tech uppercase tracking-tighter text-white">
                    Shopping <span class="text-protech">Cart</span>
                </h1>
                <p class="text-white/40 text-xs mt-2 uppercase tracking-[0.3em]">Protech Fulfillment Center</p>
            </div>
            <div class="text-right">
                <span class="text-protech font-tech text-2xl">{{ $cart->items->count() }}</span>
                <span class="text-white/40 text-sm uppercase ml-2 tracking-widest">Units</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center bg-protech/10 border-l-4 border-protech text-protech p-4 rounded-r-xl shadow-[0_0_15px_rgba(223,255,0,0.1)]">
                <p class="font-bold text-sm uppercase tracking-wider">{{ session('success') }}</p>
            </div>
        @endif

        @if($cart->items->count() > 0)
            <div class="flex flex-col lg:flex-row gap-10">

                <div class="lg:w-2/3 space-y-6">
                    @foreach($cart->items as $item)
                        <div class="group bg-cardBg p-6 rounded-[2rem] border border-white/5 flex flex-col sm:flex-row items-center justify-between transition-all hover:border-protech/30 hover:bg-[#151515]">
                            <div class="flex items-center w-full sm:w-auto">
                                <div class="h-28 w-28 bg-darkBg rounded-2xl flex-shrink-0 overflow-hidden border border-white/5 p-2 group-hover:border-protech/20 transition-colors">
                                    <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}" 
                                         class="object-contain w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                                </div>

                                <div class="ml-6">
                                    <h3 class="text-lg font-bold text-white group-hover:text-protech transition-colors leading-tight">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="text-white/40 text-[10px] mt-1 uppercase tracking-widest font-tech">
                                        ID: #PRT-{{ $item->product->id }}
                                    </p>
                                    <div class="flex items-center mt-4">
                                        <span class="text-protech font-tech text-xl">${{ number_format($item->product->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between w-full sm:w-auto mt-6 sm:mt-0 space-x-12">
                                <div class="flex flex-col items-center">
                                    <span class="text-[10px] font-bold text-white/30 uppercase mb-2 tracking-widest">Quantity</span>
                                    <div class="flex items-center bg-darkBg border border-white/10 rounded-full px-4 py-1">
                                        <span class="text-lg font-tech text-white">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                </div>

                                <div class="text-right min-w-[120px]">
                                    <span class="text-[10px] font-bold text-white/30 uppercase block mb-1 tracking-widest">Subtotal</span>
                                    <span class="text-xl font-tech text-white">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </span>
                                </div>

                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-10 h-10 flex items-center justify-center text-white/20 hover:text-red-500 hover:bg-red-500/10 rounded-full transition-all border border-white/5 hover:border-red-500/50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-cardBg rounded-[2.5rem] p-8 border border-white/5 sticky top-8 shadow-2xl">
                        <h2 class="text-xl font-tech uppercase tracking-widest text-white mb-8 border-b border-white/5 pb-4">Summary</h2>

                        <div class="space-y-5 mb-8">
                            <div class="flex justify-between text-white/60 text-sm">
                                <span class="uppercase tracking-widest">Subtotal</span>
                                <span class="font-tech text-white">${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-white/60 text-sm">
                                <span class="uppercase tracking-widest">System Fee</span>
                                <span class="text-protech font-bold uppercase text-[10px] border border-protech/30 px-2 py-0.5 rounded">Waived</span>
                            </div>
                            <div class="flex justify-between text-white/60 text-sm">
                                <span class="uppercase tracking-widest">Shipping</span>
                                <span class="text-protech font-tech">FREE</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-white/10 flex justify-between items-end">
                            <div>
                                <span class="text-white/40 font-bold text-[10px] uppercase block mb-1 tracking-widest">Total Amount</span>
                                <span class="text-white text-sm font-medium">VAT Included</span>
                            </div>
                            <span class="text-4xl font-tech text-protech drop-shadow-[0_0_10px_rgba(223,255,0,0.3)]">
                                ${{ number_format($cart->items->sum(fn($i) => $i->product->price * $i->quantity), 2) }}
                            </span>
                        </div>

                        <button onclick="window.location.href= '{{ route('checkout.process') }}'" class="w-full bg-protech hover:bg-white text-black font-tech text-sm py-5 rounded-2xl mt-10 transition-all shadow-[0_10px_20px_rgba(223,255,0,0.15)] active:scale-[0.98] flex items-center justify-center gap-3 group">
                            INITIATE CHECKOUT
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>

                        <button onclick="window.location.href= '{{ route('checkout.cod') }}'" class="w-full bg-black hover:bg-white text-white hover:text-black font-tech text-sm py-5 rounded-2xl mt-10 transition-all shadow-[0_10px_20px_rgba(223,255,0,0.15)] active:scale-[0.98] flex items-center justify-center gap-3 group">
                            CASH ON DELIVERY
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>


                        <div class="mt-8 pt-8 border-t border-white/5 flex flex-wrap items-center justify-center gap-6 opacity-30 grayscale hover:opacity-60 transition-opacity">
                            <i class="fab fa-cc-visa text-2xl"></i>
                            <i class="fab fa-cc-mastercard text-2xl"></i>
                            <i class="fab fa-cc-paypal text-2xl"></i>
                            <i class="fab fa-apple-pay text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://js.stripe.com/v3/"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const stripe = Stripe('{{ config('services.stripe.key') }}');
                    const elements = stripe.elements({
                        fonts: [
                            {
                                cssSrc: 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400&display=swap'
                            }
                        ]
                    });

                    const style = {
                        base: {
                            color: '#ffffff',
                            fontFamily: '"Plus Jakarta Sans", sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        },
                        invalid: {
                            color: '#ff4444',
                            iconColor: '#ff4444'
                        }
                    };

                    const card = elements.create('card', {
                        style: style,
                        hidePostalCode: true
                    });

                    // Note: Assurez-vous d'avoir une div id="card-element" dans votre DOM pour le montage
                    if(document.getElementById('card-element')) {
                        card.mount('#card-element');
                    }

                    const form = document.getElementById('payment-form');
                    if(form) {
                        form.addEventListener('submit', async (event) => {
                            event.preventDefault();
                            const submitBtn = document.getElementById('submit-button');
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = "PROCESSING...";

                            const {token, error} = await stripe.createToken(card);

                            if (error) {
                                const errorElement = document.getElementById('card-errors');
                                errorElement.textContent = error.message;
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = "CONFIRM & PAY";
                            } else {
                                stripeTokenHandler(token);
                            }
                        });
                    }

                    function stripeTokenHandler(token) {
                        const form = document.getElementById('payment-form');
                        const hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            </script>

        @else
            <div class="bg-cardBg rounded-[3rem] p-24 text-center border border-white/5 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-protech/20"></div>
                <div class="bg-protech/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-8 border border-protech/20 shadow-[0_0_30px_rgba(223,255,0,0.05)]">
                    <svg class="w-10 h-10 text-protech" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-tech text-white uppercase tracking-tighter">Your deck is empty</h2>
                <p class="text-white/40 mt-4 max-w-xs mx-auto text-sm leading-relaxed uppercase tracking-widest">No hardware detected in your current session.</p>

                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 mt-10 bg-white/5 hover:bg-protech text-white hover:text-black px-8 py-4 rounded-full font-tech text-xs transition-all border border-white/10 hover:border-protech">
                    RETURN TO STORE
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</div>