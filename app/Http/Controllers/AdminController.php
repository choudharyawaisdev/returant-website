<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;

class AdminController extends Controller
{
    public function orderindex()
    {        
        $orders = Order::with('items', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

 public function dashboard()
{
    // Fetch total counts
    $totalUsers = User::count();
    $totalMenus = Menu::count();
    $totalCategories = Category::count();
    $totalOrders = Order::count();

    return view('admin.dashboard.index', compact(
        'totalUsers',
        'totalMenus',
        'totalCategories',
        'totalOrders'
    ));
}

}
