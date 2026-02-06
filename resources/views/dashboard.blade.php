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
    body { background-color: #080808; color: white; }
    /* Consistent scrollbar for the tech look */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #080808; }
    ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #DFFF00; }
</style>

@include('navigation-menu')

@extends('layouts.admin')

@section('content')
        <div class="min-h-screen w-full bg-darkBg text-white font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">


                <div class="mb-12">
                    <h1 class="text-5xl font-tech tracking-tight uppercase text-white">Dashboard</h1>
                    <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Business Overview & Analytics</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @php
    $statsItems = [
        ['label' => 'Total Users', 'value' => $stats['total_users'], 'color' => 'protech', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z'],
        ['label' => 'Total Products', 'value' => $stats['total_products'], 'color' => 'protech', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
        ['label' => 'Total Orders', 'value' => $stats['total_orders'], 'color' => 'protech', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['label' => 'Total Revenue', 'value' => '$' . number_format($stats['total_revenue'], 2), 'color' => 'protech', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
    ];
                    @endphp

                    @foreach($statsItems as $item)
                        <div class="bg-cardBg rounded-3xl p-6 border border-white/5 hover:border-protech/30 transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">{{ $item['label'] }}</p>
                                    <p class="text-3xl font-tech text-white mt-2 group-hover:text-protech transition-colors">{{ $item['value'] }}</p>
                                </div>
                                <div class="p-3 bg-white/5 rounded-2xl border border-white/10 group-hover:bg-protech/10 transition-colors">
                                    <svg class="w-6 h-6 text-protech" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    <div class="lg:col-span-1 bg-cardBg rounded-3xl border border-white/5 p-8 h-fit">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6">Quick Actions</h2>
                        <div class="flex flex-col gap-4">
                            <a href="{{ route('admin.categories.create') }}"
                                class="w-full px-6 py-4 bg-protech text-black rounded-full hover:bg-white transition font-extrabold text-xs text-center uppercase tracking-tighter">
                                + Add Category
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="w-full px-6 py-4 bg-white/5 text-white border border-white/10 rounded-full hover:bg-white/10 transition font-bold text-xs text-center uppercase tracking-tighter">
                                Manage Inventory
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-2 bg-cardBg rounded-3xl border border-white/5 p-8">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6">Order Summary</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                                <span class="text-white/40 text-[10px] uppercase font-bold">Pending</span>
                                <p class="text-2xl font-tech mt-1 text-yellow-500">{{ $stats['pending_orders'] }}</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                                <span class="text-white/40 text-[10px] uppercase font-bold">Delivered</span>
                                <p class="text-2xl font-tech mt-1 text-green-500">{{ $stats['completed_orders'] }}</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/5">
                                <span class="text-white/40 text-[10px] uppercase font-bold">Categories</span>
                                <p class="text-2xl font-tech mt-1 text-protech">{{ $stats['total_categories'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-cardBg rounded-3xl border border-white/5 p-8 mb-12">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em]">Recent Orders</h2>
                        <a href="{{ route('orders.index') }}" class="text-[10px] font-bold text-protech hover:text-white uppercase tracking-widest transition">
                            View all items →
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th class="pb-4 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Order ID</th>
                                    <th class="pb-4 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Customer</th>
                                    <th class="pb-4 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Amount</th>
                                    <th class="pb-4 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Status</th>
                                    <th class="pb-4 px-4 text-white/40 font-bold text-[10px] uppercase tracking-widest">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($recent_orders as $order)
                                    <tr class="hover:bg-white/5 transition-colors group">
                                        <td class="py-4 px-4 font-tech text-sm text-white">#{{ $order->id }}</td>
                                        <td class="py-4 px-4 text-white/70 text-sm">{{ $order->user->name ?? 'N/A' }}</td>
                                        <td class="py-4 px-4 text-protech font-tech text-sm">${{ number_format($order->total, 2) }}</td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tighter
                                                @if($order->status === 'on_hold') bg-yellow-500/10 text-yellow-500
                                                @elseif($order->status === 'delivered') bg-green-500/10 text-green-500
                                                @elseif($order->status === 'paid') bg-blue-500/10 text-blue-500
                                                @else bg-white/10 text-white/60 @endif">
                                                {{ str_replace('_', ' ', $order->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-white/30 text-[10px] font-bold uppercase">{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @role('admin')
                <div class="bg-cardBg rounded-3xl border border-white/5 p-8 shadow-2xl">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em]">User Management</h2>
                        <button id="apply-role-changes" style="display:none;" class="bg-protech text-black px-4 py-1 rounded-full text-[10px] font-extrabold uppercase">Apply Pending</button>
                        <span id="role-change-toast" class="hidden text-protech text-xs font-bold"></span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th class="pb-4 px-4 text-left text-white/40 font-bold text-[10px] uppercase tracking-widest">User</th>
                                    <th class="pb-4 px-4 text-left text-white/40 font-bold text-[10px] uppercase tracking-widest">Role Access</th>
                                    <th class="pb-4 px-4 text-left text-white/40 font-bold text-[10px] uppercase tracking-widest">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($recent_users as $user)
                                    <tr class="hover:bg-white/5 transition-colors group">
                                        <td class="py-6 px-4">
                                            <div class="font-bold text-white text-sm">{{ $user->name }}</div>
                                            <div class="text-white/30 text-xs">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-6 px-4">
                                            <form method="POST" action="{{ route('admin.role_switcher.update', $user) }}" class="flex items-center gap-3 role-change-form">
                                                @csrf
                                                <select name="role" class="role-select bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-xs font-bold text-white/80 focus:ring-1 focus:ring-protech focus:outline-none hover:border-white/20">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role }}" class="bg-cardBg" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                                            {{ ucfirst($role) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="p-2 hover:text-protech text-white/20 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                            <div class="mt-2 role-change-status text-[10px] font-bold uppercase tracking-tighter"></div>
                                            <div class="mt-2">
                                                <span class="px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-tighter bg-white/10 text-white/50">
                                                    Current: {{ $user->roles->pluck('name')->join(', ') ?: 'User' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-6 px-4 text-white/30 text-[10px] font-bold uppercase">{{ $user->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endrole
            </div>
        </div>
@endsection