<h2>My Products</h2>

<a href="{{ route('seller.products.create') }}">+ Add Product</a>

@foreach($products as $product)
    <div style="border:1px solid #ccc; margin:10px; padding:10px">
        <h4>{{ $product->name }}</h4>
        <p>{{ $product->description }}</p>
        <p>Price: {{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>

        <form method="POST" action="{{ route('seller.products.destroy', $product->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
