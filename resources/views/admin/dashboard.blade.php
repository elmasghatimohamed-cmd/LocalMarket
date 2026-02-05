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
                <button id="apply-role-changes" class="btn btn-sm btn-success" disabled style="display:none;">Apply role
                    changes</button>
                <div id="role-change-toast" class="ml-4 text-sm text-green-700" style="display:none;"></div>
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
        @role('admin')
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
                                    <form method="POST" action="{{ route('admin.role_switcher.update', $user) }}"
                                        class="flex items-center gap-2 role-change-form">
                                        @csrf
                                        <select name="role" class="border rounded px-2 py-1 role-select">
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                                    {{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary">OK</button>
                                    </form>
                                    <div class="mt-2 role-change-status text-sm text-green-600" style="display:none;"></div>
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
        @endrole
    </div>

@endsection

@push('modals')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const applyBtn = document.getElementById('apply-role-changes');
            const toast = document.getElementById('role-change-toast');
            const pending = new Map();

            function updateApplyButton() {
                if (pending.size > 0) {
                    applyBtn.disabled = false;
                    applyBtn.style.display = '';
                } else {
                    applyBtn.disabled = true;
                    applyBtn.style.display = 'none';
                }
            }

            document.querySelectorAll('form.role-change-form').forEach(function (form) {
                const select = form.querySelector('select.role-select');
                const statusEl = form.parentElement.querySelector('.role-change-status');
                const action = form.getAttribute('action');
                const userId = action.split('/').pop();

                select.addEventListener('change', function () {
                    pending.set(userId, { action, role: select.value, statusEl });
                    statusEl.style.display = 'block';
                    statusEl.textContent = 'Pending change: ' + select.value;
                    updateApplyButton();
                });

                // prevent default form submission to avoid redirect
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // apply this single change immediately
                    pending.set(userId, { action, role: select.value, statusEl });
                    applyChanges();
                });
            });

            function showToast(message) {
                toast.textContent = message;
                toast.style.display = 'inline-block';
                setTimeout(() => { toast.style.display = 'none'; }, 3000);
            }

            async function applyChanges() {
                if (pending.size === 0) return;
                applyBtn.disabled = true;
                let successCount = 0;

                for (const [userId, info] of Array.from(pending.entries())) {
                    try {
                        const body = new URLSearchParams();
                        body.append('role', info.role);

                        const res = await fetch(info.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            body: body.toString()
                        });

                        if (res.ok) {
                            const json = await res.json();
                            // update UI
                            info.statusEl.textContent = 'Updated to ' + info.role;
                            const badge = info.statusEl.parentElement.querySelector('span');
                            if (badge) badge.textContent = info.role;
                            pending.delete(userId);
                            successCount++;
                        } else {
                            const text = await res.text();
                            info.statusEl.textContent = 'Error';
                            console.error('Error updating role:', text);
                        }
                    } catch (err) {
                        info.statusEl.textContent = 'Error';
                        console.error(err);
                    }
                }

                updateApplyButton();
                if (successCount > 0) showToast(successCount + ' role(s) updated.');
            }

            applyBtn.addEventListener('click', function () {
                applyChanges();
            });
        });
    </script>
@endpush