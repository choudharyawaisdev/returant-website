<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add a menu item to the cart.
     */
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

        // Check if item already exists
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

    /**
     * Remove a menu item from the cart.
     */
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

    /**
     * Get the current cart contents (for initial load and offcanvas update).
     */
    public function getCart()
    {
        $cart = session()->get('cart', []);
        $totalItems = collect($cart)->sum('quantity');
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        return response()->json([
            'cart' => array_values($cart), // Convert associative array to indexed for easy JS loop
            'cartCount' => $totalItems,
            'subtotal' => $subtotal,
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            // Redirect back to the menu or cart page if the cart is empty
            return redirect()->route('menu')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        // Calculate totals
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        // Optional: Define fixed delivery fee (you can make this dynamic later)
        $deliveryFee = 150; 
        
        $total = $subtotal + $deliveryFee;

        return view('checkout.index', compact('cart', 'subtotal', 'deliveryFee', 'total'));
    }

    /**
     * Handle the submission of the checkout form (simulated order placement).
     */
    public function placeOrder(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:500', // Added address field for delivery
            'special_instructions' => 'nullable|string|max:1000',
        ]);

        // 2. Process Order (In a real app, this is where you save to DB, handle payment, send emails, etc.)
        $cart = session()->get('cart', []);
        
        // Example: Log the order data
        \Log::info('New Order Placed:', [
            'customer_details' => $request->only(['name', 'mobile_number', 'email', 'address', 'special_instructions']),
            'order_items' => $cart,
            'timestamp' => now(),
        ]);

        // 3. Clear the cart session
        session()->forget('cart');

        // 4. Redirect to a success page
        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully! We will contact you shortly.');
    }
}