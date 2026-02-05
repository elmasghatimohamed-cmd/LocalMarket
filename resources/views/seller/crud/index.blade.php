<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; color: #333; margin: 0; padding: 20px; }
    .container { max-width: 1200px; margin: 0 auto; }

    /* --- New: Dashboard Header Card --- */
    .seller-welcome {
        background: linear-gradient(135deg, #ff8c00 0%, #ff5f00 100%);
        border-radius: 15px;
        padding: 30px;
        color: white;
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 20px rgba(255, 95, 0, 0.2);
    }
    .seller-welcome h1 { margin: 0; font-size: 24px; }
    .seller-welcome p { opacity: 0.9; margin: 5px 0 0; }

    /* --- Stats Section --- */
    .stats-bar {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        padding: 15px 25px;
        border-radius: 12px;
        flex: 1;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid #e0e0e0;
    }
    .stat-card i { color: #ff8c00; font-size: 20px; }
    .stat-card div b { display: block; font-size: 18px; }
    .stat-card div span { font-size: 12px; color: #888; }

    /* --- Product Grid --- */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
    }

    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #eee;
    }
    .product-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

    /* Badge Style */
    .badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #ff8c00;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        z-index: 10;
    }

    .image-container { width: 100%; height: 180px; overflow: hidden; background: #f9f9f9; }
    .image-container img { width: 100%; height: 100%; object-fit: cover; }

    .card-content { padding: 15px; }
    .card-content h4 { margin: 0 0 10px; font-size: 16px; color: #2d3436; }
    
    .price-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .price { font-size: 18px; font-weight: 700; color: #ff8c00; }
    .stock-label { font-size: 12px; color: #636e72; background: #f1f2f6; padding: 3px 8px; border-radius: 4px; }

    /* Styled Buttons */
    .actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .btn-edit { 
        text-align: center; text-decoration: none; padding: 10px; 
        border-radius: 8px; font-size: 13px; font-weight: 600;
        background: #fff3e0; color: #ff8c00; transition: 0.2s;
    }
    .btn-edit:hover { background: #ff8c00; color: white; }
    
    .btn-delete {
        padding: 10px; border-radius: 8px; border: none;
        background: #fff0f0; color: #ff4757; font-weight: 600; cursor: pointer;
    }
    .btn-delete:hover { background: #ff4757; color: white; }
</style>

<div class="container">
    <div class="seller-welcome">
        <div>
            <h1>Manage Your Inventory</h1>
            <p>Welcome back! You have {{ $products->count() }} active products.</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="btn-add" style="background: white; color: #ff8c00; padding: 12px 25px; border-radius: 10px; text-decoration: none; font-weight: bold;">
            + Add New Product
        </a>
    </div>

    <div class="stats-bar">
        <div class="stat-card">
            <i class="fas fa-box"></i>
            <div><b>{{ $products->count() }}</b><span>Total Items</span></div>
        </div>
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <div><b>Active</b><span>Store Status</span></div>
        </div>
        <div class="stat-card">
            <i class="fas fa-wallet"></i>
            <div><b>Orange</b><span>Theme Active</span></div>
        </div>
    </div>

    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                @if($product->stock < 5)
                    <div class="badge">Low Stock</div>
                @endif
                
                <div class="image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>

                <div class="card-content">
                    <h4>{{ $product->name }}</h4>
                    
                    <div class="price-row">
                        <span class="price">${{ number_format($product->price, 2) }}</span>
                        <span class="stock-label">Stock: {{ $product->stock }}</span>
                    </div>

                    <div class="actions">
                        <a href="{{ route('seller.products.edit', $product->id) }}" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}" style="display:contents">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px; background: white; border-radius: 15px;">
                <i class="fas fa-shopping-basket" style="font-size: 50px; color: #ddd; margin-bottom: 15px;"></i>
                <p style="color: #999;">No products found. Start by adding your first item!</p>
            </div>
        @endforelse
    </div>
</div>