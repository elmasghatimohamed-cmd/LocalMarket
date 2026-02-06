@include('navigation-menu')

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | LocalMarket</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap"
        rel="stylesheet">
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
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #080808;
        }

        ::-webkit-scrollbar-thumb {
            background: #222;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #DFFF00;
        }

        .order-card {
            background: #111111;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .order-card:hover {
            border-color: rgba(223, 255, 0, 0.3);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-darkBg text-white antialiased">

    <main class="container mx-auto px-6 py-12 min-h-screen">
        <div class="mb-12">
            <h1 class="text-5xl font-tech tracking-tight uppercase text-white">My Orders</h1>
            <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Track and manage your recent
                purchases</p>
        </div>

        @if($orders->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-20 bg-cardBg rounded-3xl border border-white/5 border-dashed">
                <div class="p-6 bg-white/5 rounded-full mb-6">
                    <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <p class="text-white/40 font-bold uppercase tracking-widest text-sm mb-6">No mission data found</p>
                <a href="{{ route('products.index') }}"
                    class="px-8 py-4 bg-protech text-black rounded-full font-extrabold text-xs uppercase tracking-widest hover:bg-white transition">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($orders as $order)
                    <div class="order-card rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">

                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <h2 class="text-xl font-tech text-white">#{{ $order->id }}</h2>
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tighter
                                                            @if($order->status === 'on_hold') bg-yellow-500/10 text-yellow-500
                                                            @elseif($order->status === 'delivered') bg-green-500/10 text-green-500
                                                            @elseif($order->status === 'paid') bg-blue-500/10 text-blue-500
                                                            @else bg-white/10 text-white/60 @endif">
                                    {{ str_replace('_', ' ', $order->status) }}
                                </span>
                            </div>
                            <p class="text-white/30 text-[10px] font-bold uppercase tracking-widest italic">
                                Placed on {{ $order->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div class="flex gap-12">
                            <div>
                                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest mb-1">Items</p>
                                <p class="font-tech text-white">{{ $order->items->count() }} Units</p>
                            </div>
                            <div>
                                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest mb-1">Total Value</p>
                                <p class="font-tech text-protech text-xl tracking-tighter">
                                    ${{ number_format($order->total, 2) }}</p>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('orders.show', $order) }}"
                                class="inline-block px-8 py-3 bg-white/5 border border-white/10 text-white rounded-full font-bold text-xs uppercase tracking-widest hover:bg-protech hover:text-black hover:border-protech transition duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $orders->links() }}
            </div>
        @endif
    </main>

    <footer class="border-t border-white/5 bg-cardBg py-12 mt-20">
        <div class="container mx-auto px-6 text-center">
            <div class="text-xl font-tech tracking-tighter text-white/20 mb-4">LOCAL<span
                    class="text-white/10">MARKET</span></div>
            <p class="text-white/20 text-[10px] font-bold uppercase tracking-[0.3em]">&copy; 2026 Secured Interface. All
                rights reserved.</p>
        </div>
    </footer>

</body>

</html>