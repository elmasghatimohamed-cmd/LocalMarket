@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-slate-900">Dashboard</h1>
                <p class="text-slate-600 mt-2">Welcome back! Here's your business overview.</p>
            </div>

            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Users Card -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Products Card -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Products</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_products'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Orders</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_orders'] }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Revenue</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">
                                ${{ number_format($stats['total_revenue'], 2) }}</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Pending Orders -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Pending Orders</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['pending_orders'] }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Delivered Orders -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Delivered Orders</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['completed_orders'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Categories</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $stats['total_categories'] }}</p>
                        </div>
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8 mb-12">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Quick Actions</h2>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.categories.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">+
                        Add Category</a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-4 py-2 bg-slate-200 text-slate-900 rounded-lg hover:bg-slate-300 transition font-medium text-sm">Manage
                        Categories</a>
                    <a href="{{ route('admin.role_switcher') }}"
                        class="px-4 py-2 bg-slate-200 text-slate-900 rounded-lg hover:bg-slate-300 transition font-medium text-sm">All
                        Users Roles</a>
                    <button id="apply-role-changes"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled style="display:none;">✓ Apply Changes</button>
                    <div id="role-change-toast" class="ml-4 text-sm text-green-700 font-medium" style="display:none;"></div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8 mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Recent Orders</h2>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Order ID</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Customer</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Amount</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Status</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_orders as $order)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-3 px-4 text-slate-900 font-medium">#{{ $order->id }}</td>
                                    <td class="py-3 px-4 text-slate-700">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-slate-900 font-semibold">${{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold inline-block
                                                @if($order->status === 'on_hold') bg-yellow-100 text-yellow-700
                                                @elseif($order->status === 'delivered') bg-green-100 text-green-700
                                                @elseif($order->status === 'paid') bg-blue-100 text-blue-700
                                                @else bg-slate-100 text-slate-700 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Users Section -->
            @role('admin')
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Recent Users</h2>
                    <a href="{{ route('admin.role_switcher') }}"
                        class="text-sm text-blue-600 hover:text-blue-700 font-medium">Manage All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Name</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Email</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Role Management</th>
                                <th class="text-left py-3 px-4 text-slate-700 font-semibold text-sm">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_users as $user)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-3 px-4 text-slate-900 font-medium">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        <form method="POST" action="{{ route('admin.role_switcher.update', $user) }}"
                                            class="flex items-center gap-2 role-change-form">
                                            @csrf
                                            <select name="role"
                                                class="role-select border border-slate-300 rounded-lg px-3 py-2 text-sm font-medium bg-white hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit"
                                                class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">Save</button>
                                        </form>
                                        <div class="mt-2 role-change-status text-xs text-green-600 font-medium"
                                            style="display:none;"></div>
                                        <div class="mt-2">
                                            <span
                                                class="px-3 py-1.5 rounded-full text-xs font-semibold inline-block bg-slate-200 text-slate-700">
                                                {{ $user->roles->pluck('name')->map('ucfirst')->join(', ') ?: 'No role' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endrole
        </div>
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

            function showToast(message) {
                toast.innerHTML = '✓ ' + message;
                toast.style.display = 'inline-block';
                setTimeout(() => { toast.style.display = 'none'; }, 4000);
            }

            document.querySelectorAll('form.role-change-form').forEach(function (form) {
                const select = form.querySelector('select.role-select');
                const statusEl = form.closest('td').querySelector('.role-change-status');
                const action = form.getAttribute('action');
                const userId = action.split('/').pop();
                const initialRole = select.value;

                select.addEventListener('change', function () {
                    if (select.value !== initialRole) {
                        pending.set(userId, { action, role: select.value, statusEl, form });
                        statusEl.style.display = 'block';
                        statusEl.textContent = '⏳ Pending: ' + select.value;
                        updateApplyButton();
                    } else {
                        pending.delete(userId);
                        statusEl.style.display = 'none';
                        updateApplyButton();
                    }
                });

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    pending.set(userId, { action, role: select.value, statusEl, form });
                    applyChanges();
                });
            });

            async function applyChanges() {
                if (pending.size === 0) return;
                applyBtn.disabled = true;
                let successCount = 0;
                let errorCount = 0;

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
                            info.statusEl.textContent = '✓ Updated to ' + info.role;
                            info.statusEl.style.color = '#059669';
                            const badge = info.form.closest('td').querySelector('span');
                            if (badge) {
                                badge.textContent = info.role.charAt(0).toUpperCase() + info.role.slice(1);
                                badge.classList.remove('bg-slate-200', 'text-slate-700');
                                badge.classList.add('bg-green-200', 'text-green-800');
                            }
                            pending.delete(userId);
                            successCount++;
                            setTimeout(() => {
                                info.statusEl.style.display = 'none';
                            }, 2000);
                        } else {
                            const text = await res.text();
                            info.statusEl.textContent = '✗ Error';
                            info.statusEl.style.color = '#dc2626';
                            errorCount++;
                            console.error('Error updating role:', text);
                        }
                    } catch (err) {
                        info.statusEl.textContent = '✗ Error';
                        info.statusEl.style.color = '#dc2626';
                        errorCount++;
                        console.error(err);
                    }
                }

                updateApplyButton();
                if (successCount > 0) {
                    showToast(successCount + ' role' + (successCount > 1 ? 's' : '') + ' updated successfully');
                }
                if (errorCount > 0) {
                    showToast(errorCount + ' error' + (errorCount > 1 ? 's' : '') + ' occurred');
                }
            }

            applyBtn.addEventListener('click', function () {
                applyChanges();
            });
        });
    </script>
@endpush