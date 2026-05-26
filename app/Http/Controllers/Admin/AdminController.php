<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'totalProducts' => Article::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'totalRevenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'activeCoupons' => Coupon::where('is_active', true)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
