<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function calculateItemPrice($basePrice, $sizeExtra, $addOns)
    {
        $price = $basePrice + $sizeExtra;
        
        foreach ($addOns as $addOn) {
            $price += $addOn['price'];
        }

        return $price;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'title' => 'required|string',
            'image' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'size_id' => 'nullable|integer',
            'size_name' => 'nullable|string',
            'add_ons_json' => 'nullable|string',
        ]);

        $menuId = $request->menu_id;
        $quantity = (int)$request->quantity;
        $basePrice = (float)$request->base_price;
        $sizeId = $request->size_id ?? 0;
        $sizeName = $request->size_name;
        $addOns = $request->add_ons_json ? json_decode($request->add_ons_json, true) : [];
        
        $addOnIds = $addOns ? implode('-', array_column($addOns, 'id')) : '';
        $configKey = $menuId . '_' . $sizeId . '_' . $addOnIds;

        $cart = session()->get('cart', []);
        
        $itemTotalConfigPrice = $basePrice;
        
        foreach ($addOns as $addOn) {
            $itemTotalConfigPrice += (float)$addOn['price'];
        }
        
        $price = $itemTotalConfigPrice;

        $newItem = [
            'configKey' => $configKey,
            'menu_id' => $menuId,
            'title' => $request->title,
            'image' => $request->image,
            'price' => $price,
            'quantity' => $quantity,
            'size_id' => $sizeId,
            'size_name' => $sizeName,
            'add_ons' => $addOns,
        ];


        if (isset($cart[$configKey])) {
            $cart[$configKey]['quantity'] += $quantity;
        } else {
            $cart[$configKey] = $newItem;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart!',
            'cartCount' => collect($cart)->sum('quantity'),
        ]);
    }

    public function removeFromCart(Request $request, $configKey)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$configKey])) {
            unset($cart[$configKey]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cartCount' => collect($cart)->sum('quantity'),
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'configKey' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $configKey = $request->configKey;
        $quantity = (int)$request->quantity;

        if (isset($cart[$configKey])) {
            $cart[$configKey]['quantity'] = $quantity;
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart item quantity updated!',
                'cartCount' => collect($cart)->sum('quantity'),
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
            'subtotal' => round($subtotal, 2),
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

        $cartItems = array_values($cart); 

        return view('checkout.index', compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
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
            'order_items' => array_values($cart), 
            'timestamp' => now(),
        ]);

        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully! We will contact you shortly.');
    }
}