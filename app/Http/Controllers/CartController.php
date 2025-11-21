<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;       
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
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
            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 0;
            return $price * $quantity;
        });
        
        $deliveryFee = 150;
        $total = $subtotal + $deliveryFee;
        
        // Convert cart array to a zero-indexed array for easy iteration in the view
        $cartItems = array_values($cart);
        
        return view('checkout.index', compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
    }

    /**
     * Place the order and store it in the database.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string|max:500',
            'special_instructions' => 'nullable|string|max:1000',
            'subtotal' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|in:COD',
        ]);
        
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart session expired. Please refill your cart.');
        }

        $actualSubtotal = collect($cart)->sum(fn($item) => ($item['price'] ?? 0) * ($item['quantity'] ?? 0));
        $deliveryFee = 150;
        $actualTotal = $actualSubtotal + $deliveryFee;

        if ($request->total_amount != $actualTotal) {
            \Log::warning("Price mismatch for order placed by: {$request->name}. Frontend total: {$request->total_amount}, Actual total: {$actualTotal}");
        }

        DB::beginTransaction();

        $order = Order::create([
            'customer_name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'delivery_address' => $request->address,
            'special_instructions' => $request->special_instructions,
            'subtotal' => $actualSubtotal,
            'delivery_fee' => $deliveryFee,
            'total_amount' => $actualTotal,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
            'user_id' => auth()->id() ?? null,
        ]);

        foreach ($cart as $item) {
            $addons = isset($item['add_ons']) && is_string($item['add_ons']) 
                ? json_decode($item['add_ons'], true) 
                : ($item['add_ons'] ?? []);

            OrderItem::create([
                'order_id' => $order->id,
                // 'menu_id' => $item['id'],
                'title' => $item['title'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'] ?? 0,
                'total_price' => ($item['price'] ?? 0) * ($item['quantity'] ?? 0),
                'size_name' => $item['size_name'] ?? null,
                'add_ons_details' => json_encode($addons),
            ]);
        }

        session()->forget('cart');

        DB::commit();

        return redirect()->route('order.success')->with('success', 'Your order (#' . $order->id . ') has been placed successfully!');
    }
}