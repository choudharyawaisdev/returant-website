<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function orderindex()
    {
        // Fetch all orders with their items and user details
        $orders = Order::with('items', 'user')->get();

        // Pass orders to the Blade view
        return view('admin.orders.index', compact('orders'));
    }
}
