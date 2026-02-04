<h2>Add Product</h2>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <input type="number" name="category_id" placeholder="Category ID"><br><br>

    <input type="text" name="name" placeholder="Product name"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="price" step="0.01" placeholder="Price"><br><br>

    <input type="number" name="stock" placeholder="Stock"><br><br>

    <button type="submit">Save</button>
</form>
