<h2>Add Product</h2>

<form method="POST" action="{{ route('seller.crud.store') }}">
    @csrf

    <label class="block mb-2 font-semibold">Category</label>

    <select name="category_id" class="w-full border rounded p-2" required>
        <option value="">-- Choose category --</option>

        @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    <br><br>


    <input type="text" name="name" placeholder="Product name"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="price" step="0.01" placeholder="Price"><br><br>

    <input type="number" name="stock" placeholder="Stock"><br><br>

    <button type="submit">Save</button>
</form>