<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding: 40px; color: #333; }
    .form-container { max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-top: 5px solid #ff8c00; }
    .form-header { margin-bottom: 30px; }
    .form-header h2 { margin: 0; color: #ff8c00; font-size: 28px; }
    .error-alert { background: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 25px; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .full-width { grid-column: 1 / -1; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; font-size: 14px; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; box-sizing: border-box; }
    .form-group input:focus { border-color: #ff8c00; outline: none; box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.1); }
    .btn-save { background: #ff8c00; color: white; border: none; padding: 15px; border-radius: 10px; font-size: 16px; font-weight: 700; cursor: pointer; width: 100%; transition: 0.3s; }
    .btn-save:hover { background: #e67e00; }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-plus-circle"></i> Add New Product</h2>
        <p>Enter the details to list a new item in your store.</p>
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

    <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group full-width">
                <label>Product Name</label>
                <input type="text" name="name" placeholder="e.g. Fresh Organic Apples" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">-- Choose Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label>Price ($)</label>
                <input type="number" name="price" step="0.01" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stock" placeholder="Quantity in hand" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Describe your product..."></textarea>
            </div>
        </div>

        <button type="submit" class="btn-save">Save Product</button>
    </form>
</div>