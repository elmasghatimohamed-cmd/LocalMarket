<!DOCTYPE html>
<html lang="en" class="bg-[#080808] text-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | Protech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-tech { font-family: 'Orbitron', sans-serif; }
        
        /* Custom styling for file input */
        input[type="file"]::file-selector-button {
            background-color: #222;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            margin-right: 15px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
        }
        input[type="file"]::file-selector-button:hover { background-color: #333; }
    </style>
</head>
<body class="p-4 md:p-12">

<div class="max-w-3xl mx-auto">
    <a href="{{ route('seller.crud.index') }}" class="inline-flex items-center text-gray-500 hover:text-[#DFFF00] transition-colors mb-8 text-sm font-bold uppercase tracking-widest">
        <i class="fas fa-arrow-left mr-2"></i> Back to Inventory
    </a>

    <div class="mb-10">
        <h2 class="font-tech text-2xl md:text-3xl tracking-widest uppercase mb-2">
            <i class="fas fa-plus-circle text-[#DFFF00] mr-2"></i> Add New Product
        </h2>
        <p class="text-gray-400 text-sm">Fill in the technical specifications for your new listing.</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border-l-4 border-red-500 p-4 rounded-r-xl mb-8">
            <ul class="list-disc list-inside text-red-500 text-sm font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-[#141414] border border-[#222] p-6 md:p-10 rounded-[32px] shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Product Name</label>
                    <input type="text" name="name" placeholder="e.g. QuietComfort Ultra" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] focus:ring-1 focus:ring-[#DFFF00] outline-none transition-all placeholder:text-gray-700">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Category</label>
                    <select name="category_id" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all appearance-none cursor-pointer">
                        <option value="" class="text-gray-600">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Product Image</label>
                    <input type="file" name="image" accept="image/*" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-2 py-2 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#222] file:text-white hover:file:bg-[#333] transition-all">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Price (USD)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold">$</span>
                        <input type="number" name="price" step="0.01" placeholder="0.00" required
                            class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl pl-8 pr-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Stock Quantity</label>
                    <input type="number" name="stock" placeholder="0" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500 font-extrabold mb-3">Description</label>
                    <textarea name="description" rows="4" placeholder="Enter technical details and features..."
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all placeholder:text-gray-700 resize-none"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" 
            class="w-full bg-[#DFFF00] text-black py-5 rounded-2xl font-extrabold uppercase tracking-[0.2em] text-sm hover:scale-[1.02] active:scale-[0.98] transition-all shadow-[0_20px_40px_rgba(223,255,0,0.15)]">
            Create Product Listing
        </button>
    </form>
</div>

</body>
</html>