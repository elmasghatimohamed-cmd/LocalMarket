<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total') ?? 0,
            'pending_orders' => Order::where('status', 'on_hold')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
        ];

        $recent_orders = Order::latest()->take(10)->get();
        $recent_users = User::latest()->take(10)->get();
        $roles = \Spatie\Permission\Models\Role::pluck('name');
        $product_stats = Product::selectRaw('category_id, COUNT(*) as count')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_users', 'product_stats', 'roles'));
    }
}
