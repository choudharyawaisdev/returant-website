<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $itemData = $request->only(['id', 'title', 'price', 'image', 'quantity']);
        $cart = session()->get('cart', []);

        if (isset($cart[$itemData['id']])) {
            $cart[$itemData['id']]['quantity'] += $itemData['quantity'];
        } else {
            $cart[$itemData['id']] = $itemData;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart!',
            'cartCount' => collect($cart)->sum('quantity'),
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cartCount' => collect($cart)->sum('quantity'),
            'cart' => $cart,
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart item quantity updated!',
                'cartCount' => collect($cart)->sum('quantity'),
                'cart' => $cart,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        $totalItems = collect($cart)->sum('quantity');
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return response()->json([
            'cart' => array_values($cart),
            'cartCount' => $totalItems,
            'subtotal' => $subtotal,
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $deliveryFee = 150; 
        
        $total = $subtotal + $deliveryFee;

        return view('checkout.index', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:500',
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);
        
        \Log::info('New Order Placed:', [
            'customer_details' => $request->only(['name', 'mobile_number', 'email', 'address', 'special_instructions']),
            'order_items' => $cart,
            'timestamp' => now(),
        ]);

        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully! We will contact you shortly.');
    }
}