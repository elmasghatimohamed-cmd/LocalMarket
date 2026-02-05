<!DOCTYPE html>
<html lang="en" class="bg-[#080808] text-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-tech { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="p-4 md:p-8">

<div class="max-w-6xl mx-auto">
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="font-tech text-2xl md:text-3xl tracking-wider uppercase">Inventory</h1>
            <p class="text-gray-400 text-sm mt-1">Welcome back! Managing <span class="text-white font-bold">{{ $products->count() }}</span> listings.</p>
        </div>
        <a href="{{ route('seller.products.create') }}" 
           class="bg-[#DFFF00] text-black px-8 py-3 rounded-full font-extrabold text-xs uppercase tracking-tight hover:scale-105 transition-transform shadow-[0_0_20px_rgba(223,255,0,0.2)]">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </header>

    <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
        <div class="bg-[#141414] border border-[#222] p-5 rounded-2xl flex items-center gap-4">
            <div class="bg-[#DFFF00]/5 p-3 rounded-xl text-[#DFFF00]"><i class="fas fa-box-archive text-xl"></i></div>
            <div><span class="text-[10px] uppercase tracking-widest text-gray-500 block">Total Items</span><b class="text-xl">{{ $products->count() }}</b></div>
        </div>
        <div class="bg-[#141414] border border-[#222] p-5 rounded-2xl flex items-center gap-4">
            <div class="bg-[#DFFF00]/5 p-3 rounded-xl text-[#DFFF00]"><i class="fas fa-signal text-xl"></i></div>
            <div><span class="text-[10px] uppercase tracking-widest text-gray-500 block">Status</span><b class="text-xl">Live</b></div>
        </div>
        <div class="bg-[#141414] border border-[#222] p-5 rounded-2xl flex items-center gap-4">
            <div class="bg-[#DFFF00]/5 p-3 rounded-xl text-[#DFFF00]"><i class="fas fa-bolt text-xl"></i></div>
            <div><span class="text-[10px] uppercase tracking-widest text-gray-500 block">System</span><b class="text-xl">Fast</b></div>
        </div>
    </section>

    <main class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <article class="bg-[#141414] border border-[#222] rounded-[24px] overflow-hidden group hover:border-[#DFFF00] transition-all flex flex-col relative h-fit">
                @if($product->stock < 5)
                    <div class="absolute top-4 left-4 bg-[#DFFF00] text-black text-[10px] font-extrabold px-3 py-1 rounded-md z-10 uppercase">Low Stock</div>
                @endif
                @if(isset($product->status) && $product->status !== 'active')
                    <div class="badge" style="left:auto; right:12px; background:#6b7280;">Inactive</div>
                @endif
                
                <div class="w-full h-40 bg-[#111] flex items-center justify-center p-6 overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="max-h-full object-contain drop-shadow-2xl group-hover:scale-110 transition-transform duration-500">
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h4 class="text-sm font-semibold h-10 overflow-hidden line-clamp-2 mb-4 leading-snug group-hover:text-[#DFFF00] transition-colors">
                        {{ $product->name }}
                    </h4>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-[#222]">
                        <span class="text-xl font-extrabold">${{ number_format($product->price, 2) }}</span>
                        <span class="text-[10px] text-gray-400 border border-[#222] px-2 py-1 rounded-md font-bold uppercase tracking-tighter">QTY: {{ $product->stock }}</span>
                    </div>

                    <div class="grid grid-cols-[1fr_48px] gap-2 mt-4">
                        <a href="{{ route('seller.products.edit', $product->id) }}" 
                           class="bg-[#222] hover:bg-transparent hover:border-[#DFFF00] hover:text-[#DFFF00] border border-transparent text-[10px] font-extrabold text-center py-3 rounded-xl uppercase tracking-widest transition-all">
                            Edit Product
                        </a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}" class="contents">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Delete item?')"
                                    class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-trash-can text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-20 bg-[#141414] rounded-3xl border border-dashed border-[#222]">
                <i class="fas fa-box-open text-5xl text-[#222] mb-4"></i>
                <p class="text-gray-500 font-semibold">Your inventory is currently empty.</p>
            </div>
        @endforelse
    </main>
</div>

</body>
</html>