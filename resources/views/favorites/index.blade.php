@include('navigation-menu')

@extends('layouts.admin')


@section('content')
    <div class="min-h-screen bg-[#080808] text-white font-sans">
        <div class="w-full px-4 sm:px-8 lg:px-12 py-12">

            <div class="mb-12">
                <h1 class="text-5xl font-tech tracking-tight uppercase text-white">My Favorites</h1>
                <p class="text-white/40 mt-2 uppercase tracking-widest text-xs font-bold">Products you like</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @foreach($favorites as $product)
                    <div
                        class="bg-[#111111] rounded-3xl overflow-hidden border border-white/5 hover:border-[#DFFF00]/30 transition-all duration-300 group">

                        <div class="aspect-square bg-white/5 relative flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-full opacity-80 group-hover:opacity-100 transition-opacity">
                            @else
                                {{-- Placeholder si pas d'image --}}
                                <svg class="w-12 h-12 text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            @endif

                            <div
                                class="absolute top-4 right-4 bg-black/60 backdrop-blur-md border border-white/10 px-3 py-1 rounded-full">
                                <span class="text-[#DFFF00] font-tech text-xs">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>

                        <div class="p-6">
                            <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest mb-1">
                                {{ $product->category->name ?? 'ELECTRONICS' }}
                            </p>
                            <h3 class="text-lg font-tech text-white group-hover:text-[#DFFF00] transition-colors mb-6 truncate">
                                {{ $product->name }}
                            </h3>

                            <div class="flex items-center justify-between gap-4">
                                <a href="{{ route('products.show', $product) }}"
                                    class="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-white rounded-full hover:bg-white/10 transition text-[10px] font-extrabold uppercase text-center tracking-widest">
                                    DÉTAILS
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $favorites->links() }}
            </div>
        </div>
    </div>
@endsection