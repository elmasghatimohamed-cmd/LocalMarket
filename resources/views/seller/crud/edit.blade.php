<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding: 40px; color: #333; }
    .form-container { max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-top: 5px solid #ff8c00; }
    .form-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
    .form-header h2 { margin: 0; color: #ff8c00; font-size: 28px; }
    .current-img-hint { font-size: 12px; color: #888; margin-top: 5px; }
    .error-alert { background: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 25px; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .full-width { grid-column: 1 / -1; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; box-sizing: border-box; }
    .btn-update { background: #ff8c00; color: white; border: none; padding: 15px; border-radius: 10px; font-size: 16px; font-weight: 700; cursor: pointer; width: 100%; transition: 0.3s; }
    .btn-update:hover { background: #e67e00; }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Product</h2>
        <a href="{{ route('seller.crud.index') }}" style="color: #888; text-decoration: none; font-size: 14px;">Back to list</a>
    </div>

    @if ($errors->any())
        <div class="error-alert">
            <ul style="margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group full-width">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Update Image</label>
                <input type="file" name="image" accept="image/*">
                <p class="current-img-hint">Leave empty to keep current image</p>
            </div>

            <div class="form-group">
                <label>Price ($)</label>
                <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required>
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" rows="4">{{ $product->description }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn-update">Update Product Details</button>
    </form>
</div>