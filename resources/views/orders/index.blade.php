<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                <div class="text-2xl font-bold text-gray-900">Local<span class="text-orange-500">Market</span></div>
            </a>
            <nav class="flex gap-6">
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-500">Products</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-orange-500">Cart</a>
                <a href="{{ route('orders.index') }}" class="text-orange-500 font-bold">Orders</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">My Orders</h1>

    @if($orders->isEmpty())
        <div class="text-center bg-white rounded-lg shadow p-8">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg">No orders found. Start shopping!</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600 hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Order #{{ $order->id }}</h2>
                            <p class="text-gray-600 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($order->status === 'on_hold') bg-yellow-100 text-yellow-700
                            @elseif($order->status === 'delivered') bg-green-100 text-green-700
                            @elseif($order->status === 'paid') bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-600 text-sm"><strong>Customer:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm"><strong>Items:</strong> {{ $order->items->count() }}</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">Total Amount</p>
                            <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                        </div>
                        <a href="{{ route('orders.show', $order) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-16 py-8">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; 2026 LocalMarket. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
