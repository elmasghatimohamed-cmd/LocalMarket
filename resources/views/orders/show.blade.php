@include('navigation-menu')

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail #{{ $order->id }} | LocalMarket</title>

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

        .cyber-border {
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glow-text {
            text-shadow: 0 0 10px rgba(223, 255, 0, 0.3);
        }
    </style>
</head>

<body class="bg-darkBg text-white antialiased">

    <main class="container mx-auto px-6 py-12">
        <div class="mb-10">
            <a href="{{ route('orders.index') }}"
                class="group inline-flex items-center text-[10px] font-bold uppercase tracking-widest text-white/40 hover:text-protech transition">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to command logs
            </a>
        </div>

        <div class="bg-cardBg rounded-3xl cyber-border overflow-hidden">
            <div
                class="p-8 md:p-12 border-b border-white/5 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-5xl font-tech tracking-tighter glow-text uppercase">Order #{{ $order->id }}</h1>
                    <p class="text-white/30 text-xs font-bold uppercase tracking-[0.3em] mt-2">Authenticated Session
                        Entry</p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="text-white/40 text-[10px] font-bold uppercase tracking-widest">Process Status</span>
                    <span class="px-6 py-2 rounded-full text-xs font-extrabold uppercase tracking-tighter
                        @if($order->status === 'on_hold') bg-yellow-500/10 text-yellow-500 border border-yellow-500/20
                        @elseif($order->status === 'delivered') bg-green-500/10 text-green-500 border border-green-500/20
                        @elseif($order->status === 'paid') bg-blue-500/10 text-blue-500 border border-blue-500/20
                        @else bg-white/10 text-white/60 border border-white/20 @endif">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </div>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-white/5 border-b border-white/5 bg-white/[0.02]">
                <div class="p-8">
                    <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] mb-3">Timestamp</p>
                    <p class="text-lg font-tech text-white uppercase">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div class="p-8">
                    <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] mb-3">Client Identity</p>
                    <p class="text-lg font-bold text-white">{{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div class="p-8">
                    <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] mb-3">Contact Access</p>
                    <p class="text-lg font-bold text-white/70">{{ $order->user->email ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <h2 class="text-xs font-bold text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 bg-protech rounded-full animate-pulse"></span>
                    Manifest Items
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="pb-6 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">
                                    Product Module</th>
                                <th
                                    class="pb-6 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest text-center">
                                    Qty</th>
                                <th class="pb-6 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Unit
                                    Price</th>
                                <th
                                    class="pb-6 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest text-right">
                                    Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($order->items as $item)
                                <tr class="group hover:bg-white/[0.02] transition">
                                    <td class="py-6 px-4">
                                        <div class="text-white font-bold text-sm tracking-tight">
                                            {{ $item->product->name ?? 'Product' }}</div>
                                        <div
                                            class="text-white/30 text-[10px] font-mono mt-1 group-hover:text-protech/50 transition uppercase tracking-widest">
                                            UID: #{{ $item->product_id }}</div>
                                    </td>
                                    <td class="py-6 px-4 text-center font-tech text-sm text-white/70">{{ $item->quantity }}
                                    </td>
                                    <td class="py-6 px-4 text-white/50 text-sm font-tech">
                                        ${{ number_format($item->price, 2) }}</td>
                                    <td
                                        class="py-6 px-4 text-right font-tech text-white text-md tracking-tighter group-hover:text-protech transition">
                                        ${{ number_format($item->quantity * $item->price, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="p-8 md:p-12 bg-white/[0.01] border-t border-white/5 flex flex-col md:flex-row justify-between gap-12">
                <div class="w-full md:max-w-md">
                    <div class="p-6 rounded-2xl bg-darkBg border border-white/5 cyber-border">
                        <h3 class="text-[10px] font-bold text-protech uppercase tracking-[0.3em] mb-4">Payment
                            Verification</h3>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04kM12 21.48l0 0">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white/60 text-xs font-bold uppercase tracking-widest">Gateway Status</p>
                                <p class="text-sm font-tech text-white mt-1">{{ ucfirst($order->payment_status) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-80 space-y-4">
                    <div class="flex justify-between text-[10px] font-bold text-white/40 uppercase tracking-widest">
                        <span>Net Subtotal</span>
                        <span class="text-white font-tech">${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-[10px] font-bold text-white/40 uppercase tracking-widest">
                        <span>Transport Protocol</span>
                        <span class="text-green-500">CREDIT_GRANTED</span>
                    </div>
                    <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                        <span class="text-xs font-tech text-white uppercase tracking-tighter">Total Amount</span>
                        <span
                            class="text-4xl font-tech text-protech glow-text tracking-tighter">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center">
        <p class="text-white/10 text-[9px] font-bold uppercase tracking-[0.5em]">&copy; 2026 Virtual Commerce Terminal -
            Access Encrypted</p>
    </footer>

</body>

</html>