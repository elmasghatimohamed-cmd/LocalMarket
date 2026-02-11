<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">

<div class="bg-[#080808] min-h-screen text-white font-sans p-4 md:p-10">
    <div class="container mx-auto max-w-6xl">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold uppercase tracking-tighter font-[Orbitron]">
                    Orders<span class="text-[#DFFF00]">_</span>Control
                </h1>
                <p class="text-gray-500 text-[10px] uppercase tracking-[0.4em] mt-1">Incoming hardware transmissions</p>
            </div>
            
            <div class="flex gap-3">
                <div class="bg-white/5 border border-white/10 px-6 py-2 rounded-full flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#DFFF00] animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-300">Live Server Active</span>
                </div>
            </div>
        </div>

        <div class="bg-[#111] border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-[9px] uppercase tracking-[0.3em] bg-white/[0.02]">
                            <th class="px-8 py-5 font-bold">Protocol ID</th>
                            <th class="px-8 py-5 font-bold">Client / Hardware</th>
                            <th class="px-8 py-5 font-bold">Status</th>
                            <th class="px-8 py-5 font-bold text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($orders as $order)
                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-gray-500 block">#{{ $order->id }}</span>
                                <span class="text-[9px] text-gray-600 uppercase">{{ $order->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white uppercase tracking-tight">{{ $order->user->name }}</span>
                                    <span class="text-[10px] text-gray-500 italic">{{ $order->items->first()->product->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusColors = [
                                        'on_hold' => 'bg-[#DFFF00]/10 text-[#DFFF00]',
                                        'paid' => 'bg-blue-500/10 text-blue-400',
                                        'delivered' => 'bg-green-500/10 text-green-400'
                                    ];
                                @endphp
                                <form action="{{ route('seller.orders.updateStatus', $order) }}" method="POST" class="inline">
                                    @csrf
                                    <select name="status" class="{{ $statusColors[$order->status] ?? 'bg-gray-500/10 text-gray-400' }} text-[9px] font-black px-3 py-1 rounded-full uppercase border-0 outline-none focus:ring-1 focus:ring-[#DFFF00]" onchange="this.form.submit()">
                                        <option value="on_hold" {{ $order->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-[#DFFF00] text-[9px] font-black uppercase">{{ number_format($order->total, 2) }} USD</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-gray-500">
                                <span class="text-sm uppercase tracking-wider">No orders found</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>