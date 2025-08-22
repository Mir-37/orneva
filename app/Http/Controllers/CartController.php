<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->get();

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login to add items to cart.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);

        if ($product->stock < $request->input('quantity')) return redirect()->back()->with('success', 'Stock out!');

        // Check if product already in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->where('is_active', true)
            ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create new entry
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }


        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}
