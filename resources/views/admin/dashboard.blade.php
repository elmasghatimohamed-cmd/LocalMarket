@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Total Users</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Total Products</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_products'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Total Orders</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['total_orders'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Total Revenue</h3>
            <p class="text-3xl font-bold text-orange-600">${{ number_format($stats['total_revenue'], 2) }}</p>
        </div>
    </div>

    <!-- Order Status Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">On Hold Orders</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_orders'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Delivered Orders</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['completed_orders'] }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-medium">Total Categories</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_categories'] }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">Add Category</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary">Manage Categories</a>
            <a href="{{ route('admin.role_switcher') }}" class="btn btn-sm btn-warning">User Roles</a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-2">Order ID</th>
                        <th class="text-left p-2">User</th>
                        <th class="text-left p-2">Total</th>
                        <th class="text-left p-2">Status</th>
                        <th class="text-left p-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2">#{{ $order->id }}</td>
                            <td class="p-2">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="p-2">${{ number_format($order->total, 2) }}</td>
                            <td class="p-2">
                                <span class="px-3 py-1 rounded text-sm font-semibold
                                    @if($order->status === 'on_hold') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="p-2">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Users</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-2">Name</th>
                        <th class="text-left p-2">Email</th>
                        <th class="text-left p-2">Role</th>
                        <th class="text-left p-2">Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2">{{ $user->name }}</td>
                                <td class="p-2">{{ $user->email }}</td>
                                <td class="p-2">
                                    <form method="POST" action="{{ route('admin.role_switcher.update', $user) }}" class="flex items-center gap-2">
                                        @csrf
                                        <select name="role" class="border rounded px-2 py-1">
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary">OK</button>
                                    </form>
                                    <div class="mt-2">
                                        <span class="px-3 py-1 rounded text-sm font-semibold bg-blue-100 text-blue-800">
                                            {{ $user->roles->pluck('name')->join(', ') ?: 'No role' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-2">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
