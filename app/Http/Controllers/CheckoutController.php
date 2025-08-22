<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->where('is_active', true)->with('product.brand')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'payment_method' => 'required|in:cod,bkash',
        ]);

        $order = new Order;

        $user = Auth::user();
        $cartItems = $user->carts()->where('is_active', true)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::transaction(function () use ($user, $cartItems, $subtotal, $request, $order) {

            // Create Order
            $order = $order::create([
                'order_no' => 'ORD-' . Str::upper(Str::random(8)),
                'user_id' => $user->id,
                'total_amount' => $subtotal,
                'delivery_address' => $request->delivery_address,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                $product = $item->product;

                if ($product->stock < $item->quantity) {
                    throw new \Exception("Product {$product->name} is out of stock.");
                }

                // Create Order Item with quantity and price
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                ]);

                // Decrease stock
                $product->decrement('stock', $item->quantity);
            }

            // Clear Cart
            $user->carts()->where('is_active', true)->delete();
        });
        $admins = User::where('role', 'admin')->get();

        Notification::make()
            ->title('You received a new order')
            ->body("A new order (#{$order->order_no}) has been placed.")
            ->success()
            ->sendToDatabase($admins);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}
