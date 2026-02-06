<!DOCTYPE html>
<html lang="en" class="bg-[#080808] text-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Protech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-tech { font-family: 'Orbitron', sans-serif; }
        
        input[type="file"]::file-selector-button {
            background-color: #222;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            margin-right: 15px;
            cursor: pointer;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="p-4 md:p-12">

<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="font-tech text-2xl md:text-3xl tracking-widest uppercase mb-1">
                <i class="fas fa-edit text-[#DFFF00] mr-2"></i> Edit Product
            </h2>
            <p class="text-gray-500 text-[11px] uppercase tracking-tight">System / Inventory / Modify Item</p>
        </div>
        <a href="{{ route('seller.crud.index') }}" class="text-gray-500 hover:text-white text-xs font-bold uppercase tracking-widest transition-colors">
            <i class="fas fa-xmark mr-1"></i> Cancel
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border-l-2 border-red-500 p-4 rounded-r-xl mb-8">
            <ul class="text-red-500 text-xs font-bold space-y-1">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-triangle-exclamation mr-2"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-[#141414] border border-[#222] p-6 md:p-10 rounded-[32px] shadow-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">Product Identifier</label>
                    <input type="text" name="name" value="{{ $product->name }}" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">System Category</label>
                    <select name="category_id" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none cursor-pointer">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">Market Price ($)</label>
                    <input type="number" name="price" step="0.01" value="{{ $product->price }}" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none font-bold">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">Inventory Count</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none font-bold">
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">Visual Media</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-2 py-2 text-sm text-gray-500 file:font-bold">
                    <p class="text-[9px] text-gray-600 mt-2 uppercase italic tracking-tighter">Current asset will persist if no file is selected.</p>
                </div>

<<<<<<< HEAD
                <div class="md:col-span-2">
                    <label class="block text-[10px] uppercase tracking-[0.2em] text-gray-500 font-extrabold mb-3">Product Specifications</label>
                    <textarea name="description" rows="3" 
                        class="w-full bg-[#0A0A0A] border border-[#222] rounded-xl px-4 py-4 text-sm focus:border-[#DFFF00] outline-none transition-all resize-none">{{ $product->description }}</textarea>
                </div>
=======
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" rows="4">{{ $product->description }}</textarea>
>>>>>>> 2c140ae8550e1d96f6dff8d9a2b2d3bb54591d72
            </div>
        </div>

        <button type="submit" 
            class="w-full bg-[#DFFF00] text-black py-5 rounded-2xl font-extrabold uppercase tracking-[0.2em] text-sm hover:scale-[1.01] active:scale-[0.99] transition-all shadow-[0_20px_40px_rgba(223,255,0,0.1)]">
            Commit Changes
        </button>
    </form>
</div>

</body>
</html>