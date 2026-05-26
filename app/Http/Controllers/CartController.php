<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get or create the cart for the current user/session.
     */
    private function getCart(): Cart
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        }

        return $cart;
    }

    /**
     * Display the cart.
     */
    public function index()
    {
        $cart = $this->getCart();
        $cart->load('items.article');
        $coupon = session('coupon');

        return view('cart.index', compact('cart', 'coupon'));
    }

    /**
     * Add an article to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        $cartItem = $cart->items()->where('article_id', $request->article_id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'article_id' => $request->article_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }

    /**
     * Apply a coupon code to the cart.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return redirect()->route('cart.index')->with('error', 'Code promo introuvable.');
        }

        $cart = $this->getCart();
        $cart->load('items.article');

        if (!$coupon->isValid($cart->total)) {
            return redirect()->route('cart.index')->with('error', 'Ce code promo n\'est pas valide ou a expiré.');
        }

        session(['coupon' => [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'discount' => $coupon->calculateDiscount($cart->total),
        ]]);

        return redirect()->route('cart.index')->with('success', 'Code promo appliqué !');
    }

    /**
     * Remove the applied coupon.
     */
    public function removeCoupon()
    {
        session()->forget('coupon');

        return redirect()->route('cart.index')->with('success', 'Code promo retiré.');
    }

    /**
     * Merge guest cart into user cart on login.
     */
    public static function mergeGuestCart(): void
    {
        $sessionId = session()->getId();
        $guestCart = Cart::where('session_id', $sessionId)->first();

        if (!$guestCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        foreach ($guestCart->items as $guestItem) {
            $existingItem = $userCart->items()->where('article_id', $guestItem->article_id)->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $guestItem->quantity);
            } else {
                $userCart->items()->create([
                    'article_id' => $guestItem->article_id,
                    'quantity' => $guestItem->quantity,
                ]);
            }
        }

        $guestCart->delete();
    }
}
