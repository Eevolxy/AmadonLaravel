<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('status', '!=', 'cancelled')->sum('total');

        return view('dashboard.index', compact('user', 'recentOrders', 'totalOrders', 'totalSpent'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);

        return view('dashboard.orders', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.article', 'coupon');

        return view('dashboard.order-detail', compact('order'));
    }
}
