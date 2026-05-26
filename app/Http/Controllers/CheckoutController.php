<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Ton panier est vide.');
        }

        $cart->load('items.article');
        $coupon = session('coupon');

        $subtotal = $cart->total;
        $discount = $coupon ? $coupon['discount'] : 0;
        $total = max(0, $subtotal - $discount);

        return view('checkout.index', compact('cart', 'coupon', 'subtotal', 'discount', 'total'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Ton panier est vide.');
        }

        $cart->load('items.article');
        $couponSession = session('coupon');
        $subtotal = $cart->total;
        $discount = 0;
        $couponId = null;

        if ($couponSession) {
            $coupon = Coupon::find($couponSession['id']);
            if ($coupon && $coupon->isValid($subtotal)) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
                $coupon->increment('used_count');
            }
        }

        $total = max(0, $subtotal - $discount);

        DB::transaction(function () use ($cart, $total, $couponId, $discount) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending',
                'coupon_id' => $couponId,
                'discount_amount' => $discount,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'article_id' => $item->article_id,
                    'quantity' => $item->quantity,
                    'price' => $item->article->prix,
                ]);
            }

            // Clear cart
            $cart->items()->delete();
        });

        session()->forget('coupon');

        return redirect()->route('dashboard.orders')->with('success', 'Commande passée avec succès !');
    }
}
