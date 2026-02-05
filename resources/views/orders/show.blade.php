<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }}</title>
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
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($order->status === 'on_hold') bg-yellow-100 text-yellow-700
                    @elseif($order->status === 'delivered') bg-green-100 text-green-700
                    @elseif($order->status === 'paid') bg-blue-100 text-blue-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Order Date</p>
                    <p class="text-gray-900 text-lg">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Customer</p>
                    <p class="text-gray-900 text-lg">{{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Email</p>
                    <p class="text-gray-900 text-lg">{{ $order->user->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Order Items</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Product</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Quantity</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Price</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4">
                                    <div class="text-gray-900 font-medium">{{ $item->product->name ?? 'Product' }}</div>
                                    <div class="text-gray-600 text-sm">SKU: #{{ $item->product_id }}</div>
                                </td>
                                <td class="py-3 px-4 text-gray-700">{{ $item->quantity }}</td>
                                <td class="py-3 px-4 text-gray-700">${{ number_format($item->price, 2) }}</td>
                                <td class="py-3 px-4 text-gray-900 font-semibold">${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="flex justify-end mb-8">
            <div class="w-full md:w-96">
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex justify-between mb-3 pb-3 border-b border-gray-200">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="text-gray-900">${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-3 pb-3 border-b border-gray-200">
                        <span class="text-gray-700">Shipping</span>
                        <span class="text-gray-900">Free</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold">
                        <span class="text-gray-900">Total</span>
                        <span class="text-blue-600">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Payment Status</h3>
            <p class="text-blue-800">
                <strong>Status:</strong> {{ ucfirst($order->payment_status) }}
            </p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-16 py-8">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; 2026 LocalMarket. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
