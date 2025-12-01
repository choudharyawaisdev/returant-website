<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Wishlist;
use Stevebauman\Location\Facades\Location;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('q');

        $categories = Category::with(['menus' => function ($query) use ($searchQuery) {
            if ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            }
        }])->get();
        $wishlistIds = auth()->check()
            ? Wishlist::where('user_id', auth()->id())->pluck('menu_id')->toArray()
            : [];
        return view('index.index', compact('categories', 'searchQuery', 'wishlistIds'));
    }


    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.show', compact('menu'));
    }
}
