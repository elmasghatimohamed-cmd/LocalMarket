@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-darkBg text-white font-sans py-12 px-4 sm:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12">
                <h1 class="text-5xl font-tech tracking-tight uppercase text-white">Mes Commandes</h1>
                <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Historique et suivi en temps réel</p>
            </div>

            <div class="space-y-8">
                @forelse($orders as $order)
                    <div class="bg-cardBg rounded-3xl border border-white/5 overflow-hidden hover:border-protech/30 transition-all duration-500">
                        <div class="p-6 border-b border-white/5 flex flex-wrap justify-between items-center gap-4 bg-white/[0.02]">
                            <div class="flex items-center gap-6">
                                <div>
                                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Commande ID</p>
                                    <p class="font-tech text-protech text-lg">#{{ $order->id }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Date</p>
                                    <p class="text-sm font-bold">{{ $order->created_at->format('d M, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Total</p>
                                    <p
                                        class="text-sm font-bold text-protech">
                                        {{ number_format($order->total, 2) }}
                                        DH</p>
                                </div>
                            </div>
                            <a href="{{ route('orders.show', $order) }}" class="px-6 py-2 bg-white/5 border border-white/10 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-protech hover:text-black transition-all">
                                Détails complets
                            </a>
                        </div>

                        <div class="p-8">
                            @php
                                $steps = [
                                    'en_attente' => ['label' => 'Reçue', 'icon' => 'M9 12l2 2 4-4'],
                                    'en_cours' => ['label' => 'Préparation', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                                    'expediee' => ['label' => 'Expédiée', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                                    'livree' => ['label' => 'Livrée', 'icon' => 'M5 13l4 4L19 7']
                                ];

                                $currentStatus = $order->status;
                                $orderKeys = array_keys($steps);
                                $currentIndex = array_search($currentStatus, $orderKeys);
                                // Si annulée, on gère différemment
                                $isCancelled = $currentStatus === 'annulee';
                            @endphp

                            @if($isCancelled)
                                <div class="flex items-center justify-center p-4 bg-red-500/10 border border-red-500/20 rounded-2xl">
                                    <span class="text-red-500 font-tech uppercase tracking-widest">Commande Annulée</span>
                                </div>
                            @else
                                <div class="relative flex justify-between">
                                    <div class="absolute top-5 left-0 w-full h-[2px] bg-white/10 z-0"></div>

                                    @foreach($steps as $key => $step)
                                                                            @php
                                                                                $stepIndex = array_search($key, $orderKeys);
                                                                                $isCompleted = $stepIndex <= $currentIndex;
                                                                                $isCurrent = $stepIndex === $currentIndex;
                                                                            @endphp

                                        <div class="relative z-10 flex flex-col items-center group">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500 {{ $isCompleted ? 'bg-protech text-black' : 'bg-cardBg border border-white/10 text-white/20' }} {{ $isCurrent ? 'ring-4 ring-protech/20' : '' }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                                                </svg>
                                            </div>
                                            <p
                                                class="mt-3 text-[10px] uppercase font-bold tracking-tighter {{ $isCompleted ? 'text-white' : 'text-white/20' }}">{{ $step['label'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-cardBg rounded-3xl border border-dashed border-white/10">
                        <p class="font-tech text-white/20 text-xl uppercase italic">Aucune commande trouvée</p>
                        <a href="/" class="mt-6 inline-block text-protech border-b border-protech pb-1 hover:text-white hover:border-white transition-all uppercase text-xs font-bold tracking-widest">Commencer le shopping</a>
                    </div>
                @endforelse

                <div
                    class="mt-8">{{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
